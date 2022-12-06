<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\FleetModel;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $fleets=FleetModel::all();
      return view("widgets.fleet", compact("fleets"));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("widgets.add_fleet");
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
            "name"        =>  "required | string ",
            "image"       =>  "required | image | dimensions:max_width=550,max_height=310",
            "type"        =>  "required",
            "speed"       =>  "required", 
            "rating"      =>  "required | numeric",   
            "amount"      =>  "required | numeric",
            "passenger"   =>  "required | numeric", 
            "button_name" =>  "required",
            "button_url"  =>  "required",
           // "status"      =>  "required",
        ])->validate();

        $image=$request->file("image");
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        if($request['rating']>=0 && $request['rating']<=5){
            DB::beginTransaction();
            try{
                FleetModel::create([
                    "name"              =>  $request["name"],
                    "image"             =>  $date.'/'.$image_name,
                    "type"              =>  $request["type"],
                    "speed"             =>  $request["speed"],
                    "rating"            =>  $request["rating"],
                    "amount_per_day"    =>  $request["amount"],
                    "passengers"        =>  $request["passenger"],
                    "button_name"       =>  $request["button_name"],
                    "button_url"        =>  $request["button_url"],
                    "number_of_bookings"=>"0",
                  //  "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("fleet_models.index")->with(
                    Session::flash("message", "Fleets updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the fleet"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }
        }else{
            return back()->withInput()->with(
                Session::flash("message", "Please give a valid rating"), 
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
        $fleets=FleetModel::where("id", $id)->get();
        return view("widgets.edit_fleet", compact("fleets"));  
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
            "name"        =>  "required | string ",
          //  "image"       =>  "required | image | dimensions:max_width=550,max_height=310",
            "type"        =>  "required",
            "speed"       =>  "required", 
            "rating"      =>  "required | numeric",   
            "amount"      =>  "required | numeric",
            "passenger"   =>  "required | numeric", 
            "button_name" =>  "required",
            "button_url"  =>  "required",
           // "status"      =>  "required",
        ])->validate();
        
        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"       =>  "required | image | dimensions:max_width=550,max_height=310",
            ])->validate();

            $image=$request->file("image");
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $image_name=$image->getClientOriginalName();
            $image->move($destination, $image_name);

            FleetModel::where("id", $id)->update([
                "image"             =>  $date.'/'.$image_name,
            ]);
        }
        
        
        if($request['rating']>=0 && $request['rating']<=5){
            DB::beginTransaction();
            try{
                FleetModel::where("id", $id)->update([
                    "name"              =>  $request["name"],
                  //  "image"             =>  $date.'/'.$image_name,
                    "type"              =>  $request["type"],
                    "speed"             =>  $request["speed"],
                    "rating"            =>  $request["rating"],
                    "amount_per_day"    =>  $request["amount"],
                    "passengers"        =>  $request["passenger"],
                    "button_name"       =>  $request["button_name"],
                    "button_url"        =>  $request["button_url"],
                    "number_of_bookings"=>"0",
                 //   "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("fleet_models.index")->with(
                    Session::flash("message", "Fleets updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the fleet"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }
        }else{
            return back()->withInput()->with(
                Session::flash("message", "Please give a valid rating"), 
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
        if(FleetModel::where("id", $id)->delete()){
            return redirect()->route("fleet_models.index")->with(
                Session::flash("message", "Fleet deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the fleet"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
