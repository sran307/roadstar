<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\{
    ManageBrand,
    ManageModel
};
class ManageModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $models=ManageModel::all();
       return view("fleets.models", compact("models"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=ManageBrand::all();
        return view("fleets.add_models", compact("brands"));
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
            "model_number"  =>  "required ",
            "model_name"    =>  "required | string ",
            "year"          =>  "required",
            "brand"         =>  "required",
            "image"         =>  "required | image",
           "status"         =>  "required",
        ])->validate();

        $image=$request->file("image");
        $date=date("M-Y");
        $destination="images/fleets/".$date;
        $image_name=$image->getClientOriginalName();
        $image->move($destination, $image_name);
        
        DB::beginTransaction();
        try{
            ManageModel::create([
                "model_number"      =>  $request["model_number"],
                "model_name"        =>  $request["model_name"],
                "year"              =>  $request["year"],
                "brand"             =>  $request["brand"],
                "image"             =>  $date.'/'.$image_name,
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("manage_models.index")->with(
                Session::flash("message", " Model added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the model"), 
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
        $brands=ManageBrand::all();
        $model=ManageModel::where("id", $id)->first();
        return view("fleets.edit_models", compact("brands", "model"));
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
            "model_number"  =>  "required ",
            "model_name"    =>  "required | string ",
            "year"          =>  "required",
            "brand"         =>  "required",
           // "image"         =>  "required | image",
           "status"         =>  "required",
        ])->validate();

        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"         =>  "required | image",
            ])->validate();

            $image=$request->file("image");
            $date=date("M-Y");
            $destination="images/fleets/".$date;
            $image_name=$image->getClientOriginalName();
            $image->move($destination, $image_name);

            ManageModel::where("id", $id)->update([
                "image"             =>  $date.'/'.$image_name,
            ]);
        }
        
        
        DB::beginTransaction();
        try{
            ManageModel::where("id", $id)->update([
                "model_number"      =>  $request["model_number"],
                "model_name"        =>  $request["model_name"],
                "year"              =>  $request["year"],
                "brand"             =>  $request["brand"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("manage_models.index")->with(
                Session::flash("message", " Model updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the model"), 
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
        if(ManageModel::where("id", $id)->delete()){
            return redirect()->route("manage_models.index")->with(
                Session::flash("message", "Model deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the model"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
