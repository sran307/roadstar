<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function contact_setting()
    {
        $contacts = ContactModel::all();
        return view("contacts.contact_page", compact("contacts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("contacts.add_contact");
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
            "phone_number"  =>  "required | digits:10",
            "email"         =>  "required | email| unique:contact_models",
            "address"       =>  "required",
            "lat"           =>  "required | numeric",
            "lng"          =>  "required | numeric",
        ])->validate();

        DB::beginTransaction();
        try{
            ContactModel::create([
                "phone_number"  =>  $request["phone_number"],
                "email"         =>  $request["email"],
                "address"       =>  $request["address"],
                "lat"           =>  $request["lat"],
                "lng"          =>  $request["lng"]
            ]);
            DB::commit();
            return redirect()->route("contact_setting")->with(
                Session::flash("message", "Contact added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the Contact"), 
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
        $contacts =ContactModel::where("id", $id)->get();
        return view("contacts.edit_contact", compact('contacts'));
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
            "phone_number"  =>  "required | digits:10",
            "email"         =>  "required | email| ",
            "address"       =>  "required",
            "lat"           =>  "required | numeric",
            "lng"          =>  "required | numeric",
        ])->validate();
            $phone=$request["phone_number"];
            $email=$request["email"];
            $address=$request["address"];
            $lat=$request["lat"];
            $lng=$request["lng"];
        DB::beginTransaction();
        try{
            ContactModel::where("id", $id)->update([
                "phone_number"  => $phone,
                "email"         => $email, 
                "address"       => $address,
                "lat"           => $lat,
                "lng"          =>  $lng
            ]);
            DB::commit();
            return redirect()->route("contact_setting")->with(
                Session::flash("message", "Contact edited successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot edit the Contact"), 
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
        if(ContactModel::where("id", $id)->delete()){
            return redirect()->route("contact_setting")->with(
                Session::flash("message", "Contact deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the contact"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
