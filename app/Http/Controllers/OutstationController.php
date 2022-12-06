<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
     VehicleManagement, country, OutstationModel, ManageModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class OutstationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fares=OutstationModel::all();
        return view("fares.outstation", compact("fares"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        $vehicles=ManageModel::all();
        return view("fares.add_outstation", compact('countries', "vehicles"));
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
            "type"              =>  "required",
        ])->validate();   

        $type=$request->type;
        if($type=='oneway'){
            $validator=Validator::make($request->all(),[
                "country"           =>  "required",
                "vehicle_type"      =>  "required",
                "base_fare"         =>  "required | numeric",
                "base_fare_km"      =>  "required | numeric",
              //  "price_per_km"      =>  "required | numeric",
             //  "allowance"         =>  "required | numeric",
                //"total_coverage_km" =>  "required | numeric",
                "type"              =>  "required",
                "status"            =>  "required"
            ])->validate();
    
            DB::beginTransaction();
            try{
                OutstationModel::create([
                    "country"           =>  $request["country"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "base_fare"         =>  $request["base_fare"],
                    "base_fare_km"      =>  $request["base_fare_km"],
                   // "price_per_km"      =>  $request["price_per_km"],
                   "allowance"         =>  $request["allowance"],
                  //  "total_km"          =>  $request["total_coverage_km"],
                    "extra_charge"      =>  $request['nighthalt'],
                    "type"              =>  $request["type"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("outstation_models.index")->with(
                    Session::flash("message", "Fare added successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot add the fare"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }

        }else  if($type=='round'){
            $validator=Validator::make($request->all(),[
                "country"           =>  "required",
                "vehicle_type"      =>  "required",
                "base_fare"         =>  "required | numeric",
                "base_fare_km"      =>  "required | numeric",
                "price_per_km"      =>  "required | numeric",
                 "allowance"         =>  "required | numeric",
                //"total_coverage_km" =>  "required | numeric",
                "nighthalt"         =>  "required",
                "type"              =>  "required",
                "status"            =>  "required"
            ])->validate();
    
            DB::beginTransaction();
            try{
                OutstationModel::create([
                    "country"           =>  $request["country"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "base_fare"         =>  $request["base_fare"],
                    "base_fare_km"      =>  $request["base_fare_km"],
                   "price_per_km"      =>  $request["price_per_km"],
                   "allowance"         =>  $request["allowance"],
                  //  "total_km"          =>  $request["total_coverage_km"],
                    "extra_charge"      =>  $request['nighthalt'],
                    "type"              =>  $request["type"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("outstation_models.index")->with(
                    Session::flash("message", "Fare added successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot add the fare"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }

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
        $countries=Country::all();
        $vehicles=ManageModel::all();
        $fares=OutstationModel::where("id", $id)->get();
        return view("fares.edit_outstation", compact('countries', "vehicles", "fares"));
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
            "type"              =>  "required",
        ])->validate();   

        $type=$request->type;
    
        if($type=='oneway'){
            $validator=Validator::make($request->all(),[
                "country"           =>  "required",
                "vehicle_type"      =>  "required",
                "base_fare"         =>  "required | numeric",
                "base_fare_km"      =>  "required | numeric",
              //  "price_per_km"      =>  "required | numeric",
              // "allowance"         =>  "required | numeric",
                //"total_coverage_km" =>  "required | numeric",
                "type"              =>  "required",
                "status"            =>  "required"
            ])->validate();
    
            DB::beginTransaction();
            try{
                OutstationModel::where("id", $id)->update([
                    "country"           =>  $request["country"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "base_fare"         =>  $request["base_fare"],
                    "base_fare_km"      =>  $request["base_fare_km"],
                   // "price_per_km"      =>  $request["price_per_km"],
                   "allowance"         =>  $request["allowance"],
                  //  "total_km"          =>  $request["total_coverage_km"],
                    "extra_charge"      =>  $request['nighthalt'],
                    "type"              =>  $request["type"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("outstation_models.index")->with(
                    Session::flash("message", "Fare updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the fare"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }

        }else  if($type=='round'){
            $validator=Validator::make($request->all(),[
                "country"           =>  "required",
                "vehicle_type"      =>  "required",
                "base_fare"         =>  "required | numeric",
                "base_fare_km"      =>  "required | numeric",
                "price_per_km"      =>  "required | numeric",
                 "allowance"         =>  "required | numeric",
                //"total_coverage_km" =>  "required | numeric",
                "nighthalt"         =>  "required",
                "type"              =>  "required",
                "status"            =>  "required"
            ])->validate();
    
            DB::beginTransaction();
            try{
                OutstationModel::where("id", $id)->update([
                    "country"           =>  $request["country"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "base_fare"         =>  $request["base_fare"],
                    "base_fare_km"      =>  $request["base_fare_km"],
                   "price_per_km"      =>  $request["price_per_km"],
                   "allowance"         =>  $request["allowance"],
                  //  "total_km"          =>  $request["total_coverage_km"],
                    "extra_charge"      =>  $request['nighthalt'],
                    "type"              =>  $request["type"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("outstation_models.index")->with(
                    Session::flash("message", "Fare updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the fare"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }

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
        if(OutstationModel::where("id", $id)->delete()){
            return redirect()->route("outstation_models.index")->with(
                Session::flash("message", "Fare deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the fare"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
