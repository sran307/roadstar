<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\FleetCategory;
class FleetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=FleetCategory::all();
        return view("fleets.fleet_category", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=FleetCategory::max("id")+1;
        return view("fleets.add_fleet_category", compact("id"));
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
            "code"       =>  "required ",
            "name"       =>  "required | string ",
            "image"      =>  "required | image",
           "status"      =>  "required",
        ])->validate();

        $image=$request->file("image");
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        DB::beginTransaction();
        try{
            FleetCategory::create([
                "code"              =>  $request["code"],
                "name"              =>  $request["name"],
                "image"             =>  $date.'/'.$image_name,
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("fleet_categories.index")->with(
                Session::flash("message", " Fleet category added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the fleet category"), 
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
        $category=FleetCategory::where("id", $id)->first();
        return view("fleets.edit_fleet_category", compact("category"));
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
            "code"       =>  "required ",
            "name"       =>  "required | string ",
           // "image"      =>  "required | image",
           "status"      =>  "required",
        ])->validate();

        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"      =>  "required | image",
            ])->validate();

            $image=$request->file("image");
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $image_name=$image->getClientOriginalName();
            $image->move($destination, $image_name);

            FleetCategory::where("id", $id)->update([
                "image"             =>  $date.'/'.$image_name,
            ]);
        }
       
        
        DB::beginTransaction();
        try{
            FleetCategory::where("id", $id)->update([
                "code"              =>  $request["code"],
                "name"              =>  $request["name"],
              //  "image"             =>  $date.'/'.$image_name,
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("fleet_categories.index")->with(
                Session::flash("message", " Fleet category updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the fleet category"), 
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
        if(FleetCategory::where("id", $id)->delete()){
            return redirect()->route("fleet_categories.index")->with(
                Session::flash("message", "Fleet category deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the fleet category"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
