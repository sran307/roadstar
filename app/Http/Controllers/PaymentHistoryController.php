<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    PaymentHistory, NewTrip
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class PaymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments=PaymentHistory::all();
        return view("payments.history", compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trips= NewTrip::all();
        return view("payments.add_history", compact("trips"));
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
            "trip"      =>  "required",
            "mode"      =>  "required",
            "amount"    =>  "required | numeric"
        ])->validate();
        
        DB::beginTransaction();
        try{
            PaymentHistory::create([
                "trip_id"      =>  $request["trip"],
                "mode"         =>  $request["mode"],
                "amount"        =>  $request["amount"]
            ]);
            DB::commit();
            return redirect()->route("payment_histories.index")->with(
                Session::flash("message", "Payment history added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the payment history"), 
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
        $trips= NewTrip::all();
        $payments=PaymentHistory::where("id", $id)->get();
        return view("payments.edit_history", compact("trips", "payments"));
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
            "trip"      =>  "required",
            "mode"      =>  "required",
            "amount"    =>  "required | numeric"
        ])->validate();
        
        DB::beginTransaction();
        try{
            PaymentHistory::where("id", $id)->update([
                "trip_id"      =>  $request["trip"],
                "mode"         =>  $request["mode"],
                "amount"        =>  $request["amount"]
            ]);
            DB::commit();
            return redirect()->route("payment_histories.index")->with(
                Session::flash("message", "Payment history updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the payment history"), 
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
        if(PaymentHistory::where("id", $id)->delete()){
            return redirect()->route("payment_histories.index")->with(
                Session::flash("message", "Payment history deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the payment history"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
