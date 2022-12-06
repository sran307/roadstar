<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    BackgroundImage
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class BackgroundImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = BackgroundImage::all();
        return view("abouts.bg_image", compact("images"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("abouts.add_bg_image");
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
            "background_image"      =>  "required | image | dimensions:max_width=794,max_height=308",
            "status"            =>  "required",
        ])->validate();

        $image=$request->file("background_image");
        $date=date("M-Y");
        $destination="images/bg_images/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        DB::beginTransaction();
        try{
            BackgroundImage::create([
                "bg_image"                 =>  $date.'/'.$image_name,
                "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("background_images.index")->with(
                Session::flash("message", " Background image added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the background image"), 
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
        $images = BackgroundImage::where("id", $id)->get();
        return view("abouts.edit_bg_image", compact("images"));
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
            "background_image"      =>  "required | image | dimensions:max_width=794,max_height=308",
            "status"            =>  "required",
        ])->validate();

        $image=$request->file("background_image");
        $date=date("M-Y");
        $destination="images/bg_images/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        DB::beginTransaction();
        try{
            BackgroundImage::where("id", $id)->update([
                "bg_image"                 =>  $date.'/'.$image_name,
                "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("background_images.index")->with(
                Session::flash("message", " Background image updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the background image"), 
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
        if(BackgroundImage::where("id", $id)->delete()){
            return redirect()->route("background_images.index")->with(
                Session::flash("message", "Background image deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the Background image"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
