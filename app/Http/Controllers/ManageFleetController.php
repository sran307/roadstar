<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\{
    ManageBrand,
    ManageFleet,
    FleetCategory,
    ManageModel
};
class ManageFleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fleets=ManageFleet::all();
        return view("fleets.manage_fleet", compact("fleets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=FleetCategory::all();
        $brands=ManageBrand::all();
        $models=ManageModel::all();
        return view("fleets.add_manage_fleet", compact("categories", "brands", "models"));
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
            "vehicle_code"          =>  "required | string ",
            "title"                 =>  "required | string ",
            "category"              =>  "required | string ",
            "brand"                 =>  "required",
            "image"                 =>  "required | image ",   
            "front_image"           =>  "required | image ",   
            "rear_image"            =>  "required | image ",   
            "side_image"            =>  "required | image ",   
            "model"                 =>  "required ",
            "date_of_registration"  =>  "required | date",
            "date_of_renewal"       =>  "required | date",
            "variant"               =>  "required",
            "bags"                  =>  "required",
            "travel_type"           =>  "required",
           "chase_number"           =>  "required",
            "vehicle_number"        =>  "required",
            "seating_capacity"      =>  "required | numeric",
            "ac"                    =>  "required ",
            "features"              =>  "required",
            "status"                =>  "required",
        ])->validate();

        $image=$request->file("image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $image->move($destination, $image_name);

        $fimage=$request->file("front_image");
        $fimage_name=$fimage->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $fimage->move($destination, $fimage_name);

        $rimage=$request->file("rear_image");
        $rimage_name=$rimage->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $rimage->move($destination, $rimage_name);

        $simage=$request->file("side_image");
        $simage_name=$simage->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $simage->move($destination, $simage_name);

        DB::beginTransaction();
        try{
            ManageFleet::create([
                "code"              =>  $request["vehicle_code"],
                "title"             =>  $request["title"],
                "category"          =>  $request["category"],
                "brand"             =>  $request["brand"],
                "model"             =>  $request["model"],
                "variant"           =>  $request["variant"],
                "vehicle_number"    =>  $request["vehicle_number"],
                "chase_number"      =>  $request["chase_number"],
                "date_registration" =>  $request["date_of_registration"],
                "date_renewal"      =>  $request["date_of_renewal"],
                "seating"           =>  $request["seating_capacity"],
                "ac"                =>  $request["ac"],
                "bags"              =>  $request["bags"],
                "travel_type"       =>  $request["travel_type"],
                "features"          =>  $request["features"],
                "image"             =>  $date.'/'.$image_name,
                "front_image"       =>  $date.'/'.$fimage_name, 
                "rear_image"        =>  $date.'/'.$rimage_name, 
                "side_image"        =>  $date.'/'.$simage_name,
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("manage_fleets.index")->with(
                Session::flash("message", "Fleet added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the fleet"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=FleetCategory::all();
        $brands=ManageBrand::all();
        $fleet=ManageFleet::where("id", $id)->first();
        $models=ManageBrand::find($fleet->brand)->models;
        return view("fleets.edit_manage_fleet", compact("categories", "brands", "models", "fleet"));
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
            "vehicle_code"          =>  "required | string ",
            "title"                 =>  "required | string ",
            "category"              =>  "required | string ",
            "brand"                 =>  "required",
            //"image"                 =>  "required | image ",   
           // "front_image"           =>  "required | image ",   
            //"rear_image"            =>  "required | image ",   
           // "side_image"            =>  "required | image ",   
            "model"                 =>  "required ",
            "date_of_registration"  =>  "required | date",
            "date_of_renewal"       =>  "required | date",
            "variant"               =>  "required",
           "chase_number"           =>  "required",
            "vehicle_number"        =>  "required",
            "seating_capacity"      =>  "required | numeric",
            "ac"                    =>  "required ",
            "bags"                  =>  "required ",
            "travel_type"           =>  "required ",
            "features"              =>  "required",
            "status"                =>  "required",
        ])->validate();

        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
               "image"                 =>  "required | image ",   
            ])->validate();

            $image=$request->file("image");
            $image_name=$image->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $image->move($destination, $image_name);

            ManageFleet::where("id", $id)->update([
               "image"             =>  $date.'/'.$image_name,
            ]);
        }
        
        if($request->file("front_image")!=null){
            $validator=Validator::make($request->all(),[
               "front_image"                 =>  "required | image ",   
            ])->validate();

            $fimage=$request->file("front_image");
            $fimage_name=$fimage->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $fimage->move($destination, $fimage_name);

            ManageFleet::where("id", $id)->update([
               "front_image"             =>  $date.'/'.$fimage_name,
            ]);
        }

        if($request->file("rear_image")!=null){
            $validator=Validator::make($request->all(),[
               "rear_image"                 =>  "required | image ",   
            ])->validate();

            $rimage=$request->file("rear_image");
            $rimage_name=$rimage->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $rimage->move($destination, $rimage_name);


            ManageFleet::where("id", $id)->update([
               "rear_image"             =>  $date.'/'.$rimage_name,
            ]);
        }

        if($request->file("side_image")!=null){
            $validator=Validator::make($request->all(),[
               "side_image"                 =>  "required | image ",   
            ])->validate();

            $simage=$request->file("side_image");
            $simage_name=$simage->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $simage->move($destination, $simage_name);



            ManageFleet::where("id", $id)->update([
               "side_image"             =>  $date.'/'.$simage_name,
            ]);
        }
        
        DB::beginTransaction();
        try{
            ManageFleet::where("id", $id)->update([
                "code"              =>  $request["vehicle_code"],
                "title"             =>  $request["title"],
                "category"          =>  $request["category"],
                "brand"             =>  $request["brand"],
                "model"             =>  $request["model"],
                "variant"           =>  $request["variant"],
                "vehicle_number"    =>  $request["vehicle_number"],
                "chase_number"      =>  $request["chase_number"],
                "date_registration" =>  $request["date_of_registration"],
                "date_renewal"      =>  $request["date_of_renewal"],
                "seating"           =>  $request["seating_capacity"],
                "ac"                =>  $request["ac"],
                "bags"              =>  $request["bags"],
                "travel_type"       =>  $request["travel_type"],
                "features"          =>  $request["features"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("manage_fleets.index")->with(
                Session::flash("message", "Fleet updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the fleet"), 
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
        if(ManageFleet::where("id", $id)->delete()){
            return redirect()->route("manage_fleets.index")->with(
                Session::flash("message", "Fleet deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the fleet"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function fleet_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $fleets=ManageFleet::paginate(10);
            return view("fleets.manage_fleet", compact("fleets"));
        }else{
            $fleets=ManageFleet::join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                ->where("manage_models.model_name", "like", "$value%")
                                ->join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                ->join("fleet_categories", "fleet_categories.id", "=", "manage_fleets.category")
                                ->get([
                                    "manage_models.model_name", 
                                    "manage_brands.brand_name", 
                                    "fleet_categories.name", 
                                    "manage_fleets.title",
                                    "manage_fleets.vehicle_number",
                                    "manage_fleets.image",
                                    "manage_fleets.ac",
                                    "manage_fleets.seating",
                                    "manage_fleets.features",
                                    "manage_fleets.status",
                                    "manage_fleets.id",
                                    "manage_fleets.bags",
                                    "manage_fleets.travel_type"
                                ]);
            return response()->json([
                "status"=>$fleets,
            ]);
        }
    }

    public function fleet_delete($id)
    {
        
        if(ManageFleet::where("id", $id)->delete()){
            return redirect()->route("manage_fleets.index")->with(
                Session::flash("message", "Fleet deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the fleet"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }

    }

    public function fetch_model(Request $request)
    {
        $id=$request["id"];
        $models=ManageBrand::find($id)->models;
        return response()->json([
            "status"=>$models
        ]);
    }
}
