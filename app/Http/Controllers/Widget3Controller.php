<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Widget3Model
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class Widget3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets=Widget3Model::all();
        return view("widgets.edit_widget3", compact("widgets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("widgets.add_widget3");
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
            "icon"          =>  "required | image | mimes:jpg,png,jpeg | max:500 | dimensions:min_width=100,min_height=100,max_width=1920,max_height=1080",   
            "details"       =>  "required",
            "button_name"   =>  "required",
            "button_url"    =>  "required",
            "status"        =>  "required"
        ])->validate();

        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);
        
        DB::beginTransaction();
        try{
            Widget3Model::create([
                "heading"         =>  $request["heading"],
                "images"            =>  $date.'/'.$icon_name,   
                "details"         =>  $request["details"],  
                "button_name"     =>  $request["button_name"],  
                "button_url"      =>  $request["button_url"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("widget3_models.index")->with(
                Session::flash("message", "Third widget added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the third widget"), 
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
        $widgets=Widget3Model::where("id", $id)->get();
        return view("widgets.edit_widget3", compact("widgets"));
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
           // "icon"          =>  "required | image | mimes:jpg,png,jpeg | max:500 | dimensions:min_width=100,min_height=100,max_width=1920,max_height=1080",
            "details"       =>  "required",
            "button_name"   =>  "required",
            "button_url"    =>  "required",
           // "status"        =>  "required"
        ])->validate();

       /* $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);*/
        
        DB::beginTransaction();
        try{
            Widget3Model::where("id", $id)->update([
                "heading"         =>  $request["heading"],
               // "images"            =>  $date.'/'.$icon_name,   
                "details"         =>  $request["details"],  
                "button_name"     =>  $request["button_name"],  
                "button_url"      =>  $request["button_url"],  
               // "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("widget3_models.index")->with(
                Session::flash("message", "Third widget updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the third widget"), 
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
        if(Widget3Model::where("id", $id)->delete()){
            return redirect()->route("widget3_models.index")->with(
                Session::flash("message", "third widget model deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the third widget model"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
