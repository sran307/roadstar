<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    PaymentModel, ComplaintsModel, country, StatusModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments=PaymentModel::all();
        return view("payments.payment_methods", compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        return view("payments.add_payment", compact("countries"));
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
            "country"        =>  "required",
            "payment"         =>  "required | string ",
            "payment_type"      =>  "required | string",
            "icon"             =>  "required",   
            "status"            =>  "required",
        ])->validate();
        
        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);

        DB::beginTransaction();
        try{
            PaymentModel::create([
                "country"        =>  $request["country"],
                "payment"         =>  $request["payment"],
                "payment_type"      =>  $request["payment_type"],
                "icon"             =>  $date.'/'.$icon_name,   
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("payment_models.index")->with(
                Session::flash("message", "Payment method added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the payment method"), 
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries=country::all();
        $payments=PaymentModel::where("id", $id)->get();
        return view("payments.edit_payment", compact("payments", "countries"));
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
            "country"        =>  "required",
            "payment"         =>  "required | string ",
            "payment_type"      =>  "required | string",
            "icon"             =>  "required",   
            "status"            =>  "required",
        ])->validate();
        
        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);

        DB::beginTransaction();
        try{
            PaymentModel::where("id", $id)->update([
                "country"        =>  $request["country"],
                "payment"         =>  $request["payment"],
                "payment_type"      =>  $request["payment_type"],
                "icon"             =>  $date.'/'.$icon_name,   
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("payment_models.index")->with(
                Session::flash("message", "Payment method updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the payment method"), 
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
        if(PaymentModel::where("id", $id)->delete()){
            return redirect()->route("payment_models.index")->with(
                Session::flash("message", "Payment method deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the payment method"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
        
    }
}
