<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    CityTrip, City
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=CityTrip::orderby("id", "desc")->all();
        return view("countries.city", compact("cities"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("countries.add_city");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fcity = $request["from_city"];
        $tcity = $request["to_city"];

        $validator=Validator::make($request->all(),[
            "from_city"      =>  "required | string",
            "to_city"            =>  "required | string",
            "distance"      =>"required | numeric",
            "status"      => "required"
        ])->validate();

        if(count(City::where("city", $fcity)->get())==0){
            City::create([
                "city"=>$fcity,
            ]);
        }

        if(count(City::where("city", $tcity)->get())==0){
            City::create([
                "city"=>$tcity,
            ]);
        }

        DB::beginTransaction();
        try{
            CityTrip::create([
                "from_address"      =>  $fcity,
                "to_address"            =>  $tcity,
                "distance"      =>  $request["distance"],
                "status"        =>  $request["status"],
                "type"          =>  $request["type"]
            ]);
            DB::commit();
            return redirect()->route("city_trips.index")->with(
                Session::flash("message", "Trip added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the trip"), 
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
        $cities=CityTrip::where("id", $id)->get();
        return view("countries.edit_city", compact("cities"));
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
        $fcity = $request["from_city"];
        $tcity = $request["to_city"];

        $validator=Validator::make($request->all(),[
            "from_city"      =>  "required | string",
            "to_city"            =>  "required | string",
            "distance"      =>"required | numeric",
            "status"      => "required"
        ])->validate();

        DB::beginTransaction();
        try{
            CityTrip::where("id", $id)->update([
                "from_address"      =>  $fcity,
                "to_address"            =>  $tcity,
                "distance"      =>  $request["distance"],
                "status"        =>  $request["status"],
                "type"          =>  $request["type"]
            ]);
            DB::commit();
            return redirect()->route("city_trips.index")->with(
                Session::flash("message", "Trip updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the trip"), 
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
        if(CityTrip::where("id", $id)->delete()){
            return redirect()->route("city_trips.index")->with(
                Session::flash("message", "City deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the city"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function city_distance(Request $request)
    {
        $fcity=$request["fcity"];
        $tcity=$request["tcity"];
        
        $apiKey = 'AIzaSyC5fqAnudwWAaeY6w7Kc67Qm2tiYOX00QE';
                    
            // Change address format
            $formattedAddrFrom    = str_replace(' ', '+', $fcity);
            $formattedAddrTo     = str_replace(' ', '+', $tcity);
            
            // Geocoding API request with start address
            $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
            $outputFrom = json_decode($geocodeFrom);
            if(!empty($outputFrom->error_message)){
                return $outputFrom->error_message;
            }
            
            // Geocoding API request with end address
            $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
            $outputTo = json_decode($geocodeTo);
            if(!empty($outputTo->error_message)){
                return $outputTo->error_message;
            }
            
            // Get latitude and longitude from the geodata
            $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
            $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
            $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
            $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
            
            // Calculate distance between latitude and longitude
            $theta    = $longitudeFrom - $longitudeTo;
            $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
            $dist    = acos($dist);
            $dist    = rad2deg($dist);
            $miles    = $dist * 60 * 1.1515;
            
            $distance= round($miles * 1.609344, 2);
        
        return response()->json([
            "status"=>$distance,
            
        ]);
    }
}
