<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    UserType
};
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertypes=UserType::all();
        return view("usertypes.usertype", compact("usertypes"));
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
            "user_type"      =>  "required | string",
        ])->validate();
        
        DB::beginTransaction();
        try{
            UserType::create([
                "user"      =>  $request["user_type"],
            ]);
            DB::commit();
            return redirect()->route("user_types.index")->with(
                Session::flash("message", "User type added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the User type"), 
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
        $usertypes=UserType::where("id", $id)->get();
        return view("usertypes.edit_usertype", compact("usertypes"));
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
            "user_type"      =>  "required | string",
        ])->validate();
        
        DB::beginTransaction();
        try{
            UserType::where("id", $id)->update([
                "user"      =>  $request["user_type"],
            ]);
            DB::commit();
            return redirect()->route("user_types.index")->with(
                Session::flash("message", "User type updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the User type"), 
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
        if(UserType::where("id", $id)->delete()){
            return redirect()->route("user_types.index")->with(
                Session::flash("message", "User type deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the user type"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
