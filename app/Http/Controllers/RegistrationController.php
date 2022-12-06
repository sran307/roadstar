<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    User, AppDetail};

class RegistrationController extends Controller
{
    public function login()
    {
        $image=AppDetail::where("id",1)->value("login_image");
        return view("layouts.login", compact("image"));
    }
    public function login_form(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "email"=>"required",
            "password"=>"required"
        ])->validate();
        $email=$request["email"];
        $password=md5($request["password"]);
        $data=User::where("email",$email)->get();
        if(count($data)>0)
        {
            foreach($data as $value)
            {
                $id=$value["id"];
                $name=$value["name"];
                $role_id=$value->role;
                $user_password=$value->password;
            }
            if(($role_id==1) && ($password==$user_password)){
                session()->put(["login_id"=>$id, "name"=>$name, "role"=>$role_id]);
                return redirect()->route("dashboard")->with(
                    Session::flash("message", "login successfull"), 
                    Session::flash("alert-class", "alert-success")
                );
            }else if(($role_id==0) && ($password==$user_password)){
                session()->put(["login_id"=>$id, "name"=>$name, "role"=>$role_id]);
                return redirect()->route("user_page")->with(
                    Session::flash("message", "login successfull"), 
                    Session::flash("alert-class", "alert-success"),
                );
            }else if($password!=$user_password){
                return back()->with(
                    Session::flash("message", "Password is not matching"),
                    Session::flash("alert-class", "alert-danger")    
                );
            }
        }else{
            Session::flash("message", "login failed");
            return back();
        }
    }
    public function admin_page()
    {
        return view("layouts.dashboard");
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route("login")->with(
            Session::flash("message", "logout successfull"), 
            Session::flash("alert-class", "alert-success")
        );
    }
    public function profile()
    {
        $data = User::where("role",1)->get();
        foreach($data as $value){
            $password=$value->password_salt;
        }
        $decrypt_password=substr($password, 2-strlen($password), -2);
        return view("layouts.admin_profile", compact(['data', 'decrypt_password']));
    }
    public function update_profile(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "name"          =>  "required | string",
            "email"         =>  "required | email",
            "password"      =>  "required",
            "phone_number"  =>   "required | digits:10",
        ])->validate();
        
        if($request->file("image")!=null){
            $validator=Validator::make($request->all(),[
                "image"     =>    "required | image",
            ])->validate();

            $image=$request->file("image");
            $image_name=$image->getClientOriginalName();
            $destination="images/profile_image/";
            $image->move($destination, $image_name);

            User::where("id", $id)->update([
                "image"=>$image_name
            ]);
        }
       
        
        $password=$request["password"];
        $prefix="ro";
        $suffix="ar";
        $password_salt=$prefix.$password.$suffix;
        $update=User::where("id", $id)->update([
            "user_first_name"   =>  $request["name"],
            "email"             =>  $request["email"],
            "password"          =>  md5($password),
            "password_salt"     =>  $password_salt,
            "phone_number"      =>  $request["phone_number"],
        ]);
        if(!$update){
            return back()->with(
                Session::flash("message", "Cannot update the profile"), 
                Session::flash("alert-class", "alert-danger")
            );
        }else{
            return redirect()->route("profile")->with(
                Session::flash("message", "profile updated successfully."), 
                Session::flash("alert-class", "alert-success")
            );
        }
    }
    public function app_details()
    {
        $data=AppDetail::all();
        return view("app_page", compact("data"));
    }
    public function edit_app($id)
    {
        $data=AppDetail::where("id",$id)->get();
        return view("app_form", compact("data"));
    }
    public function app_update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "name"      =>  "required | string",
            "logo"     =>  "required | image",
            "version"  =>  "required | numeric",
            "currency"=>    "required ",
            "login_image"     =>  "required | image",
            "symbol"     =>  "required",
            "about"     =>  "required ",
            "amount"     =>  "required | numeric",
            "lattitude"     =>  "required | numeric",
            "longitude"     =>  "required | numeric",
        ])->validate();

        $logo=$request->file("logo");
        $logo_name=$logo->getClientOriginalName();
        $destination="images/logos/";
        $logo->move($destination, $logo_name);

        $image=$request->file("login_image");
        $image_name=$image->getClientOriginalName();
        $destination="images/logos/";
        $image->move($destination, $image_name);

        $update=AppDetail::where("id", $id)->update([
            "name"=>$request["name"],
            "logo"=>$logo_name,
            "version"=>$request["version"],
            "currency"=>$request["currency"],
            "login_image"=>$image_name,
            "symbol"=>$request["symbol"],
            "about"=>$request["about"],
            "lattitude"=>$request["lattitude"],
            "longitude"=>$request["longitude"],
        ]);
        if($update){
            return redirect()->route("app_details")->with(
                Session::flash("message", "update successfull"), 
                Session::flash("alert-class", "alert-success"),
            );
        }
    }
}
