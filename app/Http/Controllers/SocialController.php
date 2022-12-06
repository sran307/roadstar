<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    SocialIcon
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icons=SocialIcon::all();
        return view("footers.social", compact("icons"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("footers.add_social");
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
            "icon"          =>  "required | image ",   
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
            SocialIcon::create([
                "icon"          =>  $date.'/'.$logo_name,   
                "link"         =>  $request["url"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("social_icons.index")->with(
                Session::flash("message", "Social media icons added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the social media icon"), 
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
        $icons=SocialIcon::where("id", $id)->get();
        return view("footers.edit_social", compact("icons"));
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
            "icon"          =>  "required | image ",   
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
            SocialIcon::where("id", $id)->update([
                "icon"          =>  $date.'/'.$logo_name,   
                "link"         =>  $request["url"],  
                "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("social_icons.index")->with(
                Session::flash("message", "Social media icons updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the social media icon"), 
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
        if(SocialIcon::where("id", $id)->delete()){
            return redirect()->route("social_icons.index")->with(
                Session::flash("message", "Social media icons deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the social media icon"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
