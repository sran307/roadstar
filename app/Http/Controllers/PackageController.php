<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    VehicleManagement, Country, PackageModel
};
use Illuminate\Support\Facades\{
   DB, Validator, Session
};

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=PackageModel::all();
        return view("fares.package", compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("fares.add_package");
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
            "name"          =>  "required",
            "hours"         =>  "required | numeric",
            "kilometers"    =>  "required | numeric",
        ])->validate();

        DB::beginTransaction();
        try{
            PackageModel::create([
                "name"          =>  $request["name"],
                "hours"         =>  $request["hours"],
                "kilometers"    =>  $request["kilometers"],
            ]);
            DB::commit();
            return redirect()->route("package_models.index")->with(
                Session::flash("message", "Package added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the package"), 
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
        $packages=PackageModel::all();
        return view("fares.edit_package", compact('packages'));
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
            "name"          =>  "required",
            "hours"         =>  "required | numeric",
            "kilometers"    =>  "required | numeric",
        ])->validate();

        DB::beginTransaction();
        try{
            PackageModel::where('id', $id)->update([
                "name"          =>  $request["name"],
                "hours"         =>  $request["hours"],
                "kilometers"    =>  $request["kilometers"],
            ]);
            DB::commit();
            return redirect()->route("package_models.index")->with(
                Session::flash("message", "Package updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the package"), 
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
