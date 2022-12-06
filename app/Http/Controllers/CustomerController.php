<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Customer, SosModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use \PDF;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::orderBy("id", "desc")->paginate(20);
        return view("customers.customer", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customers.add_customer");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "first_name"        =>  "required | string ",
            "last_name"         =>  "required | string ",
            "phone_number"      =>  "required | digits:10 |unique:customers",
            "email"             =>  "required | email | unique:customers",
            "password"          =>  "required",
            "image"             =>  "required | image ",   
            "country_code"      =>  "required",
            "currency"          =>  "required",
            "status"            =>  "required",
        ])->validate();
        $password=$request["password"];
        $suffix="ar";
        $prefix="ro";
        $enc_password=$suffix.$password.$prefix;

        $image=$request->file("image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/profile_image/".$date;
        $image->move($destination, $image_name);

        DB::beginTransaction();
        try{
            Customer::create([
                "customer_first_name"   =>  $request["first_name"],
                "customer_last_name"    =>  $request["last_name"],
                "phone_number"          =>  $request["phone_number"],
                "email"                 =>  $request["email"],
                "password"              =>  md5($password),
                "password_salt"         =>  $enc_password,
                "image"                 =>  $date.'/'.$image_name,   
                "code"                  =>  $request["country_code"],
                "currency"              =>  $request["currency"],
                "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("customers.index")->with(
                Session::flash("message", "Customer added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the customer"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers=Customer::where("id", $id)->get();
        $user_password=Customer::where("id", $id)->value("password_salt");
        $password=substr($user_password, 2-strlen($user_password), -2);
        return view("customers.edit_customer", compact("customers", "password"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "first_name"        =>  "required | string ",
            "last_name"         =>  "required | string ",
            "phone_number"      =>  "required | digits:10",
            "email"             =>  "required | email ",
            "password"          =>  "required", 
            "country_code"      =>  "required",
            "currency"          =>  "required",
            "status"            =>  "required",
        ])->validate();
        $password=$request["password"];
        $suffix="ar";
        $prefix="ro";
        $enc_password=$suffix.$password.$prefix;

        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"             =>  "required | image ",   
            ])->validate();

            $image=$request->file("image");
            $image_name=$image->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/profile_image/".$date;
            $image->move($destination, $image_name);

            Customer::where("id", $id)->update([
                "image"             =>  $date.'/'.$image_name,   
            ]);
        }
        

        DB::beginTransaction();
        try{
            Customer::where("id", $id)->update([
                "customer_first_name"   =>  $request["first_name"],
                "customer_last_name"    =>  $request["last_name"],
                "phone_number"          =>  $request["phone_number"],
                "email"                 =>  $request["email"],
                "password"              =>  md5($password),
                "password_salt"         =>  $enc_password,
                "code"                  =>  $request["country_code"],
                "currency"              =>  $request["currency"],
                "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("customers.index")->with(
                Session::flash("message", "Customer updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the customer"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Customer::where("id", $id)->delete()){
            return redirect()->route("customers.index")->with(
                Session::flash("message", "Customer deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the customer"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function wallet()
    {
        $data=null;
        return view("customers.wallet", compact("data"));
    }

    public function export_csv()
    {
        return Excel::download(new DataExport, "customers.csv");
    }

    public function export_xlsx()
    {
        return Excel::download(new DataExport, "customers.xlsx");
    }

    public function export_pdf()
    {
        $pdf= PDF::loadview('invoice');
        return $pdf->download("invoice.pdf");
    }

    public function sos_edit($id)
    {
        $customers=SosModel::where("customer_id", $id)->get();
        return view("customers.sos_page", compact("customers"));
    }

    public function search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $customers=Customer::paginate(10);
            return view("customers.customer", compact("customers"));
        }else{
            if(is_numeric($value)){
                $customers=Customer::where("phone_number", "like","$value%")->get();
                return response()->json([
                    "status"=>$customers,
                ]);
            }else{
                $customers=Customer::where("customer_first_name", "like","$value%")->get();
                return response()->json([
                    "status"=>$customers,
                ]);
            }
        }
        
    }
    public function customer_delete($id)
    {
        
        if(Customer::where("id", $id)->delete()){
            return redirect()->route("customers.index")->with(
                Session::flash("message", "Customer deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the customer"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}

class DataExport implements FromCollection
{
    public function collection()
    {
        return Customer::all();
    }
}