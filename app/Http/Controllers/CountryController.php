<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\country;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries=country::all();
        return view("countries.country", compact("countries"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("countries.add_country");
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
            "country"       =>  "required | string | unique:countries",
            "currency"      =>  "required | string",
            "phone_code"    =>  "required",
            "status"        =>  "required"
        ])->validate();
        
        DB::beginTransaction();
        try{
            country::create([
                "country"      =>  $request["country"],
                "currency"     =>  $request["currency"],
                "phone_code"   =>  $request["phone_code"],
                "status"       =>  $request["status"],
            ]);
            DB::commit();
            return redirect()->route("countries.index")->with(
                Session::flash("message", "Country added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the Country"), 
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
        $countries=country::where("id", $id)->get();
        return view("countries.edit_country", compact("countries"));
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
            "country"       =>  "required | string",
            "currency"      =>  "required | string",
            "phone_code"    =>  "required",
            "status"        =>  "required"
        ])->validate();
        
        DB::beginTransaction();
        try{
            country::where("id", $id)->update([
                "country"      =>  $request["country"],
                "currency"     =>  $request["currency"],
                "phone_code"   =>  $request["phone_code"],
                "status"       =>  $request["status"],
            ]);
            DB::commit();
            return redirect()->route("countries.index")->with(
                Session::flash("message", "Country updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the Country"), 
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
        if(country::where("id", $id)->delete()){
            return redirect()->route("countries.index")->with(
                Session::flash("message", "Country deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the country"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
