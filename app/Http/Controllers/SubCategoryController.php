<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    country, ComplaintCategory, ComplaintSub
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = ComplaintSub::all();
        return view("complaints.sub_category", compact("complaints"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();
        $categories=ComplaintCategory::all();
        return view("complaints.add_sub_category", compact("countries", "categories"));
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
            "sub_category"      =>  "required",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            ComplaintSub::create([
                "country"           =>  $request["country"],
                "category"          =>  $request["category"],
                "sub_category"      =>  $request["sub_category"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("complaint_subs.index")->with(
                Session::flash("message", "Complaint sub category added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the complaint sub category"), 
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
        $countries = country::all();
        $categories=ComplaintCategory::all();
        $complaints=ComplaintSub::where("id", $id)->get();
        return view("complaints.edit_sub", compact("countries", "categories", "complaints"));
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
            "sub_category"      =>  "required",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            ComplaintSub::where("id", $id)->update([
                "country"           =>  $request["country"],
                "category"          =>  $request["category"],
                "sub_category"      =>  $request["sub_category"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("complaint_subs.index")->with(
                Session::flash("message", "Complaint sub category updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the complaint sub category"), 
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
        if(ComplaintSub::where("id", $id)->delete()){
            return redirect()->route("complaint_subs.index")->with(
                Session::flash("message", "Complaint sub Category deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the complaint sub category"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
