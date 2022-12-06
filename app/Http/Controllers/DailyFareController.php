<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    FareModel, VehicleManagement, DailyFare, country,ManageModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};


class DailyFareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fares=DailyFare::all();
        return view("fares.daily_fare", compact("fares"));
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
        return view("fares.add_daily", compact('countries', "vehicles"));
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
            "country"           =>  "required",
            "vehicle_type"      =>  "required",
            "trip_type"         =>  "required",
            "base_fare"         =>  "required | numeric",
            "base_fare_km"      =>  "required | numeric",
            "price_per_km"      =>  "required | numeric",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            DailyFare::create([
                "country"           =>  $request["country"],
                "vehicle_type"      =>  $request["vehicle_type"],
                "road_trip"         =>  $request["trip_type"],
                "base_fare"         =>  $request["base_fare"],
                "base_fare_km"      =>  $request["base_fare_km"],
                "price_per_km"      =>  $request["price_per_km"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("daily_fares.index")->with(
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
        $fares=DailyFare::where("id", $id)->get();
        return view("fares.edit_daily", compact('countries', "vehicles", "fares"));
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
            "country"           =>  "required",
            "vehicle_type"      =>  "required",
            "trip_type"         =>  "required",
            "base_fare"         =>  "required | numeric",
            "base_fare_km"      =>  "required | numeric",
            "price_per_km"      =>  "required | numeric",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            DailyFare::where("id", $id)->update([
                "country"           =>  $request["country"],
                "vehicle_type"      =>  $request["vehicle_type"],
                "road_trip"         =>  $request["trip_type"],
                "base_fare"         =>  $request["base_fare"],
                "base_fare_km"      =>  $request["base_fare_km"],
                "price_per_km"      =>  $request["price_per_km"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("daily_fares.index")->with(
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DailyFare::where("id", $id)->delete()){
            return redirect()->route("daily_fares.index")->with(
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
