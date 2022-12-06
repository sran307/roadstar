<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\FooterService;

class FooterServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = FooterService::all();
        return view("footers.service", compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("footers.add_service");
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
            "icon"          =>  "required | image",   
            "url"       =>  "required",
            "status"        =>  "required"
        ])->validate();

        $logo=$request->file("icon");
        $logo_name=$logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $logo->move($destination, $logo_name);
        
        DB::beginTransaction();
        try{
            FooterService::create([
                "name"          =>  $request['name'],
                "icon"          =>  $date.'/'.$logo_name,   
                "link"         =>  $request["url"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("footer_services.index")->with(
                Session::flash("message", "Service added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the Service"), 
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
        $services = FooterService::where("id", $id)->get();
        return view("footers.edit_service", compact("services"));
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
            "icon"          =>  "required | image",   
            "url"       =>  "required",
            "status"        =>  "required"
        ])->validate();

        $logo=$request->file("icon");
        $logo_name=$logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/icons/".$date;
        $logo->move($destination, $logo_name);
        
        DB::beginTransaction();
        try{
            FooterService::where("id", $id)->update([
                "name"          =>  $request['name'],
                "icon"          =>  $date.'/'.$logo_name,   
                "link"         =>  $request["url"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("footer_services.index")->with(
                Session::flash("message", "Service updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the Service"), 
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
        if(FooterService::where("id", $id)->delete()){
            return redirect()->route("footer_services.index")->with(
                Session::flash("message", "Service deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the service"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
