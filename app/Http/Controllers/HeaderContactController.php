<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    HeaderContact
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class HeaderContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts=HeaderContact::all();
        return view("header.contact", compact("contacts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("header.add_contact");
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
            "name"        =>  "required | string",
            "details"     =>  "required",   
            "icon"        =>  "required",   
            "status"      =>  "required",
        ])->validate();
        
        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);

        DB::beginTransaction();
        try{
            HeaderContact::create([
                "name"         =>  $request["name"],
                "details"      =>  $request["details"],
                "icon"         =>  $date.'/'.$icon_name,   
                "status"       =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("header_contacts.index")->with(
                Session::flash("message", "Data added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->withInput()->with(
                Session::flash("message", "Cannot add the data"), 
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
        $contacts=HeaderContact::where("id", $id)->get();
        return view("header.edit_contact", compact("contacts"));
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
            "name"        =>  "required | string",
            "details"     =>  "required",   
            "icon"        =>  "required",   
            "status"      =>  "required",
        ])->validate();
        
        $icon=$request->file("icon");
        $icon_name=$icon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $icon->move($destination, $icon_name);

        DB::beginTransaction();
        try{
            HeaderContact::where("id", $id)->update([
                "name"         =>  $request["name"],
                "details"      =>  $request["details"],
                "icon"         =>  $date.'/'.$icon_name,   
                "status"       =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("header_contacts.index")->with(
                Session::flash("message", "Data updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the data"), 
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
        if(HeaderContact::where("id", $id)->delete()){
            return redirect()->route("header_contacts.index")->with(
                Session::flash("message", "Data deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the data"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
