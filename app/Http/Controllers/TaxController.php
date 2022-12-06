<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    TaxModel, country
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes=TaxModel::all();
        return view("taxes.tax", compact("taxes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        return view("taxes.add_tax", compact("countries"));
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
            "country"      =>  "required",
            "name"         =>  "required | string ",
            "percent"      =>  "required | numeric",
            "status"       =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            TaxModel::create([
                "country"        =>  $request["country"],
                "name"         =>  $request["name"],
                "percent"      =>  $request["percent"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("tax_models.index")->with(
                Session::flash("message", "Tax List added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the tax list"), 
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
        $countries=country::all();
        $taxes=TaxModel::where("id", $id)->get();
        return view("taxes.edit_tax", compact("taxes", "countries"));
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
            "country"      =>  "required",
            "name"         =>  "required | string ",
            "percent"      =>  "required | numeric",
            "status"       =>  "required",
        ])->validate();

        DB::beginTransaction();
        try{
            TaxModel::where("id", $id)->update([
                "country"        =>  $request["country"],
                "name"         =>  $request["name"],
                "percent"      =>  $request["percent"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("tax_models.index")->with(
                Session::flash("message", "Tax List updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the tax list"), 
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
        if(taxModel::where("id", $id)->delete()){
            return redirect()->route("tax_models.index")->with(
                Session::flash("message", "Tax List deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the tax list"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
