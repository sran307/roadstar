<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    VehicleManagement, country, PackageModel, ComplaintCategory
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints=ComplaintCategory::all();
        return view("complaints.complaint", compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        return view("complaints.add_complaints", compact("countries"));
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
            "country"           =>  "required",
            "category"          =>  "required",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            ComplaintCategory::create([
                "country"           =>  $request["country"],
                "complaint"          =>  $request["category"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("complaint_categories.index")->with(
                Session::flash("message", "Complaint category added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the complaint category"), 
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
        $countries=country::all();
        $complaints=ComplaintCategory::where("id", $id)->get();
        return view("complaints.edit_complaints", compact("countries", "complaints"));
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
            "country"           =>  "required",
            "category"          =>  "required",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            ComplaintCategory::where("id", $id)->update([
                "country"           =>  $request["country"],
                "complaint"          =>  $request["category"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("complaint_categories.index")->with(
                Session::flash("message", "Complaint category updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the complaint category"), 
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
        if(ComplaintCategory::where("id", $id)->delete()){
            return redirect()->route("complaint_categories.index")->with(
                Session::flash("message", "Complaint Category deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the complaint category"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
