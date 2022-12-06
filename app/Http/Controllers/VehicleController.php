<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    ManageModel, country
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles=ManageModel::all();
        return view("vehicles.vehicle_page", compact("vehicles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
       return view("vehicles.add_vehicle", compact("countries"));
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
            "vehicle_type"   =>  "required | string",
            "description"    =>  "required | string",
            "fare"           =>  "required | numeric",   
            "price_per_km"   =>  "required | numeric ",
            "image"          =>  "required | image",
            "vehicle_level"  =>  "required | string ",
            "status"         =>  "required",
        ])->validate();

        $image=$request->file("image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons".'/'.$date;
        $image->move($destination, $image_name);

        DB::beginTransaction();
        try{
            VehicleManagement::create([
                "vehicle_type"   =>  $request["vehicle_type"],
                "description"    =>  $request["description"],
                "fare"           =>  $request["fare"],
                "price_km"       =>  $request["price_per_km"],
                "image"          =>  $date.'/'.$image_name,
                "vehicle_level"  =>  $request["vehicle_level"],
                "status"         =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("vehicle_managements.index")->with(
                Session::flash("message", "vehicle added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the vehicle"), 
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
        $vehicles=VehicleManagement::where("id", $id)->get();
        $countries=Country::all();
        return view("vehicles.edit_vehicles", compact("vehicles", "countries"));
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
            "country"        =>  "required",
            "vehicle_type"   =>  "required | string",
            "description"    =>  "required | string",
            "fare"           =>  "required | numeric",   
            "price_per_km"   =>  "required | numeric ",
           // "image"          =>  "required | image",
            "vehicle_level"  =>  "required | string ",
            "status"         =>  "required",
        ])->validate();
        
        if($request->file("image")){
            $validator=Validator::make($request->all(),[
                "image"          =>  "required | image",
            ])->validate();

            $image=$request->file("image");
            $image_name=$image->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/icons".'/'.$date;
            $image->move($destination, $image_name);

            VehicleManagement::where("id", $id)->update([
                "image"          =>  $date.'/'.$image_name,
            ]);
        }
        

        DB::beginTransaction();
        try{
            VehicleManagement::where("id", $id)->update([
                "country_id"   =>  $request["country"],
                "vehicle_type"  =>  $request["vehicle_type"],
                "description"    =>  $request["description"],
                "fare"          => $request["fare"],
                "price_km"       =>  $request["price_per_km"],
               // "image"          =>  $date.'/'.$image_name,
                "vehicle_level"  =>  $request["vehicle_level"],
                "status"         =>  $request["status"],
            ]);
            DB::commit();
            return redirect()->route("vehicle_managements.index")->with(
                Session::flash("message", "vehicle updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the vehicle"), 
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
        //
    }
}
