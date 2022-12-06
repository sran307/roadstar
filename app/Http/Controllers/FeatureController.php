<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\FeatureSetting;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function feature_setting()
    {
        $features=Featuresetting::all();
        return view("Features.feature_page", compact("features"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Features.add_feature");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            FeatureSetting::create([
                "enable_sms"        =>  $request["enable_sms"],
                "enable_mail"       =>  $request["enable_mail"],
                "enable_module"     =>  $request["enable_module"]
            ]);
            DB::commit();
            return redirect()->route("feature_setting")->with(
                Session::flash("message", "Feature added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the feature"), 
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
        $features=FeatureSetting::where("id", $id)->get();

        return view("Features.edit_feature", compact("features"));
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
        $sms=$request["enable_sms"];
        $mail=$request["enable_mail"];
        $module=$request["enable_module"];
        DB::beginTransaction();
        try{
            FeatureSetting::where("id", $id)->update([
                "enable_sms"        =>  $sms,
                "enable_mail"       =>  $mail,
                "enable_module"     =>  $module, 
            ]);
            DB::commit();
            return redirect()->route("feature_setting")->with(
                Session::flash("message", "Feature edited successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            return back()->with(
                Session::flash("message", "Cannot edit the feature"), 
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
        if(FeatureSetting::where("id", $id)->delete()){
            return redirect()->route("feature_setting")->with(
                Session::flash("message", "Feature deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the feature"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
