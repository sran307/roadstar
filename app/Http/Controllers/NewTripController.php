<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Customer, 
    Driver, 
    NewTrip, 
    StatusModel, 
    DriverVehicle, 
    ManageModel,
    TripRequest
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class NewTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips=NewTrip::orderBy("id", "desc")->paginate(20);
        $drivers=Driver::all();
        return view("trips.new_trip", compact("trips", "drivers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trip_number=NewTrip::max("trip_id");
        $trip_number+=1;
        $customers=Customer::all();
        $drivers=Driver::all();
        $statuses=StatusModel::all();
        return view("trips.add_new_trip", compact("customers", "drivers", "trip_number", "statuses"));
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
            "customer"       =>  "required | string ",
            "driver"         =>  "required | string ",
            "phone_number"   =>   "required",
            "pickup_date"    =>  "required",
            "pickup_time"    =>  "required",
            "pickup_address" =>  "required",
            "drop_address"   =>  "required",
            "lattitude"      =>  "required",   
            "longitude"      =>  "required",
            "vehicle_number" =>  "required",
            "payment_method" =>  "required",
            "subtotal"       =>  "required",
            "discount"       =>  "required",
            "fare"           =>  "required",
            "status"         =>  "required",
        ])->validate();

            $trip_id=$request["trip_id"];
            $trip_id=substr($trip_id, 5-strlen($trip_id));
        DB::beginTransaction();
        try{
            NewTrip::create([
                "trip_id"          =>  $trip_id,
                "customer_id"      =>  $request["customer"],
                "driver_id"        =>  $request["driver"],
                "phone_number"     =>  $request["phone_number"],
                "pickup_date"      =>  $request["pickup_date"],
                "pickup_time"      =>  $request["pickup_time"],
                "pickup_address"   =>  $request["pickup_address"],
                "drop_address"     =>  $request["drop_address"],   
                "pickup_lat"       =>  $request["lattitude"],
                "pickup_lon"       =>  $request["longitude"],
                "vehicle_number"   =>  $request["vehicle_number"],
                "payment_method"   =>  $request["payment_method"],
                "subtotal"         =>  $request["subtotal"],
                "discount"         =>  $request["discount"],
                "fare"             =>  $request["fare"],
                "status"           =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("new_trips.index")->with(
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
        $customers=Customer::all();
        $drivers=Driver::all();
        $trips=NewTrip::where("id", $id)->get();
        $statuses=StatusModel::all();
        return view("trips.edit_new_trips", compact("trips", "customers", "drivers", "statuses"));
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
            "customer"       =>  "required | string ",
            "driver"         =>  "required | string ",
            "phone_number"   =>   "required",
            "pickup_date"    =>  "required",
            "pickup_time"    =>  "required",
            "pickup_address" =>  "required",
            "drop_address"   =>  "required",
            "lattitude"      =>  "required",   
            "longitude"      =>  "required",
            "vehicle_number" =>  "required",
            "payment_method" =>  "required",
            "subtotal"       =>  "required",
            "discount"       =>  "required",
            "fare"           =>  "required",
            "status"         =>  "required",
        ])->validate();

            $trip_id=$request["trip_id"];
            $trip_id=substr($trip_id, 5-strlen($trip_id));
        DB::beginTransaction();
        try{
            NewTrip::where("id", $id)->update([
                "trip_id"          =>  $trip_id,
                "customer_id"      =>  $request["customer"],
                "driver_id"        =>  $request["driver"],
                "phone_number"     =>  $request["phone_number"],
                "pickup_date"      =>  $request["pickup_date"],
                "pickup_time"      =>  $request["pickup_time"],
                "pickup_address"   =>  $request["pickup_address"],
                "drop_address"     =>  $request["drop_address"],   
                "pickup_lat"       =>  $request["lattitude"],
                "pickup_lon"       =>  $request["longitude"],
                "vehicle_number"   =>  $request["vehicle_number"],
                "payment_method"   =>  $request["payment_method"],
                "subtotal"         =>  $request["subtotal"],
                "discount"         =>  $request["discount"],
                "fare"             =>  $request["fare"],
                "status"           =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("new_trips.index")->with(
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
        //
    }
    public function get_vehicle(Request $request)
    {
        $id=$request->post("id");
        $vehicle_number=DriverVehicle::where("driver_id", $id)->value("vehicle_number");
        $phone_number=Driver::where("id", $id)->value("phone_number");
        $image=Driver::where("id", $id)->value("image");
        return response()->json([
            "vehicle_number"=>$vehicle_number,
            "phone_number"=>$phone_number,
            "image" =>$image
        ]);
    }
    //trip data filtering for desired date
    public function fetch_data(Request $request)
    {
       $date=$request["date"];
       if($date==null){
            $trips=NewTrip::all();
            return back()->compact("trips");
       }else{
            $trips=NewTrip::where("pickup_date", $date)->get();
            return redirect()->route("new_trips.index", compact("trips"));
       }
       
    }

    public function trip_phone_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $trips=NewTrip::all();
            return view("trips.new_trip", compact("trips"));
        }else{
            $trips=NewTrip::join("customers", "customers.id", "=", "new_trips.customer_id")
                            ->join("drivers", "drivers.id", "=", "new_trips.driver_id")
                            ->where("new_trips.phone_number", "like", "$value%")
                            ->get([
                                "customers.customer_first_name", 
                                "drivers.first_name", 
                                "drivers.rating",
                                "new_trips.phone_number",
                                "new_trips.trip_id",
                                "new_trips.vehicle_number",
                                "new_trips.payment_method",
                                "new_trips.subtotal",
                                "new_trips.discount",
                                "new_trips.fare",
                                "new_trips.status",
                                "new_trips.id"
                            ]);

            return response()->json([
                "status"=>$trips
            ]);
        }
        
    }

    public function trip_date_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $trips=NewTrip::all();
            return view("trips.new_trip", compact("trips"));
        }else{
            $trips=NewTrip::join("customers", "customers.id", "=", "new_trips.customer_id")
                            ->join("drivers", "drivers.id", "=", "new_trips.driver_id")
                            ->where("new_trips.created_at", $value)
                            ->get([
                                "customers.customer_first_name", 
                                "drivers.first_name", 
                                "drivers.rating",
                                "new_trips.phone_number",
                                "new_trips.trip_id",
                                "new_trips.vehicle_number",
                                "new_trips.payment_method",
                                "new_trips.subtotal",
                                "new_trips.discount",
                                "new_trips.fare",
                                "new_trips.status",
                            ]);
                            
            return response()->json([
                "status"=>$trips
            ]);
        }
    }

    public function choose_driver(Request $request)
    {
        $value=$request["value"];

        $fleets=Driver::find($value)->fleets;
        foreach($fleets as $fleet){
            $vehicle_number=$fleet->vehicle_number;
            $vehicle_type=ManageModel::where("id", $fleet->model)->value("model_name");
        }
        $drivers=Driver::where("id", $value)->get();
        foreach($drivers as $driver){
            $name=$driver->first_name;
            $phone=$driver->phone_number;
            $image=$driver->image;
            $id=$driver->id;

        }
        return response()->json([
            "vehicle_number"=>$vehicle_number,
            "vehicle_type"=>$vehicle_type,
            "name"      => $name,
            "phone"     =>  $phone,
            "image"     =>  $image,
            "driver_id"=> $id
        ]);
    }

    public function assign_driver(Request $request)
    {
        $id=$request["id"];
        $driver=$request["driver"];
        $vehicle=$request["vehicle_number"];
        
        DB::beginTransaction();
        try{
            NewTrip::where("id", $id)->update([
               
                "driver_id"        =>  $driver,
                "vehicle_number"   =>  $vehicle,
                "status"           =>   "Assigned Driver"
            ]);
            DB::commit();
            TripRequest::where("id", NewTrip::where("id", $id)->value("trip_id"))->update(["status"=> "Assigned Driver"]);
            return redirect()->route("new_trips.index")->with(
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
}
