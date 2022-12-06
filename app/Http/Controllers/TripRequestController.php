<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    TripRequest, 
    country, 
    VehicleManagement, 
    Customer, 
    StatusModel,
    ManageModel,
    PaymentModel,
    NewTrip,
    Driver,
    ManageFleet
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class TripRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests=TripRequest::orderBy("id", "desc")->paginate(20);
        return view("trips.trip_requests", compact("requests"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        $vehicles=ManageModel::all();
        $statuses=StatusModel::all();
        return view("trips.add_trip_request", compact("customers", "vehicles", "statuses"));
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
            "distance"       =>  "required | numeric ",
            "vehicle_type"   =>   "required",
            "pickup_address" =>  "required",
            "lattitude"      =>  "required | numeric",   
            "longitude"      =>  "required | numeric",
            "drop_address"   =>  "required",
            "drop_lattitude" =>  "required | numeric",   
            "drop_longitude" =>  "required | numeric",
            "payment_method" =>  "required",
            "total"          =>  "required | numeric", 
            "subtotal"       =>  "required | numeric",
            "discount"       =>  "required | numeric",
            "tax"           =>  "required | numeric",
            "status"         =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            TripRequest::create([
                "passanger_name"    =>  $request["customer"],
                "distance"          =>  $request["distance"],
                "vehicle_type"      =>  $request["vehicle_type"],
                "pickup_address"    =>  $request["pickup_address"],
                "pickup_lat"        =>  $request["lattitude"],
                "pickup_lon"        =>  $request["longitude"],
                "drop_address"      =>  $request["drop_address"],   
                "drop_lat"          =>  $request["drop_lattitude"],
                "drop_lon"          =>  $request["drop_longitude"],
                "payment_method"    =>  $request["payment_method"],
                "total"             =>  $request["total"],
                "subtotal"          =>  $request["subtotal"],
                "discount"          =>  $request["discount"],
                "tax"               =>  $request["tax"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("trip_requests.index")->with(
                Session::flash("message", "Trip request added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the trip request"), 
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
        $vehicles=ManageModel::all();
        $statuses=StatusModel::all();
        $requests=TripRequest::where("id", $id)->get();
        $payment_methods=PaymentModel::all();
        return view("trips.edit_trip_requests", compact("payment_methods", "requests", "customers", "vehicles", "statuses"));
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
       /* $validator=Validator::make($request->all(),[
            "customer"       =>  "required | string ",
            "distance"       =>  "required | numeric ",
            "vehicle_type"   =>   "required",
            "pickup_address" =>  "required",
            "lattitude"      =>  "required | numeric",   
            "longitude"      =>  "required | numeric",
            "drop_address"   =>  "required",
            "drop_lattitude" =>  "required | numeric",   
            "drop_longitude" =>  "required | numeric",
            "payment_method" =>  "required",
            "total"          =>  "required | numeric", 
            "subtotal"       =>  "required | numeric",
            "discount"       =>  "required | numeric",
            "tax"           =>  "required | numeric",
            "status"         =>  "required",
        ])->validate();*/
        $type=TripRequest::where("id", $id)->value("type");
        if($type=="airport_from"){
            DB::beginTransaction();
            try{
                TripRequest::where("id", $id)->update([
                    "passanger_name"    =>  $request["customer"],
                    "distance"          =>  $request["distance"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "airport"           =>  $request["pickup_address"],
                    "pickup_lat"        =>  $request["lattitude"],
                    "pickup_lon"        =>  $request["longitude"],
                    "to_address"        =>  $request["drop_address"],   
                    "drop_lat"          =>  $request["drop_lattitude"],
                    "drop_lon"          =>  $request["drop_longitude"],
                    "payment_method"    =>  $request["payment_method"],
                    "total"             =>  $request["total"],
                    "subtotal"          =>  $request["subtotal"],
                    "discount"          =>  $request["discount"],
                    "tax"               =>  $request["tax"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("trip_requests.index")->with(
                    Session::flash("message", "Trip request updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the trip request"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }
        }else if($type=="airport_to"){
            DB::beginTransaction();
            try{
                TripRequest::where("id", $id)->update([
                    "passanger_name"    =>  $request["customer"],
                    "distance"          =>  $request["distance"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "from_address"      =>  $request["pickup_address"],
                    "pickup_lat"        =>  $request["lattitude"],
                    "pickup_lon"        =>  $request["longitude"],
                    "airport"           =>  $request["drop_address"],   
                    "drop_lat"          =>  $request["drop_lattitude"],
                    "drop_lon"          =>  $request["drop_longitude"],
                    "payment_method"    =>  $request["payment_method"],
                    "total"             =>  $request["total"],
                    "subtotal"          =>  $request["subtotal"],
                    "discount"          =>  $request["discount"],
                    "tax"               =>  $request["tax"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("trip_requests.index")->with(
                    Session::flash("message", "Trip request updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the trip request"), 
                    Session::flash("alert-class", "alert-danger"),
                );
            }
        }else{
            DB::beginTransaction();
            try{
                TripRequest::where("id", $id)->update([
                    "passanger_name"    =>  $request["customer"],
                    "distance"          =>  $request["distance"],
                    "vehicle_type"      =>  $request["vehicle_type"],
                    "from_address"      =>  $request["pickup_address"],
                    "pickup_lat"        =>  $request["lattitude"],
                    "pickup_lon"        =>  $request["longitude"],
                    "to_address"        =>  $request["drop_address"],   
                    "drop_lat"          =>  $request["drop_lattitude"],
                    "drop_lon"          =>  $request["drop_longitude"],
                    "payment_method"    =>  $request["payment_method"],
                    "total"             =>  $request["total"],
                    "subtotal"          =>  $request["subtotal"],
                    "discount"          =>  $request["discount"],
                    "tax"               =>  $request["tax"],
                    "status"            =>  $request["status"]
                ]);
                DB::commit();
                return redirect()->route("trip_requests.index")->with(
                    Session::flash("message", "Trip request updated successfully"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }catch(\Exception $e){
                DB::rollback();
                return back()->with(
                    Session::flash("message", "Cannot update the trip request"), 
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
        if(TripRequest::where("id", $id)->delete()){
            return redirect()->route("trip_requests.index")->with(
                Session::flash("message", "Trip request deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the trip request"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function trip_request_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $requests=TripRequest::orderBy("id", "desc")->get();
            return view("trips.trip_requests", compact("requests"));
        }else{
            $requests=TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
                                    ->where("trip_requests.passanger_phone", "like", "$value%")
                                    ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                    ->get(["trip_requests.passanger_name", 
                                            "manage_models.model_name",
                                            "trip_requests.passanger_phone",
                                            "trip_requests.distance",
                                            "trip_requests.from_address",
                                            "trip_requests.pickup_lat",
                                            "trip_requests.to_address",
                                            "trip_requests.payment_method",
                                            "trip_requests.total",
                                            "trip_requests.subtotal",
                                            "trip_requests.discount",
                                            "trip_requests.status",
                                            "trip_requests.tax",
                                            "trip_requests.promo",
                                            "trip_requests.type",
                                            "trip_requests.airport",

                                        ]);

            return response()->json([
                "status" => $requests
            ]);
        }
        
    }

    public function trip_request_date(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $requests=TripRequest::orderBy("id", "desc")->get();
            return view("trips.trip_requests", compact("requests"));
        }else{
            $requests=TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
                                    ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                    ->where("trip_requests.created_at", $value)
                                    ->get(["trip_requests.passanger_name", 
                                            "manage_models.model_name",
                                            "trip_requests.passanger_phone",
                                            "trip_requests.distance",
                                            "trip_requests.from_address",
                                            "trip_requests.pickup_lat",
                                            "trip_requests.to_address",
                                            "trip_requests.payment_method",
                                            "trip_requests.total",
                                            "trip_requests.subtotal",
                                            "trip_requests.discount",
                                            "trip_requests.status",
                                            "trip_requests.tax",
                                            "trip_requests.promo",
                                            "trip_requests.id",
                                            "trip_requests.type",
                                            "trip_requests.airport",
                                        ]);
            return response()->json([
                "status" => $requests
            ]);
        }
        
    }

    //assigning confirmed trips to the trips from trip requests
    public function trip_confirmed(Request $request)
    {
        $value=$request["value"];
        $id=$request["id"];
       
        TripRequest::where("id", $id)->update([
            "status"    => "Confirmed"
        ]);
        $requests=TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
                                    ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                    ->where("trip_requests.id", $id)
                                    ->get(["trip_requests.passanger_name", 
                                            "manage_models.model_name",
                                            "trip_requests.passanger_phone",
                                            "trip_requests.distance",
                                            "trip_requests.from_address",
                                            "trip_requests.pickup_lat",
                                            "trip_requests.pickup_lon",
                                            "trip_requests.to_address",
                                            "trip_requests.payment_method",
                                            "trip_requests.total",
                                            "trip_requests.subtotal",
                                            "trip_requests.discount",
                                            "trip_requests.status",
                                            "trip_requests.tax",
                                            "trip_requests.promo",
                                            "trip_requests.id",
                                            "trip_requests.type",
                                            "trip_requests.airport",
                                            "trip_requests.pickup_date",
                                            "trip_requests.pickup_time",
                                           
                                        ]);

        DB::beginTransaction();
        try{
            NewTrip::create([
                "trip_id"          =>  $id,
                "con_pass_name"    =>  $requests[0]->passanger_name,
                "phone_number"     =>  $requests[0]->passanger_phone,
                "customer_id"      =>  Customer::where("phone_number", $requests[0]->passanger_phone)->value("id"),
                "pickup_date"      =>  $requests[0]->pickup_date,
                "pickup_time"      =>  $requests[0]->pickup_time,
                "pickup_address"   =>  $requests[0]->from_address,
                "drop_address"     =>  $requests[0]->to_address,  
                "pickup_lat"       =>  $requests[0]->pickup_lat,
                "pickup_lon"       =>  $requests[0]->pickup_lon,
                "payment_method"   =>  $requests[0]->payment_method,
                "subtotal"         =>  $requests[0]->subtotal,
                "discount"         =>  $requests[0]->discount,
                "fare"             =>  $requests[0]->total,
                "status"           =>  $value
            ]);
            DB::commit();
            return response()->json([
                "status" =>  200,
             ]);
        }catch(\Exception $e){
        
            DB::rollback();
            return response()->json([
                "status" =>  400,
            ]);
        }

       

    }
}
