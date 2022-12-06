<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    TestimonialModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models=TestimonialModel::all();
        return view("abouts.testimonial", compact("models"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("abouts.add_testimonial");
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
            "name"      =>  "required | string ",
            "rating"    =>  "required |numeric",
            "image"     =>  "required | image",
            "description"=>  "required",
            "status"     =>  "required",
        ])->validate();

        $image=$request->file("image");
        $date=date("M-Y");
        $destination="images/profile_image/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);

        if($request["rating"]>=0 && $request["rating"]<=5){
            DB::beginTransaction();
            try{
                TestimonialModel::create([
                    "name"              =>  $request["name"],
                    "rating"            =>  $request["rating"],
                    "image"             =>  $date.'/'.$image_name,
                    "description"       =>  $request["description"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("testimonial_models.index")->with(
                    Session::flash("message", " Testimonial added successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot add the testimonail"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }
        }else{
            return back()->withInput()->with(
                Session::flash("message", "Please give a valid rating"), 
                Session::flash("alert-class", "alert-danger"),
            );
        };

        
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
        $models=TestimonialModel::where("id", $id)->get();
        return view("abouts.edit_testimonial", compact("models"));
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
            "name"      =>  "required | string ",
            "rating"    =>  "required |numeric",
           // "image"     =>  "required | image",
            "description"=>  "required",
            "status"     =>  "required",
        ])->validate();
        
        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"     =>  "required | image",
            ])->validate();

            $image=$request->file("image");
            $date=date("M-Y");
            $destination="images/profile_image/".$date;
            $image_name=$image->getClientOriginalName();
            $image->move($destination, $image_name);

            TestimonialModel::where("id", $id)->update([
                "image"             =>  $date.'/'.$image_name,
            ]);
        }
        
        if($request["rating"]>=0 && $request["rating"]<=5){
            DB::beginTransaction();
            try{
                TestimonialModel::where("id", $id)->update([
                    "name"              =>  $request["name"],
                    "rating"            =>  $request["rating"],
                 //   "image"             =>  $date.'/'.$image_name,
                    "description"       =>  $request["description"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("testimonial_models.index")->with(
                    Session::flash("message", " Testimonial updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the testimonail"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }
        }else{
            return back()->withInput()->with(
                Session::flash("message", "Please give a valid rating"), 
                Session::flash("alert-class", "alert-danger"),
            );
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(TestimonialModel::where("id", $id)->delete()){
            return redirect()->route("testimonial_models.index")->with(
                Session::flash("message", "Testimonial deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the testimonial"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
