<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Widget2Model
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class Widget2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets=Widget2Model::all();
        return view("widgets.widget2", compact("widgets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("widgets.add_widget2");
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
            "heading"       =>  "required | string ",
            "details"       =>  "required",
            "button_name"   =>  "required",
            "button_url"    =>  "required",
            //"status"        =>  "required"
        ])->validate();
        
        DB::beginTransaction();
        try{
            Widget2Model::create([
                "heading"         =>  $request["heading"],
                "details"         =>  $request["details"],  
                "button_name"     =>  $request["button_name"],  
                "button_url"      =>  $request["button_url"],  
                //"status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("widget2_models.index")->with(
                Session::flash("message", "Second widget added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the second widget"), 
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
        $widgets=Widget2Model::where("id", $id)->get();
        return view("widgets.edit_widget2", compact("widgets"));
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
            "heading"       =>  "required | string ",   
            "details"       =>  "required",
            "button_name"   =>  "required",
            "button_url"    =>  "required",
           // "status"        =>  "required"
        ])->validate();
        
        DB::beginTransaction();
        try{
            Widget2Model::where("id", $id)->update([
                "heading"         =>  $request["heading"],
                "details"         =>  $request["details"],  
                "button_name"     =>  $request["button_name"],  
                "button_url"      =>  $request["button_url"],  
                //"status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("widget2_models.index")->with(
                Session::flash("message", "Second widget updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the second widget"), 
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
        if(Widget2Model::where("id", $id)->delete()){
            return redirect()->route("widget2_models.index")->with(
                Session::flash("message", "Second widget model deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the second widget model"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
