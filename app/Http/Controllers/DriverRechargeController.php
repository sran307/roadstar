<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\{
    Driver, DriverRecharge
};

class DriverRechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recharges=DriverRecharge::all();
        return view("drivers.recharge", compact("recharges"));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers=Driver::all();
        return view("drivers.add_recharge", compact("drivers"));
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
            "driver"       =>  "required",
            "amount"       =>  "required",
        ])->validate();
        
        DB::beginTransaction();
        try{
            DriverRecharge::create([
                "driver"      =>  $request["driver"],
                "amount"      =>  $request["amount"],
            ]);
            DB::commit();
            return redirect()->route("driver_recharges.index")->with(
                Session::flash("message", "Driver recharge added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the driver recharge"), 
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
        $recharges=DriverRecharge::where("id", $id)->first();
        $drivers=Driver::all();
        return view("drivers.edit_recharge", compact("recharges", "drivers"));
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
            "driver"       =>  "required",
            "amount"       =>  "required",
        ])->validate();
        
        DB::beginTransaction();
        try{
            DriverRecharge::where("id", $id)->update([
                "driver"      =>  $request["driver"],
                "amount"      =>  $request["amount"],
            ]);
            DB::commit();
            return redirect()->route("driver_recharges.index")->with(
                Session::flash("message", "Driver recharge updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the driver recharge"), 
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
        if(DriverRecharge::where("id", $id)->delete()){
            return redirect()->route("driver_recharges.index")->with(
                Session::flash("message", "Driver recharge deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the driver recharge"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
