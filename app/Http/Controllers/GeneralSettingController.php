<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=GeneralSetting::max("id");
        $settings=GeneralSetting::where("id", $id)->get();
        return view("settings.edit_setting", compact("settings"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create()
    {
        return view("settings.add_setting");
    }
*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "site_name"         =>  "required | string ",
            "meta_title"        =>  "required",
            "meta_keyword"      =>  "required",
            "meta_description"  =>  "required",
            "website_url"       =>  "required",
            "website_logo"      =>  "required | image | mimes:jpg,png,jpeg | max:100 | dimensions:max_width=1450,max_height=1100",   
            "favicon"           =>  "required",
            "status"            =>  "required"
        ])->validate();

        $website_logo=$request->file("website_logo");
        $website_logo_name=$website_logo->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/logos/".$date;
        $website_logo->move($destination, $website_logo_name);

        $favicon=$request->file("favicon");
        $favicon_name=$favicon->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/logos/".$date;
        $favicon->move($destination, $favicon_name);
        
        $facebook_logo=$request->file("facebook_logo");
        if($facebook_logo!=null){
            $facebook_logo_name=$facebook_logo->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $facebook_logo->move($destination, $facebook_logo_name);
        }else{
            $facebook_logo_name="Not set";
        }

        $twitter_logo=$request->file("twitter_logo");
        if($twitter_logo!=null){
            $twitter_logo_name=$twitter_logo->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $twitter_logo->move($destination, $twitter_logo_name);
        }else{
            $twitter_logo_name="Not set";
        }

        $linkedin_logo=$request->file("linkedin_logo");
        if($linkedin_logo!=null){
            $linkedin_logo_name=$linkedin_logo->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $linkedin_logo->move($destination, $linkedin_logo_name);
        }else{
            $linkedin_logo_name="Not set";
        }

        $instagram_logo=$request->file("insta_logo");
        if($instagram_logo!=null){
            $instagram_logo_name=$instagram_logo->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $instagram_logo->move($destination, $instagram_logo_name);
        }else{
            $instagram_logo_name="Not set";
        }

        $youtube_logo=$request->file("youtube_logo");
        if($youtube_logo!=null){
            $youtube_logo_name=$youtube_logo->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $youtube_logo->move($destination, $youtube_logo_name);
        }else{
            $youtube_logo_name="Not set";
        }

        DB::beginTransaction();
        try{
            GeneralSetting::create([
                "site_name"         =>  $request["site_name"],
                "meta_title"        =>  $request["meta_title"],
                "meta_keyword"      =>  $request["meta_keyword"],
                "meta_description"  =>  $request["meta_description"],
                "play_store_url"    =>  $request["play_store_url"],
                "app_store_url"     =>  $request["app_store_url"],
                "email"             =>  $request["email"],
                "phone"             =>  $request["phone_number"],
                "website_url"       =>  $request["website_url"],
                "website_logo"      =>  $date.'/'.$website_logo_name,   
                "facebook_url"      =>  $request["facebook_url"],  
                "facebook_logo"     =>  $date.'/'.$facebook_logo_name,
                "twitter_url"       =>  $request["twitter_url"],  
                "twitter_logo"      =>  $date.'/'.$twitter_logo_name,
                "linkedin_url"      =>  $request["linkedin_url"],  
                "linkedin_logo"     =>  $date.'/'.$linkedin_logo_name, 
                "instagram_url"     =>  $request["insta_url"],  
                "instagram_logo"    =>  $date.'/'.$instagram_logo_name,
                "youtube_url"       =>  $request["youtube_url"],  
                "youtube_logo"      =>  $date.'/'.$youtube_logo_name,
                "favicon"           =>  $date.'/'.$favicon_name,
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("general_settings.index")->with(
                Session::flash("message", "General settings added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the general setting"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
    */
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
    /*
    public function edit($id)
    {
        $settings=GeneralSetting::where("id", $id)->get();
        return view("settings.edit_setting", compact("settings"));
    }

    */
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
            "site_name"         =>  "required | string ",
            "meta_title"        =>  "required",
            "meta_keyword"      =>  "required",
            "meta_description"  =>  "required",
            "website_url"       =>  "required",
            "address"           =>  "required",
            "phone_number"      =>  "required",
            "email"             =>  "required",
        ])->validate();

        if($request->file("website_logo")!=null){
            $validator=Validator::make($request->all(),[
                "website_logo"      =>  "required | image | mimes:jpg,png,jpeg | max:100 | dimensions:max_width=1450,max_height=1100", 
            ])->validate();

            $website_logo=$request->file("website_logo");
            $website_logo_name=$website_logo->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $website_logo->move($destination, $website_logo_name);

            GeneralSetting::where("id", $id)->update([
                "website_logo"      =>  $date.'/'.$website_logo_name,   
            ]);
        }
        
        if($request->file("favicon")!=null){

            $favicon=$request->file("favicon");
            $favicon_name=$favicon->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/logos/".$date;
            $favicon->move($destination, $favicon_name);

            GeneralSetting::where("id", $id)->update([
                "favicon"           =>  $date.'/'.$favicon_name,
            ]);
        }

        DB::beginTransaction();
        try{
            GeneralSetting::where("id", $id)->update([
                "site_name"         =>  $request["site_name"],
                "meta_title"        =>  $request["meta_title"],
                "meta_keyword"      =>  $request["meta_keyword"],
                "meta_description"  =>  $request["meta_description"],
                "play_store_url"    =>  $request["play_store_url"],
                "app_store_url"     =>  $request["app_store_url"],
                "email"             =>  $request["email"],
                "phone"             =>  $request["phone_number"],
                "website_url"       =>  $request["website_url"],
                "facebook_url"      =>  $request["facebook_url"],  
                "twitter_url"       =>  $request["twitter_url"],  
                "linkedin_url"      =>  $request["linkedin_url"],  
                "instagram_url"     =>  $request["insta_url"],  
                "youtube_url"       =>  $request["youtube_url"],  
                "address"          =>  $request["address"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("general_settings.index")->with(
                Session::flash("message", "General settings updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the general setting"), 
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
    /*
    public function destroy($id)
    {
        if(GeneralSetting::where("id", $id)->delete()){
            return redirect()->route("general_settings.index")->with(
                Session::flash("message", "General settings deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the general setting"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
    */
}
