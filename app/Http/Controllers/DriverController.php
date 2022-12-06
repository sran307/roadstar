<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    DB, Validator, Session
};
use App\Models\{
    Driver, country, DriverVehicle, vehicle, ManageModel
};

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers=Driver::all();
        return view("drivers.driver_page", compact("drivers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=country::all();
        return view("drivers.add_driver", compact("countries"));
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
            "first_name"        =>  "required | string ",
            "last_name"         =>  "required | string ",
            "gender"            =>  "required | string ",
            "phone_number"      =>  "required | digits:10 | unique:drivers",
            "email"             =>  "required | email | unique:drivers",
            "password"          =>  "required | min:6 | regex:/[a-zA-z]/",
            "image"             =>  "required | image ",   
           // "adhar_image"       =>  "required | image ",
            "number"            =>  "required | digits:12",
            "dob"               =>  "required | date",
            "license_number"    =>  "required",
            "id_proof"          =>  "required| image ",
            "address"           =>  "required",
            "country"           =>  "required",
            "currency"          =>  "required",
            "commission"        =>  "required",
            "daily"             =>  "required ",
            "rental"            =>  "required",
            "outstation"        =>  "required",
            "rating"            =>  "required",
            "commission_type"   =>  "required",
            "status"            =>  "required",
        ])->validate();

        if($request["rating"]>5 || $request["rating"]<0){
            return back()->withInput()->with(
                Session::flash("message", "Please enter a valid rating"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
        $password=$request["password"];
        $suffix="ar";
        $prefix="ro";
        $enc_password=$suffix.$password.$prefix;

        $image=$request->file("image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/profile_image/".$date;
        $image->move($destination, $image_name);

      /*  $adhar_image=$request->file("adhar_image");
        $adhar_image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/aadhar"."/".$date;
        $adhar_image->move($destination, $adhar_image_name);*/

        $id_image=$request->file("id_proof");
        $id_image_name=$id_image->getClientOriginalName();
        $destination="images/id"."/".$date;
        $id_image->move($destination, $id_image_name);

        DB::beginTransaction();
        try{
            Driver::create([
                "first_name"        =>  $request["first_name"],
                "last_name"         =>  $request["last_name"],
                "gender"            =>  $request["gender"],
                "phone_number"      =>  $request["phone_number"],
                "email"             =>  $request["email"],
                "password"          =>  md5($password),
                "password_salt"     =>  $enc_password,
                "image"             =>  $date.'/'.$image_name,   
          //      "aadhar_image"      =>  $date.'/'.$adhar_image_name,
                "aadhar"            =>  $request["number"],
                "dob"               =>  $request["dob"],
                "license_number"    =>  $request["license_number"],
                "id_image"          =>  $date.'/'.$id_image_name,
                "address"           =>  $request["address"],
                "country"           =>  $request["country"],
                "currency"          =>  $request["currency"],
                "commission"        =>  $request["commission"],
                "daily"             =>  $request["daily"],
                "rental"            =>  $request["rental"],
                "rating"            =>  $request["rating"],
                "outstation"        =>  $request["outstation"],
                "comm_type"         =>  $request["commission_type"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("drivers.index")->with(
                Session::flash("message", "driver added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->withInput()->with(
                Session::flash("message", "Cannot add the driver"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drivers=Driver::where("id", $id)->get();
        $user_password=Driver::where("id", $id)->value("password_salt");
        $password=substr($user_password, 2-strlen($user_password), -2);
        $countries=country::all();
        return view("drivers.edit_driver", compact("drivers", "password", "countries"));
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
            "first_name"        =>  "required | string ",
            "last_name"         =>  "required | string ",
            "gender"            =>  "required | string ",
            "phone_number"      =>  "required | digits:10",
            "email"             =>  "required | email ",
            "password"          =>  "required | min:6 | regex:/[a-zA-z]/",
          //  "image"             =>  "required | image ",   
           // "adhar_image"       =>  "required | image ",
            "number"            =>  "required | digits:12",
            "dob"               =>  "required | date",
            "license_number"    =>  "required",
         //   "id_proof"          =>  "required| image ",
            "address"           =>  "required",
            "country"           =>  "required",
            "currency"          =>  "required",
            "commission"        =>  "required",
            "daily"             =>  "required ",
            "rental"            =>  "required",
            "outstation"        =>  "required",
            "rating"            =>  "required",
            "commission_type"   =>  "required",
            "status"            =>  "required",
        ])->validate();

        if($request["rating"]>5 || $request["rating"]<0){
            return back()->withInput()->with(
                Session::flash("message", "Please enter a valid rating"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
        $password=$request["password"];
        $suffix="ar";
        $prefix="ro";
        $enc_password=$suffix.$password.$prefix;

        if($request->file("image")){
            $validator=Validator::make($request->all(),[
               "image"             =>  "required | image ",   
            ])->validate();

            $image=$request->file("image");
            $image_name=$image->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/profile_image/".$date;
            $image->move($destination, $image_name);

            Driver::where("id", $id)->update([
                "image"             =>  $date.'/'.$image_name,   
            ]);
        }

        if($request->file("id_proof")){
            $validator=Validator::make($request->all(),[
               "id_proof"             =>  "required | image ",   
            ])->validate();

            $id_image=$request->file("id_proof");
            $id_image_name=$id_image->getClientOriginalName();
            $destination="images/id"."/".$date;
            $id_image->move($destination, $id_image_name);

            Driver::where("id", $id)->update([
                "id_image"             =>  $date.'/'.$id_image_name,   
            ]);

        }
       

      /*  $adhar_image=$request->file("adhar_image");
        $adhar_image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/aadhar"."/".$date;
        $adhar_image->move($destination, $adhar_image_name);*/

        DB::beginTransaction();
        try{
            Driver::where("id", $id)->update([
                "first_name"        =>  $request["first_name"],
                "last_name"         =>  $request["last_name"],
                "gender"            =>  $request["gender"],
                "phone_number"      =>  $request["phone_number"],
                "email"             =>  $request["email"],
                "password"          =>  md5($password),
                "password_salt"     =>  $enc_password,
          //      "image"             =>  $date.'/'.$image_name,   
          //      "aadhar_image"      =>  $date.'/'.$adhar_image_name,
                "aadhar"            =>  $request["number"],
                "dob"               =>  $request["dob"],
                "license_number"    =>  $request["license_number"],
              //  "id_image"          =>  $date.'/'.$id_image_name,
                "address"           =>  $request["address"],
                "country"           =>  $request["country"],
                "currency"          =>  $request["currency"],
                "commission"        =>  $request["commission"],
                "daily"             =>  $request["daily"],
                "rental"            =>  $request["rental"],
                "rating"            =>  $request["rating"],
                "outstation"        =>  $request["outstation"],
                "comm_type"         =>  $request["commission_type"],
                "status"            =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("drivers.index")->with(
                Session::flash("message", "driver updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->withInput()->with(
                Session::flash("message", "Cannot update the driver"), 
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
        if(Driver::where("id", $id)->delete()){
            return redirect()->route("drivers.index")->with(
                Session::flash("message", "Driver deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the driver"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function wallet()
    {
        $data=null;
       return view("drivers.driver_wallet", compact("data"));
    }

    public function earnings()
    {
        $data=null;
        return view("drivers.driver_earnings", compact("data"));
    }

    public function vehicles()
    {
        $vehicles=DriverVehicle::all();
        return view("drivers.vehicles", compact("vehicles"));
    }

    public function add_vehicles()
    {
        $countries=country::all();
        $vehicles=ManageModel::all();
        $drivers=Driver::all();
        return view("drivers.add_form", compact('countries', 'vehicles', 'drivers'));
    }

    public function add_vehicles_form(Request $request)
    {
        $validator=Validator::make($request->all(),[
            "driver"         =>  "required",
            "vehicle_type"   =>  "required",
            "brand"          =>  "required",
            "color"          =>  "required | string",   
            "vehicle_name"   =>  "required | string ",
            "vehicle_number" =>  "required",
            "vehicle_image"  =>  "required| image ",
            "status"         =>  "required",
        ])->validate();

        $image=$request->file("vehicle_image");
        $image_name=$image->getClientOriginalName();
        $date=date("M-Y");
        $destination="images/vehicles".'/'.$date;
        $image->move($destination, $image_name);

        DB::beginTransaction();
        try{
            DriverVehicle::create([
                "driver_id"      =>  $request["driver"],
                "vehicle_type"   =>  $request["vehicle_type"],
                "brand"          =>  $request["brand"],
                "color"          =>  $request["color"],
                "vehicle_name"   =>  $request["vehicle_name"],
                "vehicle_number" =>  $request["vehicle_number"],
                "vehicle_image"  =>  $date.'/'.$image_name,
                "status"         =>  $request["status"]
            ]);
            DB::commit();
            return redirect()->route("vehicles")->with(
                Session::flash("message", "vehicle added successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the vehicle"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function edit_vehicles($id)
    {
        $countries=country::all();
        $user_vehicles=vehicle::all();
        $drivers=Driver::all();
        $vehicles=DriverVehicle::where("id", $id)->get();
        return view("drivers.edit_form", compact("vehicles", "countries", "user_vehicles", "drivers"));
    }

    public function update_vehicles(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            "country"        =>  "required",
            "driver"         =>  "required",
            "vehicle_type"   =>  "required",
            "brand"          =>  "required",
            "color"          =>  "required | string",   
            "vehicle_name"   =>  "required | string ",
            "vehicle_number" =>  "required",
          //  "vehicle_image"  =>  "required| image ",
            "status"         =>  "required",
        ])->validate();

        if($request->file("vehicle_image")){
            $validator=Validator::make($request->all(),[
                "vehicle_image"  =>  "required| image ",
            ])->validate(); 

            $image=$request->file("vehicle_image");
            $image_name=$image->getClientOriginalName();
            $date=date("M-Y");
            $destination="images/vehicles".'/'.$date;
            $image->move($destination, $image_name);

            DriverVehicle::where("id", $id)->update([
                "vehicle_image"  =>  $date.'/'.$image_name,
            ]);
        }
       

        $country        =  $request["country"];
        $driver_id      =  $request["driver"];
        $vehicle_type   =  $request["vehicle_type"];
        $brand          =  $request["brand"];
        $color          =  $request["color"];
        $vehicle_name   =  $request["vehicle_name"];
        $vehicle_number =  $request["vehicle_number"];
      
        $status         =  $request["status"];
        DB::beginTransaction();
        try{
            DriverVehicle::where("id", $id)->update([
                "country"        =>  $country,
                "driver_id"      =>  $driver_id,
                "vehicle_type"   =>  $vehicle_type,
                "brand"          =>  $brand,
                "color"          =>  $color,
                "vehicle_name"   =>  $vehicle_name,
                "vehicle_number" =>  $vehicle_number,
           
                "status"         =>  $status
            ]);
            DB::commit();
            return redirect()->route("vehicles")->with(
                Session::flash("message", "vehicle updated successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot update the vehicle"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }

    public function withdrawals()
    {
        $data=null;
       return view("drivers.withdrawal_page",compact("data"));
    }

    public function bank_details()
    {
        $data=null;
       return view("drivers.details_page",compact("data"));
    }

    public function driver_search(Request $request)
    {
        $value=$request["id"];
        if($value==null){
            $drivers=Customer::paginate(10);
            return view("drivers.driver_page", compact("drivers"));
        }else{
            if(is_numeric($value)){
                $drivers=Driver::where("phone_number", "like","$value%")->get();
                return response()->json([
                    "status"=>$drivers,
                ]);
            }else{
                $drivers=Driver::where("first_name", "like","$value%")->get();
                return response()->json([
                    "status"=>$drivers,
                ]);
            } 
        }
    }


    public function driver_edit($id)
    {
        $drivers=Driver::where("id", $id)->get();
        $user_password=Driver::where("id", $id)->value("password_salt");
        $password=substr($user_password, 2-strlen($user_password), -2);
        $countries=country::all();
        return view("drivers.edit_driver", compact("drivers", "password", "countries"));
    }

    public function driver_delete($id)
    {
        if(Driver::where("id", $id)->delete()){
            return redirect()->route("drivers.index")->with(
                Session::flash("message", "Driver deleted successfully"), 
                Session::flash("alert-class", "alert-success"),
            );
        }else{
            return back()->with(
                Session::flash("message", "Cannot delete the driver"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
}
