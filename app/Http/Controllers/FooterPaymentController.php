<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\FooterPayment;
class FooterPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments=FooterPayment::all();
        return view("footers.payment", compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("footers.add_payment");
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
            "logo"          =>  "required | image",   
            "status"        =>  "required"
        ])->validate();

        $logo=$request->file("logo");
        $logo_name=$logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $logo->move($destination, $logo_name);
        
        DB::beginTransaction();
        try{
            FooterPayment::create([
                "icon"          =>  $date.'/'.$logo_name,   
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("footer_payments.index")->with(
                Session::flash("message", "Payment logo added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the payment logo"), 
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
        $payments=FooterPayment::where("id", $id)->get();
        return view("footers.edit_payment", compact("payments"));
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
            "icon"          =>  "required | image",   
            "status"        =>  "required"
        ])->validate();

        $logo=$request->file("icon");
        $logo_name=$logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $logo->move($destination, $logo_name);
        
        DB::beginTransaction();
        try{
            FooterPayment::where("id", $id)->update([
                "icon"          =>  $date.'/'.$logo_name,   
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("footer_payments.index")->with(
                Session::flash("message", "Payment logo updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the payment logo"), 
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
        if(FooterPayment::where("id", $id)->delete()){
            return redirect()->route("footer_payments.index")->with(
                Session::flash("message", "Payment logo deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the payment logo"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
