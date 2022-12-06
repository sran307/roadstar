<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    AboutPage
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts=AboutPage::all();
        return view("abouts.edit_about", compact("abouts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("abouts.add_about");
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
            "main_heading"      =>  "required | string ",
            "sub_heading"       =>  "required | string ",
          //  "banner_image"      =>  "required | image | dimensions:max_width=794,max_height=244",
            "image"             =>  "required | image | dimensions:max_width=900,max_height=719",
           // "url"               =>  "required",
            "details"           =>  "required",
           // "status"            =>  "required",
        ])->validate();

        $banner_image=$request->file("banner_image");
        $date=date("M-Y");
        $destination="images/page_images/".$date;
        $banner_image_name=$banner_image->getClientOriginalName();
        $banner_image->move($destination, $banner_image_name);

        $image=$request->file("image");
        $date=date("M-Y");
        $destination="images/page_images/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        DB::beginTransaction();
        try{
            AboutPage::create([
                "heading1"              =>  $request["main_heading"],
                "heading2"              =>  $request["sub_heading"],
                "bg_image"              =>  $date.'/'.$banner_image_name,
                "image"                 =>  $date.'/'.$image_name,
                "details"               =>  $request["details"],
                "url"                   =>  $request["url"],
                "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("about_pages.index")->with(
                Session::flash("message", " About page added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the about page"), 
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
        $abouts=AboutPage::where("id", $id)->get();
        return view("abouts.edit_about", compact("abouts"));
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
            "main_heading"      =>  "required | string ",
            "sub_heading"       =>  "required | string ",
          //  "banner_image"      =>  "required | image | dimensions:max_width=794,max_height=244",
           // "image"             =>  "required | image | dimensions:max_width=900,max_height=719",
           // "url"               =>  "required",
            "details"           =>  "required",
          //  "description2"           =>  "required",
           // "status"            =>  "required",
        ])->validate();

       /* $banner_image=$request->file("banner_image");
        $date=date("M-Y");
        $destination="images/page_images/".$date;
        $banner_image_name=$banner_image->getClientOriginalName();
        $banner_image->move($destination, $banner_image_name);*/

        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"             =>  "required | image | dimensions:max_width=900,max_height=719",
            ])->validate();

            $image=$request->file("image");
            $date=date("M-Y");
            $destination="images/page_images/".$date;
            $image_name=$image->getClientOriginalName();
            $image->move($destination, $image_name);

            AboutPage::where("id", $id)->update([
                "image"                 =>  $date.'/'.$image_name,
            ]);
        }
       
        
        DB::beginTransaction();
        try{
            AboutPage::where("id", $id)->update([
                "heading1"              =>  $request["main_heading"],
                "heading2"              =>  $request["sub_heading"],
                //"bg_image"              =>  $date.'/'.$banner_image_name,
               // "image"                 =>  $date.'/'.$image_name,
                "details"               =>  $request["details"],
                "description2"               =>  $request["description2"],
              //  "url"                   =>  $request["url"],
               // "status"                =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("about_pages.index")->with(
                Session::flash("message", " About page updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the about page"), 
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
        if(AboutPage::where("id", $id)->delete()){
            return redirect()->route("about_pages.index")->with(
                Session::flash("message", "About page deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the about page"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
