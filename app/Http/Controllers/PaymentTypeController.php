<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    PaymentType
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments=PaymentType::all();
        return view("payments.payment_type", compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            "payment_type"      =>  "required | string",
            "status"            =>  "required",
        ])->validate();
        
        DB::beginTransaction();
        try{
            PaymentType::create([
                "payment_type"      =>  $request["payment_type"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("payment_types.index")->with(
                Session::flash("message", "Payment type added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the payment type"), 
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
        $payments=PaymentType::where("id", $id)->get();
        return view("payments.edit_type", compact("payments"));
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
            "payment_type"      =>  "required | string",
            "status"            =>  "required",
        ])->validate();
        
        DB::beginTransaction();
        try{
            PaymentType::where("id", $id)->update([
                "payment_type"      =>  $request["payment_type"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("payment_types.index")->with(
                Session::flash("message", "Payment type updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the payment type"), 
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
        if(PaymentType::where("id", $id)->delete()){
            return redirect()->route("payment_types.index")->with(
                Session::flash("message", "Payment type deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the payment type"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
