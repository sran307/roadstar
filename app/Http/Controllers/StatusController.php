<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    StatusModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses=StatusModel::all();
        return view("statuses.status", compact("statuses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("statuses.add_status");
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
            "status"    =>  "required | string",
         //   "name"      =>  "required | string",
        ])->validate();
        
        DB::beginTransaction();
        try{
            StatusModel::create([
                "status"      =>  $request["status"],
              //  "name"         =>  $request["name"],
            ]);
            DB::commit();
            return redirect()->route("status_models.index")->with(
                Session::flash("message", "Booking status added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the booking status"), 
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
        $statuses=StatusModel::where("id", $id)->get();
        return view("statuses.edit_status", compact("statuses"));
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
            "status"    =>  "required | string",
           // "name"      =>  "required | string",
        ])->validate();
        
        DB::beginTransaction();
        try{
            StatusModel::where("id", $id)->update([
                "status"      =>  $request["status"],
              //  "name"         =>  $request["name"],
            ]);
            DB::commit();
            return redirect()->route("status_models.index")->with(
                Session::flash("message", "Booking status updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the booking status"), 
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
        
    }
}
