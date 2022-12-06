<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\HeadingModel;

class HeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles=HeadingModel::all();
        return view("titles.title",compact("titles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("titles.add_titles");
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
            "title"        =>  "required | string ",
            //"sub_title"        =>  "required | string ",
            //"status"        =>  "required | string ",
        ])->validate();

        DB::beginTransaction();
        try{
            HeadingModel::create([
                "main_heading"      =>  $request["title"],
                "sub_heading"       =>  $request["sub_title"],
               // "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("heading_models.index")->with(
                Session::flash("message", "Title added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the title"), 
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
        $titles=HeadingModel::where("id", $id)->get();
        return view("titles.edit_titles",compact("titles"));
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
            "title"        =>  "required | string ",
            //"sub_title"        =>  "required | string ",
           // "status"        =>  "required | string ",
        ])->validate();

        DB::beginTransaction();
        try{
            HeadingModel::where("id", $id)->update([
                "main_heading"      =>  $request["title"],
                "sub_heading"       =>  $request["sub_title"],
               // "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("heading_models.index")->with(
                Session::flash("message", "Title updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the title"), 
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
        if(HeadingModel::where("id", $id)->delete()){
            return redirect()->route("heading_models.index")->with(
                Session::flash("message", "Title deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the title"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
