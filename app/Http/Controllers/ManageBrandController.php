<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\ManageBrand;
class ManageBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=ManageBrand::all();
        return view("fleets.brands", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=ManageBrand::max("id")+1;
        return view("fleets.add_brand", compact("id"));
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
            "code"       =>  "required ",
            "name"       =>  "required | string ",
           "status"      =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            ManageBrand::create([
                "code"              =>  $request["code"],
                "brand_name"        =>  $request["name"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("manage_brands.index")->with(
                Session::flash("message", " Brand added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the Brand"), 
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
        $brands=ManageBrand::where("id", $id)->first();
        return view("fleets.edit_brand", compact("brands"));
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
            "code"       =>  "required ",
            "name"       =>  "required | string ",
           "status"      =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            ManageBrand::where("id", $id)->update([
                "code"              =>  $request["code"],
                "brand_name"        =>  $request["name"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("manage_brands.index")->with(
                Session::flash("message", " Brand updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the Brand"), 
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
        if(ManageBrand::where("id", $id)->delete()){
            return redirect()->route("manage_brands.index")->with(
                Session::flash("message", "Brand deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the brand"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
