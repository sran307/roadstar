<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\{
    MessageModel
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages=MessageModel::all();
        return view("messages.message", compact("messages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "code"      =>  "required | string",
            "message"    =>  "required | string",
        ])->validate();
        
        DB::beginTransaction();
        try{
            MessageModel::create([
                "code"      =>  $request["code"],
                "message"    =>  $request["message"]
            ]);
            DB::commit();
            return redirect()->route("message_models.index")->with(
                Session::flash("message", "Message added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the Message"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $messages=MessageModel::where("id", $id)->get();
        return view("messages.edit_message", compact("messages"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "code"      =>  "required | string",
            "message"    =>  "required | string",
        ])->validate();
        
        DB::beginTransaction();
        try{
            MessageModel::where("id", $id)->update([
                "code"      =>  $request["code"],
                "message"    =>  $request["message"]
            ]);
            DB::commit();
            return redirect()->route("message_models.index")->with(
                Session::flash("message", "Message updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the Message"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(MessageModel::where("id", $id)->delete()){
            return redirect()->route("message_models.index")->with(
                Session::flash("message", "Message deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the message"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
