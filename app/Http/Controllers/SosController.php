<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    SosModel, Customer
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class SosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=SosModel::all();
        return view("customers.sos_page", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        return view("customers.add_sos", compact("customers"));
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
            "customer"          =>  "required | string ",
            "name"              =>  "required | string ",
            "phone_number"      =>  "required | digits:10 |unique:sos_models",
            "status"            =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            SosModel::create([
                "customer_id"       =>  $request["customer"],
                "name"              =>  $request["name"],
                "phone_number"      =>  $request["phone_number"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("sos_models.index")->with(
                Session::flash("message", "Customer added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the customer"), 
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
        $sosers=SosModel::where("id", $id)->get();
        $customers=Customer::all();
        return view("customers.edit_sos", compact("customers", "sosers"));
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
            "customer"          =>  "required | string ",
            "name"              =>  "required | string ",
            "phone_number"      =>  "required | digits:10",
            "status"            =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            SosModel::where("id", $id)->update([
                "customer_id"       =>  $request["customer"],
                "name"              =>  $request["name"],
                "phone_number"      =>  $request["phone_number"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("sos_models.index")->with(
                Session::flash("message", "Customer updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the customer"), 
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
