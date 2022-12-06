<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    AboutPageWidget
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class AboutPageWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = AboutPageWidget::all();
        return view("abouts.widget", compact("widgets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("abouts.add_widget");
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
          //  "icon"             =>  "required | image",
            "details"           =>  "required",
            "title"           =>  "required",
          //  "status"            =>  "required",
        ])->validate();

   /*     $image=$request->file("icon");
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);*/
        
        DB::beginTransaction();
        try{
            AboutPageWidget::create([
              //  "icon"                 =>  $date.'/'.$image_name,
                "details"               =>  $request["details"],
                "title"               =>  $request["title"],
                //"status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("about_page_widgets.index")->with(
                Session::flash("message", " About page widget added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the about page widget"), 
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
        $widgets = AboutPageWidget::where("id", $id)->get();
        return view("abouts.edit_widget", compact("widgets"));
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
           // "icon"             =>  "required | image",
            "details"           =>  "required | numeric",
            "title"           =>  "required",
           // "status"            =>  "required",
        ])->validate();
/*
        $image=$request->file("icon");
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        */
        DB::beginTransaction();
        try{
            AboutPageWidget::where("id", $id)->update([
               // "icon"                 =>  $date.'/'.$image_name,
                "details"               =>  $request["details"],
                "title"               =>  $request["title"],
               // "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("about_page_widgets.index")->with(
                Session::flash("message", " About page widget updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the about page widget"), 
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
        if(AboutPageWidget::where("id", $id)->delete()){
            return redirect()->route("about_page_widgets.index")->with(
                Session::flash("message", "About page widget deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the about page widget"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
