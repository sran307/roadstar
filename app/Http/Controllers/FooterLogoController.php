<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\FooterLogo;

class FooterLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos=FooterLogo::all();
        return view("footers.edit_footer", compact("logos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("footers.add_logo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message="image size not valid";
        $validator=Validator::make($request->all(),[
            "logo"          =>  "required | image | mimes:jpg,png,jpeg | dimensions:max_width=1450,max_height=1100",   
            "details"       =>  "required",
         //   "status"        =>  "required"
        ])->validate($message);

        $logo=$request->file("logo");
        $logo_name=$logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/logos/".$date;
        $logo->move($destination, $logo_name);
        
        DB::beginTransaction();
        try{
            FooterLogo::create([
                "logo"          =>  $date.'/'.$logo_name,   
                "details"         =>  $request["details"],  
               // "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("footer_logos.index")->with(
                Session::flash("message", "Logo added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the logo"), 
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
        $logos=FooterLogo::where("id", $id)->get();
        return view("footers.edit_footer", compact("logos"));
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
        $message="image size not valid";
        $validator=Validator::make($request->all(),[
            "logo"          =>  "required | image | mimes:jpg,png,jpeg | dimensions:max_width=1450,max_height=1100",   
            "details"       =>  "required",
           // "status"        =>  "required"
        ])->validate($message);

        $logo=$request->file("logo");
        $logo_name=$logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/logos/".$date;
        $logo->move($destination, $logo_name);
        
        DB::beginTransaction();
        try{
            FooterLogo::where("id", $id)->update([
                "logo"          =>  $date.'/'.$logo_name,   
                "details"         =>  $request["details"],  
               // "status"          =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("footer_logos.index")->with(
                Session::flash("message", "Logo updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the logo"), 
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
        if(FooterLogo::where("id", $id)->delete()){
            return redirect()->route("footer_logos.index")->with(
                Session::flash("message", "Logo deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the logo"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
