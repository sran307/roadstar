<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripType;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};


class TripManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips=TripType::orderBy("id", "desc")->get();
        return view("trips.trip_type_page", compact("trips"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("trips.add_trip_types");
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
            "active_icon"        =>  "required",
            "inactive_icon"      =>  "required",
            "name"          =>  "required | string",
            "status"        =>  "required",
        ])->validate();

        $active = $request->file("active_icon");
        $active_name = $active->getClientOriginalName();
        $date = date("M-Y");
        $destination = "images/icons".'/'.$date;
        $active->move($destination, $active_name);

        $inactive = $request->file("inactive_icon");
        $inactive_name = $inactive->getClientOriginalName();
        $date = date("M-Y");
        $destination = "images/icons".'/'.$date;
        $inactive->move($destination, $inactive_name);

        DB::beginTransaction();
        try{
            TripType::create([
                "active"     =>  $date.'/'.$active_name,
                "inactive"   =>  $date.'/'.$inactive_name,
                "name"       =>  $request["name"],
                "status"     =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("trip_types.index")->with(
                Session::flash("message", "Trip type added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the trip type"), 
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
        $trips=TripType::where("id", $id)->get();
        return view("trips.edit_trip_type", compact("trips"));
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
          //  "active_icon"        =>  "required",
         //   "inactive_icon"      =>  "required",
            "name"          =>  "required | string",
            "status"        =>  "required",
        ])->validate();
        
        if($request->file("active_icon")!=null){
            $validator=Validator::make($request->all(),[
                "active_icon"        =>  "required",
            ])->validate();

            $active = $request->file("active_icon");
            $active_name = $active->getClientOriginalName();
            $date = date("M-Y");
            $destination = "images/icons".'/'.$date;
            $active->move($destination, $active_name);
            
            TripType::where("id", $id)->update([
                "active"     =>  $date.'/'.$active_name,
            ]);
        }
        
        if( $request->file("inactive_icon")!=null){
            $validator=Validator::make($request->all(),[
                  "inactive_icon"      =>  "required",
              ])->validate();

            $inactive = $request->file("inactive_icon");
            $inactive_name = $inactive->getClientOriginalName();
            $date = date("M-Y");
            $destination = "images/icons".'/'.$date;
            $inactive->move($destination, $inactive_name);

            TripType::where("id", $id)->update([
                "inactive"   =>  $date.'/'.$inactive_name,
              ]);
        }

        DB::beginTransaction();
        try{
            TripType::where("id", $id)->update([
              //  "active"     =>  $date.'/'.$active_name,
              //  "inactive"   =>  $date.'/'.$inactive_name,
                "name"       =>  $request["name"],
                "status"     =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("trip_types.index")->with(
                Session::flash("message", "Trip type updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the trip type"), 
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
        if(TripType::where("id", $id)->delete()){
            return redirect()->route("trip_types.index")->with(
                Session::flash("message", "Trip type deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the trip type"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function trip_type_date_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $trips=TripType::orderBy("id", "desc")->get();
            return view("trips.trip_type_page", compact("trips"));
        }else{
            $trip_types=TripType::where("created_at", $value)->get();
            return response()->json([
                "status" => $trip_types
            ]);
        }

    }
}
