<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    AboutWidget
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class AboutWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets=AboutWidget::all();
        return view("widgets.edit_about", compact("widgets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("widgets.add_about");
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
            "icon"          =>  "required | image | mimes:jpg,png,jpeg | max:200 | dimensions:min_width=100,min_height=100,max_width=900,max_height=720",   
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
            AboutWidget::create([
                "title"         =>  $request["heading"],
                "image"         =>  $date.'/'.$icon_name,   
                "details"       =>  $request["details"],  
                "status"        =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("about_widgets.index")->with(
                Session::flash("message", "About widget added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the about widget"), 
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
        $widgets=AboutWidget::where("id", $id)->get();
        return view("widgets.edit_about", compact("widgets"));
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
          //  "icon"          =>  "required | image | mimes:jpg,png,jpeg | max:200 | dimensions:min_width=100,min_height=100,max_width=900,max_height=720",   
            "details"       =>  "required",
           // "description2" =>  "required",
            //"status"        =>  "required"
        ])->validate();

        if($request->file("icon")!=null){
            $validator=Validator::make($request->all(),[
                "icon"          =>  "required | image | mimes:jpg,png,jpeg | max:200 | dimensions:min_width=100,min_height=100,max_width=900,max_height=720",   
            ])->validate();

            $icon=$request->file("icon");
            $icon_name=$icon->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/icons/".$date;
            $icon->move($destination, $icon_name);

            AboutWidget::where("id", $id)->update([
                "image"         =>  $date.'/'.$icon_name,   
            ]);
        }
        
        
        DB::beginTransaction();
        try{
            AboutWidget::where("id", $id)->update([
                "title"         =>  $request["heading"],
               // "image"         =>  $date.'/'.$icon_name,   
                "details"       =>  $request["details"],  
                //"detail2"       =>  $request["description2"],  
                "status"        =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("about_widgets.index")->with(
                Session::flash("message", "About widget updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the about widget"), 
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
        if(Aboutwidget::where("id", $id)->delete()){
            return redirect()->route("about_widgets.index")->with(
                Session::flash("message", "About widget model deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the about widget model"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
