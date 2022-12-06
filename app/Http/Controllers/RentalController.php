<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    VehicleManagement, country, PackageModel, RentalModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fares =RentalModel::all();
        Return view("fares.rental", compact("fares"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        $vehicles=VehicleManagement::all();
        $packages=PackageModel::all();
        return view("fares.add_rental", compact('countries', "vehicles", "packages"));
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
            "package"         =>  "required",
            "price_per_km"      =>  "required | numeric",
            "price_per_hour"      =>  "required | numeric",
            "package_price"      =>  "required | numeric",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            RentalModel::create([
                "country"           =>  $request["country"],
                "vehicle_type"      =>  $request["vehicle_type"],
                "package_id"        =>  $request["package"],
                "price_per_km"      =>  $request["price_per_km"],
                "price_per_hour"    =>  $request["price_per_hour"],
                "package_price"     =>  $request["package_price"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("rental_models.index")->with(
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
        $countries=country::all();
        $vehicles=VehicleManagement::all();
        $packages=PackageModel::all();
        $fares = RentalModel::where("id", $id)->get();
        return view("fares.edit_rental", compact('countries', "vehicles", "packages", "fares"));
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
            "package"         =>  "required",
            "price_per_km"      =>  "required | numeric",
            "price_per_hour"      =>  "required | numeric",
            "package_price"      =>  "required | numeric",
            "status"            =>  "required"
        ])->validate();

        DB::beginTransaction();
        try{
            RentalModel::where("id", $id)->update([
                "country"           =>  $request["country"],
                "vehicle_type"      =>  $request["vehicle_type"],
                "package_id"        =>  $request["package"],
                "price_per_km"      =>  $request["price_per_km"],
                "price_per_hour"    =>  $request["price_per_hour"],
                "package_price"     =>  $request["package_price"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("rental_models.index")->with(
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
        //
    }
}
