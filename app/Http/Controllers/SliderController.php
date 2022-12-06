<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    SliderModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $sliders=SliderModel::all();
       return view("sliders.slider", compact("sliders")); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("sliders.add_slider");
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
            "heading1"        =>  "required | string ",
            "heading2"        =>  "required | string ",
            "images"        =>  "required | image | dimensions:max_width=1920,max_height=1080",   
            "button_name"     =>  "required",
            "button_url"      =>  "required",
            "status"          =>  "required",
        ])->validate();

        $icon=$request->file("images");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/slider_image/".$date;
        $icon->move($destination, $icon_name);

        DB::beginTransaction();
        try{
            SliderModel::create([
                "heading1"        =>  $request["heading1"],
                "heading2"        =>  $request["heading2"],
                "images"          =>  $date.'/'.$icon_name,   
                "button_name"     =>  $request["button_name"],
                "button_url"      =>  $request["button_url"],
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("slider_models.index")->with(
                Session::flash("message", "Slider added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the slider"), 
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
        $sliders=SliderModel::where("id", $id)->get();
       return view("sliders.edit_slider", compact("sliders",)); 
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
            "heading1"        =>  "required | string ",
            "heading2"        =>  "required | string ",
            "button_name"     =>  "required",
            "button_url"      =>  "required",
            "status"          =>  "required",
        ])->validate();

        if($request->file("images")!=null){
            $validator=Validator::make($request->all(),[
                "images"          =>  "required | image | dimensions:max_width=1920,max_height=1080",   
            ])->validate();

            $icon=$request->file("images");
            $icon_name=$icon->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/slider_image/".$date;
            $icon->move($destination, $icon_name);

            SliderModel::where("id", $id)->update([
                "images"          =>  $date.'/'.$icon_name, 
            ]);
        }
        
        DB::beginTransaction();
        try{
            SliderModel::where("id", $id)->update([
                "heading1"        =>  $request["heading1"],
                "heading2"        =>  $request["heading2"],
                "button_name"     =>  $request["button_name"],
                "button_url"      =>  $request["button_url"],
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("slider_models.index")->with(
                Session::flash("message", "Slider updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the slider"), 
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
        if(sliderModel::where("id", $id)->delete()){
            return redirect()->route("slider_models.index")->with(
                Session::flash("message", "Slider models deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the slider model"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
