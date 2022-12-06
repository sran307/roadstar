<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    ServiceModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServiceModel::all();
        return view("widgets.service", compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("widgets.add_service");
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
            "icon"          =>  "required | image | mimes:jpg,png,jpeg, jfif | dimensions:min_width=100,min_height=100,max_width=293,max_height=195",   
            "details"       =>  "required",
            //"button_icon"   =>  "required",
          // "button_url"    =>  "required",
            //"status"        =>  "required"
        ])->validate();

        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);

       /* $button_icon=$request->file("button_icon");
        $button_icon_name=$button_icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $button_icon->move($destination, $button_icon_name);
        */
        DB::beginTransaction();
        try{
            ServiceModel::create([
                "heading"         =>  $request["heading"],
                "images"            =>  $date.'/'.$icon_name,   
                "details"         =>  $request["details"],  
               // "button_icon"     =>    $date.'/'.$button_icon_name,
              //  "button_url"      =>  $request["button_url"],  
               // "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("service_models.index")->with(
                Session::flash("message", "Service added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the service widget"), 
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
        $services = ServiceModel::where("id", $id)->get();
        return view("widgets.edit_service", compact("services"));
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
            //"icon"          =>  "required | image | mimes:jpg,png,jpeg, jfif | dimensions:min_width=100,min_height=100,max_width=293,max_height=195",   
            "details"       =>  "required",
           // "button_icon"   =>  "required",
          //  "button_url"    =>  "required",
           // "status"        =>  "required"
        ])->validate();

        if($request->file("icon")!=null){
            $validator=Validator::make($request->all(),[
                "icon"          =>  "required | image | mimes:jpg,png,jpeg, jfif | dimensions:min_width=100,min_height=100,max_width=293,max_height=195",   
            ])->validate();

            $icon=$request->file("icon");
            $icon_name=$icon->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/icons/".$date;
            $icon->move($destination, $icon_name);

            ServiceModel::where("id", $id)->update([
                "images"            =>  $date.'/'.$icon_name,  
            ]);
        }
       

      /*  $button_icon=$request->file("button_icon");
        $button_icon_name=$button_icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $button_icon->move($destination, $button_icon_name);
       */ 
        DB::beginTransaction();
        try{
            ServiceModel::where("id", $id)->update([
                "heading"         =>  $request["heading"],
              //  "images"            =>  $date.'/'.$icon_name,   
                "details"         =>  $request["details"],  
                //"button_icon"     =>    $date.'/'.$button_icon_name,
              // "button_url"      =>  $request["button_url"],  
               // "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("service_models.index")->with(
                Session::flash("message", "Service updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the service widget"), 
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
        if(ServiceModel::where("id", $id)->delete()){
            return redirect()->route("service_models.index")->with(
                Session::flash("message", "Services deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the services"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
