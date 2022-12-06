<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Customer, Driver, ComplaintCategory, ComplaintSub, ComplaintsModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class Complaints extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints=ComplaintsModel::orderBy("id", "desc")->get();
        return view("complaints.complaints", compact("complaints"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        $drivers=Driver::all();
        $categories=ComplaintCategory::all();
        $sub_categories=ComplaintSub::all();
        return view("complaints.complaints_add", compact("customers", "drivers", "categories", "sub_categories"));
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
            "trip_id"        =>  "required | numeric",
            "customer"       =>  "required | string ",
            "driver"         =>  "required | string ",
            "category"       =>  "required",
            "sub_category"   =>  "required",
            "description"    =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            ComplaintsModel::create([
                "trip_id"          =>  $request["trip_id"],
                "customer"      =>  $request["customer"],
                "driver"        =>  $request["driver"],
                "category"      =>  $request["category"],
                "sub_category"  =>  $request["sub_category"],
                "description"   =>  $request["description"]
            ]);
            DB::commit();
            return redirect()->route("complaints_models.index")->with(
                Session::flash("message", "complaints added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the complaints"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers=Customer::all();
        $drivers=Driver::all();
        $categories=ComplaintCategory::all();
        $sub_categories=ComplaintSub::all();
        $complaints=ComplaintsModel::where("id", $id)->get();
        return view("complaints.complaints_edit", compact("customers", "drivers", "categories", "sub_categories", "complaints"));
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
            "trip_id"        =>  "required | numeric",
            "customer"       =>  "required | string ",
            "driver"         =>  "required | string ",
            "category"       =>  "required",
            "sub_category"   =>  "required",
            "description"    =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            ComplaintsModel::where("id", $id)->update([
                "trip_id"          =>  $request["trip_id"],
                "customer"      =>  $request["customer"],
                "driver"        =>  $request["driver"],
                "category"      =>  $request["category"],
                "sub_category"  =>  $request["sub_category"],
                "description"   =>  $request["description"]
            ]);
            DB::commit();
            return redirect()->route("complaints_models.index")->with(
                Session::flash("message", "complaints updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the complaints"), 
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
        //
    }

    public function complaint_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $complaints=ComplaintsModel::paginate(10);
            return view("complaints.complaints", compact("complaints"));
        }else{
            $complaints=ComplaintsModel::join("customers", "customers.id", "=", "complaints_models.customer")
                        ->join("drivers", "drivers.id", "=", "complaints_models.driver")
                        ->join("complaint_subs", "complaint_subs.id", "=", "complaints_models.sub_category")
                        ->join("complaint_categories", "complaint_categories.id", "=", "complaints_models.category")
                        ->where("complaint", "like","$value%")
                        ->get(["customers.customer_first_name", "complaint_categories.complaint", "drivers.first_name", "complaint_subs.sub_category", "complaints_models.trip_id",  "complaints_models.id"]);
            return response()->json([
                 "status"=>$complaints,
            ]);
        }
    }

    public function complaint_search_date(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $complaints=ComplaintsModel::paginate(10);
            return view("complaints.complaints", compact("complaints"));
        }else{
            $complaints=ComplaintsModel::where("complaints_models.created_at", $value)
                        ->join("customers", "customers.id", "=", "complaints_models.customer")
                        ->join("drivers", "drivers.id", "=", "complaints_models.driver")
                        ->join("complaint_subs", "complaint_subs.id", "=", "complaints_models.sub_category")
                        ->join("complaint_categories", "complaint_categories.id", "=", "complaints_models.category")
                        ->get(["customers.customer_first_name", "complaint_categories.complaint", "drivers.first_name", "complaint_subs.sub_category", "complaints_models.trip_id",  "complaints_models.id"]);
            return response()->json([
                 "status"=>$complaints,
            ]);
        }
    }

    public function complaints_edit($id)
    {
        $customers=Customer::all();
        $drivers=Driver::all();
        $categories=ComplaintCategory::all();
        $sub_categories=ComplaintSub::all();
        $complaints=ComplaintsModel::all();
        return view("complaints.complaints_edit", compact("customers", "drivers", "categories", "sub_categories", "complaints"));
    }
}
