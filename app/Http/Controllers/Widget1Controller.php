<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Widget1Model
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class Widget1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets=Widget1Model::all();
        return view("widgets.widget1", compact("widgets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("widgets.add_widget1");
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
            "icon"          =>  "required | image | mimes:jpg,png,jpeg | dimensions:max_width=512, max_height=512",
            "details"       =>  "required",
            "status"        =>  "required"
        ])->validate();

        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);
        
        DB::beginTransaction();
        try{
            Widget1Model::create([
                "heading"         =>  $request["heading"],
                "icon"            =>  $date.'/'.$icon_name,   
                "details"         =>  $request["details"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("widget1_models.index")->with(
                Session::flash("message", "First widget added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the first widget"), 
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
        $widgets=Widget1Model::where("id", $id)->get();
        return view("widgets.edit_widget1", compact("widgets"));
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
            "status"        =>  "required"
        ])->validate();

        if($request->file("icon")!=null){
            $validator=Validator::make($request->all(),[
                "icon"          =>  "required | image | mimes:jpg,png,jpeg | dimensions:max_width=512, max_height=512",
            ])->validate();

            $icon=$request->file("icon");
            $icon_name=$icon->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/icons/".$date;
            $icon->move($destination, $icon_name);

            Widget1Model::where("id", $id)->update([
                "icon"            =>  $date.'/'.$icon_name,   
            ]);
        }
        
        
        DB::beginTransaction();
        try{
            Widget1Model::where("id", $id)->update([
                "heading"         =>  $request["heading"],
                "details"         =>  $request["details"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("widget1_models.index")->with(
                Session::flash("message", "First widget updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the first widget"), 
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
        if(Widget1Model::where("id", $id)->delete()){
            return redirect()->route("widget1_models.index")->with(
                Session::flash("message", "First widget model deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the first widget model"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
