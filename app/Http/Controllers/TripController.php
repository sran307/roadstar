<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    TripSetting, CancelSetting
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class TripController extends Controller
{
    public function trip_page()
    {
        $trips=TripSetting::all();
        return view("trips.trip_page", compact("trips"));
    }
    public function trip_edit($id)
    {
        $trips=TripSetting::where("id", $id)->get();
        return view("trips.trip_edit_form", compact('trips'));
    }

    public function trip_update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "commission"    =>  "required | numeric",
            "time"          =>  "required | numeric ",
            "radius"        =>  "required | numeric",
        ])->validate();
            $commission=$request["commission"];
            $time=$request["time"];
            $radius=$request["radius"];
        DB::beginTransaction();
        try{
            TripSetting::where("id", $id)->update([
                "commision" => $commission,
                "time"      => $time, 
                "radius"    => $radius,
            ]);
            DB::commit();
            return redirect()->route("trip_page")->with(
                Session::flash("message", "Trip edited successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot edit the trip"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function cancel_page()
    {
       $details=CancelSetting::all();
       return view("cancels.cancel_page", compact("details"));
    }
    public function cancel_edit($id)
    {
        $details=CancelSetting::where("id", $id)->get();
        return view("cancels.cancel_edit_form", compact('details'));
    }
    public function cancel_update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "number"  =>  "required | numeric",
            "charge"  =>  "required | numeric ",
        ])->validate();
            $number=$request["number"];
            $charge=$request["charge"];
        DB::beginTransaction();
        try{
            CancelSetting::where("id", $id)->update([
                "number"    => $number,
                "charge"    => $charge, 
            ]);
            DB::commit();
            return redirect()->route("cancel_page")->with(
                Session::flash("message", "Cancellation settings edited successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot edit the cancellation settings"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
