<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    TripRequest,
    NewTrip,
    Driver
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class ReportController extends Controller
{
    //trip report
    public function trip_report()
    {
        $from_date=date("Y-m-d");
        $to_date="";
        $details=TripRequest::where("created_at", $from_date)->orderBy("id", "desc")->get();
       
        return view("reports.trip_report", compact("details", "from_date", "to_date"));
    }

    //trip record fetching
    public function trip_detail(Request $request)
    {
        $from_date=$request["from_date"];
        $to_date=$request["to_date"];

        $validator=Validator::make($request->all(),[
            "from_date"    =>  "required",
            "to_date"      =>  "required",
        ])->validate();

        $details=TripRequest::whereBetween("created_at", [$from_date, $to_date])->orderBy("id", "desc")->get();
       
        return view("reports.trip_report", compact("details", "from_date", "to_date"));
    }
    //transaction report
    public function transaction_report()
    {
        $from_date="";
        $to_date="";
        $details=TripRequest::where("created_at", $from_date)->orderBy("id", "desc")->get();
        return view("reports.transaction_report", compact("details", "from_date", "to_date"));
    }

    //transaction details
    public function transaction_detail(Request $request)
    {
        $from_date=$request["from_date"];
        $to_date=$request["to_date"];

        $validator=Validator::make($request->all(),[
            "from_date"    =>  "required",
            "to_date"      =>  "required",
        ])->validate();

        $details=TripRequest::whereBetween("created_at", [$from_date, $to_date])->orderBy("id", "desc")->get();
       
        return view("reports.transaction_report", compact("details", "from_date", "to_date"));
    }

    //driver report
    public function driver_report()
    {
        $from_date=date("Y-m-d");
        $to_date="";
        $details=NewTrip::where("created_at", $from_date)->get();
        $drivers=Driver::all();
        return view("reports.driver_report", compact("details", "from_date", "to_date", "drivers"));
    }
    //driver report details
    public function driver_detail(Request $request)
    {
        $from_date=$request["from_date"];
        $to_date=$request["to_date"];

        $validator=Validator::make($request->all(),[
            "from_date"    =>  "required",
            "to_date"      =>  "required",
        ])->validate();
        $drivers=Driver::all();
        $details=NewTrip::whereBetween("created_at", [$from_date, $to_date])->get();
        return view("reports.driver_report", compact("details", "from_date", "to_date", "drivers"));
    } 

    //driver select
    public function driver_select(Request $request)
    {
        $id=$request["id"];

        $drivers=Driver::join("driver_vehicles", "driver_vehicles.driver_id", "=", "drivers.id")
                ->where("drivers.id", $id)->get();

        return response()->json([
            "status"=>$drivers
        ]);
    }
}
