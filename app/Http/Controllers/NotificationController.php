<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    NotificationModel, country, UserType
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages=NotificationModel::all();
        return view("messages.notification", compact("messages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        $types=UserType::all();
        return view("messages.add_notification", compact("countries", "types"));
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
            "type"         =>  "required | string ",
            "title"        =>  "required | string",
            "message"      =>  "required",   
            "image"        =>  "required | image",   
            "status"       =>  "required",
        ])->validate();
        
        $image=$request->file("image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/profile_image/".$date;
        $image->move($destination, $image_name);

        DB::beginTransaction();
        try{
            NotificationModel::create([
                "country"       =>  $request["country"],
                "type"          =>  $request["type"],
                "title"         =>  $request["title"],
                "message"       =>  $request["message"],
                "image"         =>  $date.'/'.$image_name,   
                "status"        =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("notification_models.index")->with(
                Session::flash("message", "Notification message added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the notification message"), 
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
        $types=UserType::all();
        $messages=NotificationModel::where("id", $id)->get();
        return view("messages.edit_notification", compact("messages", "countries", "types"));
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
            "type"         =>  "required | string ",
            "title"        =>  "required | string",
            "message"      =>  "required",   
            "image"        =>  "required | image",   
            "status"       =>  "required",
        ])->validate();
        
        $image=$request->file("image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/profile_image/".$date;
        $image->move($destination, $image_name);

        DB::beginTransaction();
        try{
            NotificationModel::where("id", $id)->update([
                "country"       =>  $request["country"],
                "type"          =>  $request["type"],
                "title"         =>  $request["title"],
                "message"       =>  $request["message"],
                "image"         =>  $date.'/'.$image_name,   
                "status"        =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("notification_models.index")->with(
                Session::flash("message", "Notification message updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the notification message"), 
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
        if(NotificationModel::where("id", $id)->delete()){
            return redirect()->route("notification_models.index")->with(
                Session::flash("message", "Notification message deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the notification message"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
