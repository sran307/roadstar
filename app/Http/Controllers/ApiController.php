<?php

namespace App\Http\Controllers;

require_once('Qrcode/qrlib.php');

use Illuminate\Http\Request;
use App\Models\{
    User, 
    AboutPage,
    GeneralSetting,
    City,
    Customer,
    TripRequest,
    ManageFleet,
    TripType,
    OutstationModel,
    ManageModel,
    ManageBrand,
    DailyFare,
    Driver,
    CityTrip,
    ReviewModel,
    Cancellation,
    NewTrip,
    ComplaintsModel,
    DriverVehicle,

};
use Illuminate\Support\Facades\{
    DB, Validator, Session, Storage, Mail,
};

use App\Mail\booking_mail;
use App\Mail\Passanger;

class ApiController extends Controller
{
    public function check_phone(Request $request)
    {
        $phone      =   $request->phone;
        $device_id  =   $request->device_id;
        $device_type=   $request->device_type;
        
        $rules = array(
            'phone'     => 'required|numeric|digits:10',
        );
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error_message = $validator->errors()->toArray();
            $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Please Fix Validation Error');
            return response()->json($error, 200);
        }else{

            $rules = array(
                'phone'     => 'required | unique:customers,phone_number',
            );

            $messages=array(
                'phone.unique'=>'This phone number already taken..!',
            );

            $validator = Validator::make($request->all(), $rules,$messages);

            if ($validator->fails()) {
               
                $error = array('status' => 'success', 'msg' => 'Login successful.', 'response' => 'login_1');
                return response()->json($error, 200);
            }else{
                DB::beginTransaction();
                try{
                    Customer::create([
                        "phone_number"  =>  $phone,
                        "device_id"     =>  $device_id,   
                        "device_type"   =>  $device_type,  
                    ]);
                    DB::commit();
                    $error = array('status' => 'success', 'msg' => 'Data stored successfully.', 'response' => 'login_0');
                    return response()->json($error, 200);
                }catch(\Exception $e){
                    DB::rollback();
                    $error = array('status' => 'error', 'msg' => 'Cannot stored the data.');
                    return response()->json($error, 200);
                }
            }
        }
    }

    //user data storing
    public function user_details(Request $request)
    {
        $phone      =   $request->phone;
        $first_name =   $request->first_name;
        $last_name  =   $request->last_name;
        $email      =   $request->email;

        $rules=[
            'phone'         => 'required | numeric | digits:10',
            "first_name"    =>  "required | string",
            "last_name"     =>  "required | string"
        ];

        $validator=Validator::make($request->all(), $rules);

        if($email!=null){
            $get_email=Customer::where("email", $email)->get();
            if(count($get_email)>0){
                $error = array('status' => 'error', 'msg' => 'Email Id already used. Continue without email');
                return response()->json($error, 200);
            }else{
                Customer::where("phone_number", $phone)->update([
                    "email"=>  $email,  
                ]);
            }
        }
        

        if($validator->fails()){
            $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Please Fix Validation Error');
            return response()->json($error, 200);
        }else{
            DB::beginTransaction();
            try{
                Customer::where("phone_number", $phone)->update([
                    "customer_first_name"   =>  $first_name,
                    "customer_last_name"    =>  $last_name,   
                ]);
                DB::commit();
                $user_id=Customer::where("phone_number", $phone)->value("id");
                $user_email=Customer::where("phone_number", $phone)->value("email");
            
                $error = [
                    'status'        => 'success',
                    'msg'           => 'Registration completed.',
                    "user_id"       =>  $user_id,
                    "phone"         =>  $phone,
                    "first_name"    =>  $first_name,
                    "last_name"     =>  $last_name,
                    "email"         =>  $user_email,
                ];
                return response()->json($error, 200);
            }catch(\Exception $e){
                DB::rollback();
                $error = array('status' => 'error', 'msg' => 'Cannot register.');
                return response()->json($error, 200);
            }
        }
    }

    //user login
    public function user_login(Request $request)
    {
        $phone      =   $request->phone;
        $user_phone =   Customer::where("phone_number", $phone)->value("phone_number");

        $rules = array(
            'phone'     => 'required|numeric|digits:10',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Please Fix Validation Error');
            return response()->json($error, 200);
        }else{

            if($phone == $user_phone){
            
                $details=Customer::where("phone_number", $phone)->first();
                $error = [
                    'status'        =>  'success', 
                    'msg'           =>  'Login successful.',
                    "user_id"       =>   $details->id,
                    "first_name"    =>   $details->customer_first_name,
                    "last_name"     =>   $details->customer_last_name,
                    "phone_number"  =>   $details->phone_number,
                    "email"         =>   $details->email
                ];
                return response()->json($error, 200);
            }else{
                $error = array('status' => 'error', 'msg' => 'Please register first.');
                return response()->json($error, 200);
            }
        }  
    }

    //user profile
    public function user_profile(Request $request)
    {
        $user_id=$request->user_id;

        $rules = array(
            'user_id'     => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Plese Fix Validation Error');
            return response()->json($error, 200);
        }else{

            $data=Customer::where("id", $user_id)->first();
        
            if(strlen($data)>0){
                $user_data=[
                    "status"        =>  "success",
                    "user_id"       =>  $data->id,
                    "first_name"    =>  $data->customer_first_name,
                    "last_name"     =>  $data->customer_last_name,
                    "email"         =>  $data->email,
                    "phone_number"  =>  $data->phone_number,
                    "location"      =>  $data->location,
                    "address"       =>  $data->address,
                    "image"         =>  asset("images/app_images/".$data->image),
                ];
                $error = array('status' => 'success', );
                return response()->json($user_data, 200);
            }else{
                $error = array('status' => 'error', 'msg' => 'Please register first.');
                return response()->json($error, 200);
            }
        }  

    }

    //user profile update
    public function user_edit_profile(Request $request){
        $user_id            =   $request->user_id;
        $first_name         =   $request->first_name;
        $email              =   $request->email;
        $location           =   $request->location;
        $address            =   $request->address;

        $rules = array(
            'first_name'    =>  "required | string",
            "email"         =>  "required | email",
            "location"      =>  "required",
            "address"       =>  "required"
        );
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors());
            return response()->json($error, 200);
        }else{
            $data = Customer::where("id", $user_id)->first();   
           
            $user_email_id=Customer::where("email", $email)->value("id");
          
            if(strlen($data)==0){
                $error = array('status' => 'error', 'msg' => 'User data not found.');
                return response()->json($error, 200);
            }else{
                //checking whether the email and phone number is same as this user
                //if current id and the given email id's table id are same then the same user same as phone
                if(($data->id == $user_email_id) || ($user_email_id==null)){
                   
                        DB::beginTransaction();
                        try{
                            Customer::where("id", $user_id)->update([
                                "customer_first_name"   =>  $first_name,
                                "email"                 =>  $email,
                                "location"              =>  $location,
                                "address"               =>  $address,
                            ]);
                            DB::commit();
                            $error = array('status' => 'success', 'msg' => 'Profile updated.');
                            return response()->json($error, 200);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot update the profile.');
                            return response()->json($error, 200);
                        }
                }else{
                    $error = array('status' => 'error', 'msg' => 'Cannot updated. Email choosen by another person.');
                    return response()->json($error, 200);
                }

            }
        }
    }

    //about page
    public function about_details()
    {
        $path="images/page_images/";
        $about=AboutPage::first();
        $about=[
            "heading"   =>    $about->heading1,
            "image"     =>    asset("images/page_images/".$about->image),
            "details"   =>    strip_tags($about->details),
        ];
        
        return response()->json($about, 200);
    }

    public function admin_contact()
    {
        $contacts=GeneralSetting::first();
        $contacts=[
            "phone_number"  =>  $contacts->phone,
            "email"         =>  $contacts->email,
            "website_url"   =>  $contacts->website_url,
            "facebook_url"  =>  $contacts->facebook_url,
            "twitter_url"   =>  $contacts->twitter_url,
            "linkedin_url"  =>  $contacts->linkedin_url,
            "instagram_url" =>  $contacts->instagram_url
        ];
        return response()->json($contacts, 200);
    }

    //image
    public function update_profile_image(Request $request)
    {
        $port_image = $request->image;
        $user_id = $request->user_id;
        $encoded_data = explode('/',$port_image);
        //dd($encoded_data);
        if($encoded_data[0]!='data:image')
        {
             $base64img = 'data:image/jpg;base64,'. $port_image;
            
        }
        else
        {
            $base64img=$port_image;
        }
       // dd($base64img);
        $base64img = str_replace('\r\n', '', $base64img);  
        $base64img = str_replace('%2B', '+', $base64img);  
        $base64img = str_replace(' ', '+', $base64img);  
        $extension = str_replace("image/", "", substr($base64img, 5, strpos($base64img, ';')-5));
        $base64img = str_replace(substr($base64img, 0, strpos($base64img, ',')+1), "", $base64img);
        //dd($extension);
        $data1 = base64_decode($base64img);
        $target_file_name = time() . '.' . $extension; 
       
        // $path =base_path($path . $target_file_name);
        $path="images/app_images/";
        $path =base_path($path . $target_file_name);
       
        //Image::make($data1)->resize($h,$w)->save($path); 
        file_put_contents($path, $data1);
        $update=Customer::where("id", $user_id)->update(["image"=> $target_file_name]);
       

        if($update==1){
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Image updated successfully.",
               
            ]);
        }else{
            return response()->json([
                "status"    =>  "error",
                "msg"       =>  "Cannot update the image."
            ]);
        };
    }

    public function get_city()
    {
        $cities = City::all();
        $city=[];
        foreach($cities as $value){
            array_push($city, $value->city);
        }
        return response()->json([
            "status"    => "success",
            "city"  => $cities
        ]);
    }

    public function form_data(Request $request)
    {
        $type           =   $request["type"];
        $user_id        =   $request["user_id"];
        $from_address   =   $request["from_address"];
        $to_address     =   $request["to_address"];
        $pick_date      =   $request["pick_date"];
        $pick_time      =   $request["pick_time"];
      
        $rules=['type' => "required"];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                'validation' => $validator->errors()
            ]);
        }else{
            if($type=="oneway"){
                //oneway form
                $rules=[
                    "user_id"        =>  "required",
                    "from_address"   =>  "required",
                    "to_address"     =>  "required",
                    "pick_date"      =>  "required",
                    "pick_time"      =>  "required"
                ];
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return response()->json([
                        "status"    =>  "error",
                        'validation' => $validator->errors()
                    ]);
                }else{
                    $from_city=City::where("id", $from_address)->value("city");
                    $to_city=City::where("id", $to_address)->value("city");
                    $pick_date=strtotime($pick_date);
                    $en_pick_date=date('Y-m-d', $pick_date);
                    
                    $en_pick_time=date("G:i", strtotime($pick_time));

                    $tocken=time();

                    
                    if(count(CityTrip::where("from_address", $from_city)->where("to_address", $to_city)->get())>0){
                        $distance=CityTrip::where("from_address", $from_city)
                                ->where("to_address", $to_city)->value("distance");
                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "from_address"      =>  $from_city,
                                "to_address"        =>  $to_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "tocken"            =>  $tocken,
                                "distance"          =>  $distance
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }
                    }else if(count(CityTrip::where("from_address", $to_city)->where("to_address", $from_city)->get())>0){
                        $distance=CityTrip::where("from_address", $to_city)
                                ->where("to_address", $from_city)->value("distance");
                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "from_address"      =>  $from_city,
                                "to_address"        =>  $to_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "tocken"            =>  $tocken,
                                "distance"          =>  $distance
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }
                    }else{
                        $error = array('status' => 'error', 'msg' => 'trip is not available.');
                        return response()->json($error, 200);
                    }
                    
                }
            }else if($type=="round"){
                //round trip form
                $return_date=$request["return_date"];
                $rules=[
                    "user_id"        =>  "required",
                    "from_address"   =>  "required",
                    "to_address"     =>  "required",
                    "pick_date"    =>  "required",
                    "pick_time"      =>  "required",
                    "return_date"    =>   "required",
                ];
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return response()->json([
                        "status"    =>  "error",
                        'validation' => $validator->errors()
                    ]);
                }else{
                    $from_city=City::where("id", $from_address)->value("city");
                    $to_city=City::where("id", $to_address)->value("city");
                    $pick_date=strtotime($pick_date);
                    $en_pick_date=date('Y-m-d', $pick_date);
                    
                    $return_date=strtotime($return_date);
                    $en_return_date=date('Y-m-d', $return_date);

                    $en_pick_time=date("G:i", strtotime($pick_time));

                    $tocken=time();

                    if(count(CityTrip::where("from_address", $from_city)->where("to_address", $to_city)->get())>0){
                        $distance=CityTrip::where("from_address", $from_city)->where("to_address", $to_city)->value("distance");
                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "from_address"      =>  $from_city,
                                "to_address"        =>  $to_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "return_date"       =>  $en_return_date,
                                "tocken"            =>  $tocken,
                                "distance"          =>  $distance*2
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }

                    }else if(count(CityTrip::where("from_address", $to_city)->where("to_address", $from_city)->get())>0){
                        $distance=CityTrip::where("from_address", $from_city)->where("to_address", $to_city)->value("distance");
                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "from_address"      =>  $from_city,
                                "to_address"        =>  $to_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "return_date"       =>  $en_return_date,
                                "tocken"            =>  $tocken,
                                "distance"          =>  $distance*2
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }
                    }else{
                        $error = array('status' => 'error', 'msg' => 'Trip is not available.');
                        return response()->json($error, 200);
                    }
                }
            }else{
                return response()->json([
                    "status"    =>  "error",
                    "msg"       =>  "Please enter a correct travel type"
                ]);
            }
        }
    }

    //local data
    public function local_data(Request $request)
    {
        $type           =   $request["type"];
        $user_id        =   $request["user_id"];
        $city           =   $request["city"];
        $pickup_date    =   $request["pick_date"];
        $pickup_time    =   $request["pick_time"];
        $travel_type    =   $request["travel_type"];
        $rules=[
            "type"          =>  "required",
            "user_id"       =>  "required",
            "city"          =>  "required",
            "pick_date"     =>  "required",
            "pick_time"     =>  "required",
            "travel_type"   =>  "required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                'validation' => $validator->errors()
            ]);
        }else{
            $from_city=City::where("id", $city)->value("city");

            $pick_date=strtotime($pickup_date);
            $en_pick_date=date('Y-m-d', $pick_date);
         
            $en_pick_time=date("G:i", strtotime($pickup_time));

            $tocken=time();

            DB::beginTransaction();
            try{
                TripRequest::create([
                    "type"              =>  $type,
                    "customer"          =>  $user_id,
                    "from_address"      =>  $from_city,
                    "pickup_date"       =>  $en_pick_date,
                    "pickup_time"       =>  $en_pick_time,
                    "travel_type"       =>  $travel_type,
                    "tocken"            =>  $tocken
                ]);
                DB::commit();
                return response()->json([
                    "status"    =>  "success",
                    "msg"       =>  "Address saved.",
                    "token"    =>  $tocken,
                    "travel_type"   =>  $travel_type
                ]);
            }catch(\Exception $e){
                DB::rollback();
                $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                return response()->json($error, 200);
            }
        }    
    }

    //airport data
    public function airport_data(Request $request)
    {
        $type           =   $request["type"];
        $user_id        =   $request["user_id"];
        $airport        =   $request["airport_city"];
        $pick_address   =   $request["pick_address"];
        $drop_address   =   $request["drop_address"];
        $pickup_date    =   $request["pick_date"];
        $pickup_time    =   $request["pick_time"];
      
        $rules=['type' => "required"];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                'validation' => $validator->errors()
            ]);
        }else{
            if($type=="airport_from"){
                //oneway form
                $rules=[
                    "user_id"        =>  "required",
                    "airport_city"   =>  "required",
                    "drop_address"   =>  "required",
                    "pick_date"      =>  "required",
                    "pick_time"      =>  "required"
                ];
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return response()->json([
                        "status"    =>  "error",
                        'validation' => $validator->errors()
                    ]);
                }else{
                    $airport_city=City::where("id", $airport)->value("city");
                    $to_city=City::where("id", $drop_address)->value("city");
                    $pick_date=strtotime($pickup_date);
                    $en_pick_date=date('Y-m-d', $pick_date);
                    
                    $en_pick_time=date("G:i", strtotime($pickup_time));

                    $tocken=time();

                    if(count(CityTrip::where("from_address", $airport_city)->where("to_address", $to_city)->get())>0){
                        $distance=CityTrip::where("from_address", $airport_city)->where("to_address", $to_city)->value("distance");

                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "airport"           =>  $airport_city,
                                "to_address"        =>  $to_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "distance"          =>  $distance,
                                "tocken"            =>  $tocken,
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "type"      =>  $type,
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }
                    }else if(count(CityTrip::where("from_address", $to_city)->where("to_address", $airport_city)->get())>0){
                        $distance=CityTrip::where("from_address", $to_city)->where("to_address", $airport_city)->value("distance");

                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "airport"           =>  $airport_city,
                                "to_address"        =>  $to_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "distance"          =>  $distance,
                                "tocken"            =>  $tocken,
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "type"      =>  $type,
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Can not save the address.');
                            return response()->json($error, 200);
                        }
                    }else{
                        $error = array('status' => 'error', 'msg' => 'Trip is not available.');
                        return response()->json($error, 200);
                    }

                }
            }else if($type=="airport_to"){
                //round trip form
                $return_date=$request["return_date"];
                $rules=[
                    "user_id"        =>  "required",
                    "airport_city"   =>   "required",
                    "pick_address"   =>  "required",
                    "pick_date"      =>  "required",
                    "pick_time"      =>  "required",
                ];
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return response()->json([
                        "status"    =>  "error",
                        'validation' => $validator->errors()
                    ]);
                }else{

                    $airport_city=City::where("id", $airport)->value("city");
                    $from_city=City::where("id", $pick_address)->value("city");
                    $pick_date=strtotime($pickup_date);
                    $en_pick_date=date('Y-m-d', $pick_date);

                    $en_pick_time=date("G:i", strtotime($pickup_time));

                    $tocken=time();

                    if(count(CityTrip::where("from_address", $airport_city)->where("to_address", $from_city)->get())>0){
                        $distance=CityTrip::where("from_address", $airport_city)->where("to_address", $from_city)->value("distance");

                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "airport"           =>  $airport_city,
                                "from_address"        =>  $from_city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "distance"          =>  $distance,
                                "tocken"            =>  $tocken,
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "type"      =>  $type,
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }
                    }else if(count(CityTrip::where("from_address", $from_city)->where("to_address", $airport_city)->get())>0){
                        $distance=CityTrip::where("from_address", $from_city)->where("to_address", $airport_city)->value("distance");

                        DB::beginTransaction();
                        try{
                            TripRequest::create([
                                "type"              =>  $type,
                                "customer"          =>  $user_id,
                                "airport"           =>  $airport_city,
                                "from_address"      =>  $from__city,
                                "pickup_date"       =>  $en_pick_date,
                                "pickup_time"       =>  $en_pick_time,
                                "distance"          =>  $distance,
                                "tocken"            =>  $tocken,
                            ]);
                            DB::commit();
                            
                            return response()->json([
                                "status"    =>  "success",
                                "msg"       =>  "Address saved.",
                                "type"      =>  $type,
                                "token"    =>  $tocken
                            ]);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot save the address.');
                            return response()->json($error, 200);
                        }
                    }else{
                        $error = array('status' => 'error', 'msg' => 'Trip is not available.');
                        return response()->json($error, 200);
                    }
                }
            }else{
                return response()->json([
                    "status"    =>  "error",
                    "msg"       =>  "Trip is not available"
                ]);
            }
        }
    }

    //view cabs
    public function view_cabs(Request $request)
    {
        $tocken=$request["token"];
        $rules=[
            "token"    =>      "required | numeric"
        ];

        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $details   =  TripRequest::where("tocken", $tocken)->first();
            if($details->type=="oneway"){
                $vehicles   =   ManageFleet::join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                            ->join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                            ->where("manage_fleets.travel_type", "oneway")
                                            ->get([
                                                "manage_brands.brand_name",
                                                "manage_models.model_name",
                                                "manage_models.id",
                                                "manage_fleets.seating",
                                                "manage_fleets.ac",
                                                "manage_fleets.features",
                                                "manage_fleets.bags",
                                                "manage_fleets.image",
                                            ]);
                $fleet=[];

                foreach($vehicles as $vehicle){
                    $basefare=OutstationModel::where("vehicle_type", $vehicle->id)->value("base_fare");
                    $basefare_km=OutstationModel::where("vehicle_type", $vehicle->id)->value("base_fare_km");
                    $price_per_km=OutstationModel::where("vehicle_type", $vehicle->id)->value("price_per_km");
                    $total_distance=$details->distance;
                    $remain_distance=$total_distance-$basefare_km;
                    
                    array_push($fleet, [
                        "brand"     =>  $vehicle->brand_name,
                        "model"     =>  $vehicle->model_name,
                        "vehicle_id"=> ManageFleet::where("travel_type", "oneway")->where("model", $vehicle->id)->value("id"),
                        "seating"   =>  $vehicle->seating,
                        "ac"        =>  $vehicle->ac,
                        "features"  =>  strip_tags($vehicle->features),
                        "bags"      =>  $vehicle->bags,
                        "total_km"  => $details->distance,
                        "amount"    =>  round($basefare+($remain_distance*$price_per_km)),
                        "image"     =>  asset("images/fleets/".$vehicle->image),
                    ]);
                }

                $inclutions=["Fuel Charges", "Driver Allowance", "Toll/State Tax", "GST(5%)" ];
                $exclutions=["charge"];

            
                    return response()->json([
                        "status"        =>  "success",
                        "type"          =>  $details->type,
                        "from_address"  =>  $details->from_address,
                        "to_address"    =>  $details->to_address,
                        "pickup_date"   =>  $details->pickup_date,
                        "pickup_time"   =>  date("g:i A", strtotime($details->pickup_time)),
                        "cars"          =>  $fleet,
                        "inclutions"    =>  $inclutions,
                        "exclution"     =>  $exclutions,
                    ]);
            }else if($details->type=="round"){ //round trip
                $vehicles   =   ManageFleet::join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                            ->join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                            ->where("manage_fleets.travel_type", "round")
                                            ->get([
                                                "manage_brands.brand_name",
                                                "manage_models.model_name",
                                                "manage_models.id",
                                                "manage_fleets.seating",
                                                "manage_fleets.ac",
                                                "manage_fleets.features",
                                                "manage_fleets.bags",
                                                "manage_fleets.image",
                                            ]);
            
                $fleet=[];

                foreach($vehicles as $vehicle){
                    $basefare=OutstationModel::where("vehicle_type", $vehicle->id)->value("base_fare");
                    $basefare_km=OutstationModel::where("vehicle_type", $vehicle->id)->value("base_fare_km");
                    $price_per_km=OutstationModel::where("vehicle_type", $vehicle->id)->value("price_per_km");
                    $total_distance=$details->distance;
                    $remain_distance=$total_distance-$basefare_km;
                    array_push($fleet, [
                        "brand"     =>  $vehicle->brand_name,
                        "model"     =>  $vehicle->model_name,
                        "vehicle_id"=> ManageFleet::where("travel_type", "round")->where("model", $vehicle->id)->value("id"),
                        "seating"   =>  $vehicle->seating,
                        "ac"        =>  $vehicle->ac,
                        "features"  =>  strip_tags($vehicle->features),
                        "bags"      =>  $vehicle->bags,
                        "total_km"  =>  $details->distance,
                        "amount"    =>  round($basefare+($remain_distance*$price_per_km), 2),
                        "image"     =>  asset("images/fleets/".$vehicle->image)
                    ]);
                }

                $inclutions=["Fuel Charges", "Driver Allowance", "Toll/State Tax", "GST(5%)" ];
                $exclutions=["charge"];

            
                    return response()->json([
                        "status"        =>  "success",
                        "type"          =>  $details->type,
                        "from_address"  =>  $details->from_address,
                        "to_address"    =>  $details->to_address,
                        "pickup_date"   =>  $details->pickup_date,
                        "pickup_time"   =>  date("g:i A", strtotime($details->pickup_time)),
                        "return_date"   =>  $details->return_date,
                        "cars"          =>  $fleet,
                        "inclutions"    =>  $inclutions,
                        "exclution"     =>  $exclutions,
                    ]);
            }else if($details->travel_type=="12 hrs|120 kms"){     //local 120kms 
                TripRequest::where("tocken", $tocken)->update([
                    "distance"  =>  120,
                    "to_address"=> "Drop city not selected  "
                ]);
                $vehicles   =   ManageFleet::join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                            ->join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                            ->where("manage_fleets.travel_type", "local_120")
                                            ->get([
                                                "manage_brands.brand_name",
                                                "manage_models.model_name",
                                                "manage_models.id",
                                                "manage_fleets.seating",
                                                "manage_fleets.ac",
                                                "manage_fleets.features",
                                                "manage_fleets.bags",
                                                "manage_fleets.image",
                                            ]);
            
                $fleet=[];
                foreach($vehicles as $vehicle){
                    array_push($fleet, [
                        "brand"     =>  $vehicle->brand_name,
                        "model"     =>  $vehicle->model_name,
                        "vehicle_id"=> ManageFleet::where("travel_type", "local_120")->where("model", $vehicle->id)->value("id"),
                        "seating"   =>  $vehicle->seating,
                        "ac"        =>  $vehicle->ac,
                        "features"  =>  strip_tags($vehicle->features),
                        "bags"      =>  $vehicle->bags,
                        //amount= ((120-base fare km)*price per km)+base fare
                        "amount"    =>  round(((120-(DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare_km")))* (DailyFare::where("vehicle_type", $vehicle->id)->value("Price_per_km")))+DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare")),
                        "image"     =>  asset("images/fleets/".$vehicle->image),
                    ]);
                }

                $inclutions=["Fuel Charges", "Driver Allowance", "Toll/State Tax", "GST(5%)" ];
                $exclutions=["charge"];

            
                    return response()->json([
                        "status"        =>  "success",
                        "type"          =>  $details->type,
                        "travel_type"   =>  $details->travel_type,
                        "city"          =>  $details->from_address,
                        "pickup_date"   =>  $details->pickup_date,
                        "pickup_time"   =>  date("g:i A", strtotime($details->pickup_time)),
                        "cars"          =>  $fleet,
                        "inclutions"    =>  $inclutions,
                        "exclution"     =>  $exclutions,
                    ]);
            }else if($details->travel_type=="8 hrs|80 kms"){     //local 80kms 
                TripRequest::where("tocken", $tocken)->update([
                    "distance"  =>  80,
                    "to_address"=> "Drop city not selected  "
                ]);
                $vehicles   =   ManageFleet::join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                            ->join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                            ->where("manage_fleets.travel_type", "local_80")
                                            ->get([
                                                "manage_brands.brand_name",
                                                "manage_models.model_name",
                                                "manage_models.id",
                                                "manage_fleets.seating",
                                                "manage_fleets.ac",
                                                "manage_fleets.features",
                                                "manage_fleets.bags",
                                                "manage_fleets.image",
                                            ]);
            
                $fleet=[];
                foreach($vehicles as $vehicle){
                    array_push($fleet, [
                        "brand"     =>  $vehicle->brand_name,
                        "model"     =>  $vehicle->model_name,
                        "vehicle_id"=> ManageFleet::where("travel_type", "local_80")->where("model", $vehicle->id)->value("id"),
                        "seating"   =>  $vehicle->seating,
                        "ac"        =>  $vehicle->ac,
                        "features"  =>  strip_tags($vehicle->features),
                        "bags"      =>  $vehicle->bags,
                        //amount= ((80-base fare km)*price per km)+base fare
                        "amount"    =>  round(((80-(DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare_km")))* (DailyFare::where("vehicle_type", $vehicle->id)->value("Price_per_km")))+DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare")),
                        "image"     =>  asset("images/fleets/".$vehicle->image)
                    ]);
                }

                $inclutions=["Fuel Charges", "Driver Allowance", "Toll/State Tax", "GST(5%)" ];
                $exclutions=["charge"];

            
                    return response()->json([
                        "status"        =>  "success",
                        "type"          =>  $details->type,
                        "travel_type"   =>  $details->travel_type,
                        "city"          =>  $details->from_address,
                        "pickup_date"   =>  $details->pickup_date,
                        "pickup_time"   =>  date("g:i A", strtotime($details->pickup_time)),
                        "cars"          =>  $fleet,
                        "inclutions"    =>  $inclutions,
                        "exclution"     =>  $exclutions,
                    ]);
            }else if($details->type=="airport_from"){ //round trip
                $vehicles   =   ManageFleet::join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                            ->join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                            ->where("manage_fleets.travel_type", "airport")
                                            ->get([
                                                "manage_brands.brand_name",
                                                "manage_models.model_name",
                                                "manage_models.id",
                                                "manage_fleets.seating",
                                                "manage_fleets.ac",
                                                "manage_fleets.features",
                                                "manage_fleets.bags",
                                                "manage_fleets.image",
                                            ]);
            
                $fleet=[];
                foreach($vehicles as $vehicle){
                    array_push($fleet, [
                        "brand"     =>  $vehicle->brand_name,
                        "model"     =>  $vehicle->model_name,
                        "vehicle_id"=>  ManageFleet::where("travel_type", "airport")->where("model", $vehicle->id)->value("id"),
                        "seating"   =>  $vehicle->seating,
                        "ac"        =>  $vehicle->ac,
                        "features"  =>  strip_tags($vehicle->features),
                        "bags"      =>  $vehicle->bags,
                        "total_km"  =>  DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare_km")*2,
                       //amount= ((distance-base fare km)*price per km)+base fare
                        "amount"    =>  round((($details->distance-(DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare_km")))* (DailyFare::where("vehicle_type", $vehicle->id)->value("Price_per_km")))+DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare")),
                        "image"     =>  asset("images/fleets/".$vehicle->image)
                    ]);
                }

                $inclutions=["Fuel Charges", "Driver Allowance", "Toll/State Tax", "GST(5%)" ];
                $exclutions=["charge"];

            
                    return response()->json([
                        "status"        =>  "success",
                        "type"          =>  $details->type,
                        "airport_address"  =>  $details->airport,
                        "drop_address"    =>  $details->to_address,
                        "pickup_date"   =>  $details->pickup_date,
                        "pickup_time"   =>  date("g:i A", strtotime($details->pickup_time)),
                        "cars"          =>  $fleet,
                        "inclutions"    =>  $inclutions,
                        "exclution"     =>  $exclutions,
                    ]);
            }else if($details->type=="airport_to"){ //round trip
                $vehicles   =   ManageFleet::join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                                            ->join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                                            ->where("manage_fleets.travel_type", "airport")
                                            ->get([
                                                "manage_brands.brand_name",
                                                "manage_models.model_name",
                                                "manage_models.id",
                                                "manage_fleets.seating",
                                                "manage_fleets.ac",
                                                "manage_fleets.features",
                                                "manage_fleets.bags",
                                                "manage_fleets.image",
                                            ]);
            
                $fleet=[];
                foreach($vehicles as $vehicle){
                    array_push($fleet, [
                        "brand"     =>  $vehicle->brand_name,
                        "model"     =>  $vehicle->model_name,
                        "seating"   =>  $vehicle->seating,
                        "vehicle_id"=> ManageFleet::where("travel_type", "airport")->where("model", $vehicle->id)->value("id"),
                        "ac"        =>  $vehicle->ac,
                        "features"  =>  strip_tags($vehicle->features),
                        "bags"      =>  $vehicle->bags,
                        "total_km"  =>  DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare_km")*2,
                       //amount= ((distance-base fare km)*price per km)+base fare
                       "amount"    =>  round((($details->distance-(DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare_km")))* (DailyFare::where("vehicle_type", $vehicle->id)->value("Price_per_km")))+DailyFare::where("vehicle_type", $vehicle->id)->value("base_fare")),
                        "image"     =>  asset("images/fleets/".$vehicle->image)
                    ]);
                }

                $inclutions=["Fuel Charges", "Driver Allowance", "Toll/State Tax", "GST(5%)" ];
                $exclutions=["charge"];

            
                    return response()->json([
                        "status"        =>  "success",
                        "type"          =>  $details->type,
                        "airport_address"  =>  $details->airport,
                        "pick_address"    =>  $details->from_address,
                        "pickup_date"   =>  $details->pickup_date,
                        "pickup_time"   =>  date("g:i A", strtotime($details->pickup_time)),
                        "cars"          =>  $fleet,
                        "inclutions"    =>  $inclutions,
                        "exclution"     =>  $exclutions,
                    ]);
            }

            
            
        }
    }

    //taking cab details
    public function cab_details(Request $request)
    {
        $model = $request["model"];
        $model_id = ManageModel::where("model_name", $model)->value("id");
        $vehicle_id = $request["vehicle_id"]; 
        $amount = $request["amount"];
        $token = $request["token"];

        $rules=[
            "model"     =>  "required",
            "amount"    =>  "required | numeric",
            "token"    =>  "required | numeric",
            "vehicle_id" => "required | numeric"
        ];

        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
                try{
                    TripRequest::where("tocken", $token)->update([
                        "vehicle_type"  =>  $model_id,
                        "subtotal"          =>  $amount,
                        "vehicle_id"        => $vehicle_id
                    ]);
                    DB::commit();
                        
                    return response()->json([
                        "status"    =>  "success",
                        "msg"       =>  "Cab selected.",
                      
                    ]);
                }catch(\Exception $e){
                    DB::rollback();
                    $error = array('status' => 'error', 'msg' => 'Cannot save the cab.');
                    return response()->json($error, 200);
                }
        }

    }

    //booking details
    public function booking_details(Request $request)
    {
        $token=$request["token"];

        $rules=[
            "token"    =>  "required | numeric",
        ];

        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $type=TripRequest::where("tocken", $token)->value("type");
            if($type=="oneway"){
                $trip_details=TripRequest::where("trip_requests.tocken", $token)
                                        ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                        ->first([
                                            "trip_requests.from_address",
                                            "trip_requests.to_address",
                                            "trip_requests.type",
                                            "trip_requests.pickup_date",
                                            "trip_requests.pickup_time",
                                            "manage_models.model_name",
                                            "trip_requests.subtotal",
                                        ]);

                return response()->json([
                    "status"        =>  "success",
                    "start_point"   =>  $trip_details->from_address,
                    "end_point"     =>  $trip_details->to_address,
                    "type"          =>  $trip_details->type,
                    "pickup_date"   =>  $trip_details->pickup_date,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details->pickup_time)),
                    "model"         =>  $trip_details->model_name,
                    "brand"         =>  ManageBrand::where("id", ManageModel::where("model_name",  $trip_details->model_name,)->value("brand"))->value("brand_name"),
                    "amount"        =>  $trip_details->subtotal,
                ]);
            }else if($type=="round"){
                $trip_details=TripRequest::where("trip_requests.tocken", $token)
                                        ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                        ->first([
                                            "trip_requests.from_address",
                                            "trip_requests.to_address",
                                            "trip_requests.type",
                                            "trip_requests.pickup_date",
                                            "trip_requests.pickup_time",
                                            "manage_models.model_name",
                                            "trip_requests.subtotal",
                                            "trip_requests.return_date"
                                        ]);

                return response()->json([
                    "status"        =>  "success",
                    "start_point"   =>  $trip_details->from_address,
                    "end_point"     =>  $trip_details->to_address,
                    "type"          =>  $trip_details->type,
                    "pickup_date"   =>  $trip_details->pickup_date,
                    "return_date"   =>  $trip_details->return_date,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details->pickup_time)),
                    "model"         =>  $trip_details->model_name,
                    "brand"         =>  ManageBrand::where("id", ManageModel::where("model_name",  $trip_details->model_name,)->value("brand"))->value("brand_name"),
                    "amount"        =>  $trip_details->subtotal,
                ]);
            }else if($type=="local"){
                $trip_details=TripRequest::where("trip_requests.tocken", $token)
                                        ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                        ->first([
                                            "trip_requests.from_address",
                                            "trip_requests.to_address",
                                            "trip_requests.type",
                                            "trip_requests.pickup_date",
                                            "trip_requests.pickup_time",
                                            "manage_models.model_name",
                                            "trip_requests.subtotal",
                                            "trip_requests.return_date",
                                            "trip_requests.travel_type"
                                        ]);
                
                return response()->json([
                    "status"        =>  "success",
                    "start_point"   =>  $trip_details->from_address,
                    "type"          =>  $trip_details->type,
                    "travel_type"   =>  $trip_details->travel_type,
                    "pickup_date"   =>  $trip_details->pickup_date,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details->pickup_time)),
                    "model"         =>  $trip_details->model_name,
                    "brand"         =>  ManageBrand::where("id", ManageModel::where("model_name",  $trip_details->model_name,)->value("brand"))->value("brand_name"),
                    "amount"        =>  $trip_details->subtotal,
                ]);
            }else if($type=="airport_from"){
                $trip_details=TripRequest::where("trip_requests.tocken", $token)
                                        ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                        ->first([
                                            "trip_requests.airport",
                                            "trip_requests.to_address",
                                            "trip_requests.type",
                                            "trip_requests.pickup_date",
                                            "trip_requests.pickup_time",
                                            "manage_models.model_name",
                                            "trip_requests.subtotal",
                                            "trip_requests.return_date"
                                        ]);

                return response()->json([
                    "status"        =>  "success",
                    "start_point"   =>  $trip_details->airport,
                    "end_point"     =>  $trip_details->to_address,
                    "type"          =>  $trip_details->type,
                    "pickup_date"   =>  $trip_details->pickup_date,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details->pickup_time)),
                    "model"         =>  $trip_details->model_name,
                    "brand"         =>  ManageBrand::where("id", ManageModel::where("model_name",  $trip_details->model_name,)->value("brand"))->value("brand_name"),
                    "amount"        =>  $trip_details->subtotal,
                ]);
            }else if($type=="airport_to"){
                $trip_details=TripRequest::where("trip_requests.tocken", $token)
                                        ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                        ->first([
                                            "trip_requests.airport",
                                            "trip_requests.from_address",
                                            "trip_requests.type",
                                            "trip_requests.pickup_date",
                                            "trip_requests.pickup_time",
                                            "manage_models.model_name",
                                            "trip_requests.subtotal",
                                            "trip_requests.return_date"
                                        ]);

                return response()->json([
                    "status"        =>  "success",
                    "start_point"   =>  $trip_details->airport,
                    "end_point"     =>  $trip_details->from_address,
                    "type"          =>  $trip_details->type,
                    "pickup_date"   =>  $trip_details->pickup_date,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details->pickup_time)),
                    "model"         =>  $trip_details->model_name,
                    "brand"         =>  ManageBrand::where("id", ManageModel::where("model_name",  $trip_details->model_name,)->value("brand"))->value("brand_name"),
                    "amount"        =>  $trip_details->subtotal,
                ]);
            }
            
        }
    }

    public function pickup_details(Request $request)
    {
        $name           = $request["name"];
        $email          = $request["email"];
        $mobile         = $request["mobile"];
        $pickup_address = $request["pickup_address"];
        $latitude      = $request["latitude"];
        $longitude      = $request["longitude"];
        $token          = $request["token"];

        $rules=[
            "name"              =>  "required",
            "email"             =>  "required | email",
            "mobile"            =>  "required | digits:10",
            "pickup_address"    =>  "required",
            "token"             =>  "required | numeric",
            "latitude"         =>  "required",
            "longitude"         =>  "required"
        ];

        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{
                TripRequest::where("tocken", $token)->update([
                    "passanger_name"        =>  $name,
                    "passanger_email"       =>  $email,
                    "passanger_phone"       =>  $mobile,
                    "pickup_address"        =>  $pickup_address,
                    "status"                =>  "Pending",
                    "pickup_lat"            =>  $latitude,
                    "pickup_lon"            =>  $longitude
                ]);
                DB::commit();

                return response()->json([
                    "status"    =>  "success",
                    "msg"       =>  "booking placed.",
                ]);
            }catch(\Exception $e){
                DB::rollback();
                $error = array('status' => 'error', 'msg' => 'Cannot place the booking.');
                return response()->json($error, 200);
            }
        }
    }

    //booking placed
    public function place_booking(Request $request)
    {
        $token = $request["token"];
        $amount_paid = $request["amount_paid"];
        $payment_method = $request["payment_method"];

        $rules=[
            "token"            =>  "required | numeric",
            "amount_paid"      =>   "required | numeric",
            "payment_method"    =>  "required"
        ];

        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            if($payment_method=="Online"){
                TripRequest::where("tocken", $token)->update([
                    "payment_status"=> "Paid"
                ]);
            }
            $booking_id = "RSR-".rand(10000, 100000);
            DB::beginTransaction();
            try{
                TripRequest::where("tocken", $token)->update([
                    "total"        =>  $amount_paid,
                    "booking_id"   =>   $booking_id,
                    "payment_method"=> $payment_method
                ]);
                DB::commit();

              /*  $name="sreenu";
                $time="12:33";
                $date="21/12/2021";
                $type="oneway";
                $pickup="here";

               $data=[
                    "name" => $name,
                    "time" => $time,
                    "date"=> $date,
                    "type"=> $type,
                    "pickup"=>$pickup
                ];

                Mail::to("sreerajs728@gmail.com")->send(new Passanger($data));*/
                $to = "sreerajs728@gmail.com";
                $subject = "My subject"; 
                $txt = "Hello world!";
                $headers = "From: webmaster@host4future.in" ;
                mail($to,$subject,$txt,$headers);
              
                return response()->json([
                    "status"    =>  "success",
                    "msg"       =>  "booking placed.",
                    "booking_id"=> $booking_id
                ]);
            }catch(\Exception $e){
                DB::rollback();
                $error = array('status' => 'error', 'msg' => 'Cannot place the booking.');
                return response()->json($error, 200);
            }
        }
    }

    //trip listing
    public function trip_list(Request $request)
    {
        $user_id = $request["user_id"];

        $rules=[
            "user_id"   =>  "required | numeric",
        ];

        $validator=Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $trip_lists=Customer::find($user_id)->customer_trips;
            $customer_trips=[];
            foreach ($trip_lists as $trip_list){
                array_push($customer_trips, [
                    "trip_code" =>  $trip_list->booking_id,
                    "trip_id"   =>  $trip_list->id,
                    "date"      =>  $trip_list->pickup_date,
                    "type"      =>  $trip_list->type,
                    "amount"    =>  $trip_list->subtotal,
                    "status"    =>  $trip_list->status,
                    "stars"     =>  ReviewModel::where("trip_id", $trip_list->id)->value("star"),
                    "title"     =>  ReviewModel::where("trip_id", $trip_list->id)->value("title"),
                    "review"    =>  ReviewModel::where("trip_id", $trip_list->id)->value("review"),
                ]);
            }
        }
        return response()->json([
            "status"    => "success",
            "trip_lists"=>  $customer_trips
        ]);
    }

    //trip details
    public function trip_details(Request $request)
    {
        $trip_id = $request["trip_id"];

        $rules=[
            "trip_id"   =>  "required | numeric",
        ];

        $validator=Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $trip_details = TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
                                            ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                            ->where("trip_requests.id", $trip_id)
                                            ->get([
                                                "customers.customer_first_name",
                                                "manage_models.model_name",
                                                "trip_requests.type",
                                                "trip_requests.from_address",
                                                "trip_requests.to_address",
                                                "trip_requests.pickup_address",
                                                "trip_requests.pickup_date",
                                                "trip_requests.pickup_time",
                                                "trip_requests.subtotal",
                                                "trip_requests.booking_id",
                                                "trip_requests.subtotal",
                                                "trip_requests.payment_method",
                                                "trip_requests.tax",
                                                "trip_requests.payment_status",
                                                "trip_requests.vehicle_id",
                                                "trip_requests.distance",
                                                "trip_requests.return_date",
                                                "trip_requests.travel_type",
                                                "trip_requests.airport"
                                            ]);

                return response()->json([
                    "status"        =>  "success",
                    "name"          =>  $trip_details[0]->customer_first_name,
                    "vehicle"       =>  $trip_details[0]->model_name,
                    "type"          =>  $trip_details[0]->type,
                    "from_address"  =>  $trip_details[0]->from_address,
                    "to_address"    =>  $trip_details[0]->to_address,
                    "airport_city"  =>  $trip_details[0]->airport,
                    "pickup_date"   =>  $trip_details[0]->pickup_date,
                    "return_date"   =>  $trip_details[0]->return_date,
                    "travel_type"   =>  $trip_details[0]->travel_type,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details[0]->pickup_time)),
                    "distance"      =>  $trip_details[0]->distance,
                    "amount"        =>  $trip_details[0]->subtotal,
                    "booking_id"    =>  $trip_details[0]->booking_id,
                    "driver"        =>  Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("first_name"),
                    "driver_phone"  =>  Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("phone_number"),
                    "vehicle_number"=>  ManageFleet::where("driver_id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("vehicle_number"),
                    "fare"          =>  $trip_details[0]->subtotal,
                    "total_amount"  =>  $trip_details[0]->subtotal,
                    "Tax"           =>  $trip_details[0]->tax,
                    "net_amount"    =>  $trip_details[0]->subtotal+$trip_details[0]->tax,
                    "payment_method"=>  $trip_details[0]->payment_method,
                    "payment_status"=>  $trip_details[0]->payment_status,

                ]);
            
            }
    }

    //local type
    public function local_type(){
        $local_types=["8 hrs|80 kms","12 hrs|120 kms"];
        return response()->json([
            "status"       =>  "success",
            "local_types"     =>  $local_types,
        ]);
    }


    //invoice
     public function app_invoice(Request $request)
    {
        $trip_id = $request["trip_id"];

        $rules=[
            "trip_id"   =>  "required | numeric",
        ];

        $validator=Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
           
            $trip_details = TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
                                            ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
                                            ->where("trip_requests.id", $trip_id)
                                            ->get([
                                                "customers.customer_first_name",
                                                "manage_models.model_name",
                                                "trip_requests.type",
                                                "trip_requests.from_address",
                                                "trip_requests.to_address",
                                                "trip_requests.pickup_address",
                                                "trip_requests.pickup_date",
                                                "trip_requests.pickup_time",
                                                "trip_requests.subtotal",
                                                "trip_requests.booking_id",
                                                "trip_requests.subtotal",
                                                "trip_requests.payment_method",
                                                "trip_requests.tax",
                                                "trip_requests.payment_status",
                                                "trip_requests.vehicle_id",
                                                "trip_requests.distance",
                                                "trip_requests.return_date",
                                                "trip_requests.travel_type",
                                                "trip_requests.airport"
                                            ]);
                $path = "images/qr/";

                $im=uniqid().".png"; 
                $file = $path.$im;
                                            
                // $ecc stores error correction capability('L') 
                $ecc = 'L'; 
                $pixel_Size = 10; 
                $frame_size = 10; 
                $text="Name: ".$trip_details[0]->customer_first_name.","."Driver: ".Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("first_name").",".
                "Driver no: ".Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("phone_number").",".
                "Vehicle_no: ".ManageFleet::where("driver_id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("vehicle_number").",".
                "Pickup address: ". $trip_details[0]->pickup_address.","."Pickup date: ".$trip_details[0]->pickup_date.",".
                "Pickup_time: ".date("g:i A", strtotime($trip_details[0]->pickup_time));
                // Generates QR Code and Stores it in directory given 
                $qrCode=\QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);
                return response()->json([
                    "status"        =>  "success",
                    "invoice_no"    =>  date('Y-m')."/"."INVOICE"."/".rand(10000, 100000),
                    "qr_code"       =>  asset($file),
                    "name"          =>  $trip_details[0]->customer_first_name,
                    "vehicle"       =>  $trip_details[0]->model_name,
                    "type"          =>  $trip_details[0]->type,
                    "from_address"  =>  $trip_details[0]->from_address,
                    "to_address"    =>  $trip_details[0]->to_address,
                    "airport_city"  =>  $trip_details[0]->airport,
                    "pickup_date"   =>  $trip_details[0]->pickup_date,
                    "return_date"   =>  $trip_details[0]->return_date,
                    "travel_type"   =>  $trip_details[0]->travel_type,
                    "pickup_time"   =>  date("g:i A", strtotime($trip_details[0]->pickup_time)),
                    "distance"      =>  $trip_details[0]->distance,
                    "amount"        =>  $trip_details[0]->subtotal,
                    "booking_id"    =>  $trip_details[0]->booking_id,
                    "driver"        =>  Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("first_name"),
                    "driver_phone"  =>  Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("phone_number"),
                    "vehicle_number"=>  ManageFleet::where("driver_id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("vehicle_number"),
                    "fare"          =>  $trip_details[0]->subtotal,
                    "total_amount"  =>  $trip_details[0]->subtotal,
                    "Tax"           =>  $trip_details[0]->tax,
                    "net_amount"    =>  $trip_details[0]->subtotal+$trip_details[0]->tax,
                    "payment_method"=>  $trip_details[0]->payment_method,
                    "payment_status"=>  $trip_details[0]->payment_status,

                ]);
            
            }
    }

    //reviews
    public function reviews(Request $request)
    {
        $trip_id = $request["trip_id"];
        $stars = $request["stars"];
        $title = $request["title"];
        $review = $request["review"];

        $rules = array(
            "trip_id"   =>  "required | numeric",
            'stars'     => 'required | lte:5',
            "title"     =>  "required",
            "review"    =>  "required"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{
                ReviewModel::create([
                    "trip_id"   =>  $trip_id,
                    "star"      =>  $stars,
                    "title"     =>  $title,
                    "review"    =>  $review
                ]);
                DB::commit();
                return response()->json([
                    "status"    =>  "success",
                    "msg"       =>  "Rating stored succesfully",
                ]);
            }catch(\Exception $e){
                dd($e);
                DB::rollback();
                $error = array('status' => 'error', 'msg' => 'Cannot store the rating.');
                return response()->json($error, 200);
            }
        }
    }

    //cancel the order
    public function cancel_booking(Request $request){
        $trip_id=$request["trip_id"];
        $rules = array(
            "trip_id"   =>  "required | numeric",
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{

            if(TripRequest::where("id", $trip_id)->update(["status"=> "Cancelled"])){
                Cancellation::create([
                    "trip_id" =>$trip_id,
                ]);
                return response()->json([
                    "status"    =>  "success",
                    "msg"       =>  "Booking cancelled successfully."
                ]);
            }else{
                return response()->json([
                    "status"    =>  "error",
                    "msg"       =>  "Cannot cancel the order."
                ]);
            }
        }
    }

    //complaints
    public function complaints(Request $request){
        $trip_id=$request["trip_id"];
        $subject=$request["subject"];
        $message=$request["message"];
        $image=$request["image"];
        
        $driver=NewTrip::where("trip_id", $trip_id)->value("driver_id");
        $name=TripRequest::where("id", $trip_id)->value("customer");
        $rules = array(
            "trip_id"   =>  "required | numeric",
            "subject"   =>  "required",
            "message"   =>  "required",
            "image"     =>  "required",
        
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $port_image = $image;
           
            $encoded_data = explode('/',$port_image);
            //dd($encoded_data);
            if($encoded_data[0]!='data:image')
            {
                $base64img = 'data:image/jpg;base64,'. $port_image;
                
            }
            else
            {
                $base64img=$port_image;
            }
            // dd($base64img);
            $base64img = str_replace('\r\n', '', $base64img);  
            $base64img = str_replace('%2B', '+', $base64img);  
            $base64img = str_replace(' ', '+', $base64img);  
            $extension = str_replace("image/", "", substr($base64img, 5, strpos($base64img, ';')-5));
            $base64img = str_replace(substr($base64img, 0, strpos($base64img, ',')+1), "", $base64img);
            //dd($extension);
            $data1 = base64_decode($base64img);
            $target_file_name = time() . '.' . $extension; 
        
            // $path =base_path($path . $target_file_name);
            $path="images/complaint/";
            $path =base_path($path . $target_file_name);
        
            //Image::make($data1)->resize($h,$w)->save($path); 
            file_put_contents($path, $data1);
           // $update=Customer::where("id", $user_id)->update(["image"=> $target_file_name]);
        
            DB::beginTransaction();
                try{
                    ComplaintsModel::create([
                        "trip_id"       =>  $trip_id,
                        "subject"       =>  $subject,
                        "description"   => $message,
                        "image"         =>  $target_file_name,
                        "customer"      =>  $name,
                        "driver"        =>  $driver,
                      
                    ]);
                    DB::commit();
                  
                    $error = array('status' => 'success', 'msg' => 'Complaint registered successfully.');
                    return response()->json($error, 200);
                }catch(\Exception $e){
                    DB::rollback();
                    $error = array('status' => 'error', 'msg' => 'Cannot register the complaint.');
                    return response()->json($error, 200);
                }
            
        }
    }

    //complaint list
    public function complaint_list(Request $request){
        $user_id=$request["user_id"];

        $rules = array(
            "user_id"   =>  "required | numeric",
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{

            $data= ComplaintsModel::where("customer", $user_id)->orderBy("id", "desc")->get();
            if(count($data)>0){
                $complaints=[];
                foreach($data as $value){
                    array_push($complaints, [
                        "trip_id"   =>  $value->trip_id,
                        "subject"   =>  $value->subject,
                        "message"   =>  $value->description,
                        "image"     =>  asset("images/complaint/".$value->image),
                    ]);
                }

                return response()->json([
                    "status"    => "success",
                "complaints"=> $complaints
                ]);
            }else{
                return response()->json([
                    "status"    => "error",
                    "msg"=> "complaints not found."
                ]);
            }
        }
    }

    //transaction
    public function transaction(Request $request)
    {
        $user_id=$request["user_id"];
        $date=date('Y-m-d', strtotime($request["date"]));

        $rules = array(
            "user_id"   =>  "required | numeric",
            "date"      =>  "required"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $trip_details = TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
            ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
            ->where("trip_requests.customer", $user_id)
            ->where("trip_requests.created_at", $date)
            ->orderBy("id", "desc")
            ->get([
                "customers.customer_first_name",
                "manage_models.model_name",
                "trip_requests.type",
                "trip_requests.from_address",
                "trip_requests.to_address",
                "trip_requests.pickup_address",
                "trip_requests.pickup_date",
                "trip_requests.pickup_time",
                "trip_requests.subtotal",
                "trip_requests.booking_id",
                "trip_requests.subtotal",
                "trip_requests.total",
                "trip_requests.payment_method",
                "trip_requests.tax",
                "trip_requests.payment_status",
                "trip_requests.vehicle_id",
                "trip_requests.distance",
                "trip_requests.return_date",
                "trip_requests.travel_type",
                "trip_requests.airport",
                "trip_requests.status",
                "trip_requests.id"
            ]);

            if(count($trip_details)==0){
                return response()->json([
                    "status"=>"error",
                    "msg"   =>  "No trip found."
                ]);
            }else{      
                $transactions=[];
        
                foreach($trip_details as $trip_detail){
                    array_push($transactions, [
                        "trip_status"   =>  $trip_detail->status,
                        "trip_no"       =>  $trip_detail->booking_id,
                        "trip_id"       =>  $trip_detail->id,
                        "trip_date"     =>  $trip_detail->pickup_date,
                        "from_address"  =>  $trip_detail->from_address,
                        "to_address"    =>  $trip_detail->to_address,
                        "airport_city"  =>  $trip_detail->airport,
                        "type"          =>  $trip_detail->type,
                        "payment_status"=>  $trip_detail->payment_status,
                        "driver"        =>  Driver::where("id", NewTrip::where("trip_id", $trip_detail->id)->value("driver_id"))->value("first_name"),
                        "driver_no"     =>  Driver::where("id", NewTrip::where("trip_id", $trip_detail->id)->value("driver_id"))->value("phone_number"),
                        "vehicle_number"=>  ManageFleet::where("driver_id", NewTrip::where("trip_id", $trip_detail->id)->value("driver_id"))->value("vehicle_number"),
                        "trip_amount"   =>  $trip_detail->subtotal,
                        "amount_paid"   =>  $trip_detail->total,
                        "balance"       =>  $trip_detail->subtotal-$trip_detail->total,
                        "payment_method"=>  $trip_detail->payment_method


                    ]);
                }  
                return response()->json([
                    "status"=>"success",
                    "transactions" => $transactions,
                ]);
            }
            return response()->json([
                "status"        =>  "success",
                "invoice_no"    =>  date('Y-m')."/"."INVOICE"."/".rand(10000, 100000),
                "qr_code"       =>  asset($file),
                "name"          =>  $trip_details[0]->customer_first_name,
                "vehicle"       =>  $trip_details[0]->model_name,
                "type"          =>  $trip_details[0]->type,
                "from_address"  =>  $trip_details[0]->from_address,
                "to_address"    =>  $trip_details[0]->to_address,
                "airport_city"  =>  $trip_details[0]->airport,
                "pickup_date"   =>  $trip_details[0]->pickup_date,
                "return_date"   =>  $trip_details[0]->return_date,
                "travel_type"   =>  $trip_details[0]->travel_type,
                "pickup_time"   =>  date("g:i A", strtotime($trip_details[0]->pickup_time)),
                "distance"      =>  $trip_details[0]->distance,
                "amount"        =>  $trip_details[0]->subtotal,
                "booking_id"    =>  $trip_details[0]->booking_id,
                "driver"        =>  Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("first_name"),
                "driver_phone"  =>  Driver::where("id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("phone_number"),
                "vehicle_number"=>  ManageFleet::where("driver_id", NewTrip::where("trip_id", $trip_id)->value("driver_id"))->value("vehicle_number"),
                "fare"          =>  $trip_details[0]->subtotal,
                "total_amount"  =>  $trip_details[0]->subtotal,
                "Tax"           =>  $trip_details[0]->tax,
                "net_amount"    =>  $trip_details[0]->subtotal+$trip_details[0]->tax,
                "payment_method"=>  $trip_details[0]->payment_method,
                "payment_status"=>  $trip_details[0]->payment_status,

            ]);
        }

    }

    //driver mobile 
    public function driver_mobile(Request $request)
    {

        $phone = $request["phone"];
        
        $rules = array(
            'phone'     => 'required|numeric|digits:10',
        );
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error_message = $validator->errors()->toArray();
            $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Please Fix Validation Error');
            return response()->json($error, 200);
        }else{

            $rules = array(
                'phone'     => 'required | unique:drivers,phone_number',
            );

            $messages=array(
                'phone.unique'=>'This phone number already taken..!',
            );

            $validator = Validator::make($request->all(), $rules,$messages);

            if ($validator->fails()) {
                $user_id=Driver::where("phone_number", $phone)->value("id");
                $error = array('status' => 'success', 'msg' => 'Login successful.', 'response' => 'login_1', "user_id" => $user_id, "phone" => $phone);
                return response()->json($error, 200);
            }else{
                DB::beginTransaction();
                try{
                    Driver::create([
                        "phone_number"  =>  $phone,
                    ]);
                    DB::commit();
                    $user_id=Driver::where("phone_number", $phone)->value("id");
                    $error = array('status' => 'success', 'msg' => 'Data stored successfully.', 'response' => 'login_0', "user_id" => $user_id, "phone" => $phone);
                    return response()->json($error, 200);
                }catch(\Exception $e){
                    DB::rollback();
                    $error = array('status' => 'error', 'msg' => 'Cannot stored the data.');
                    return response()->json($error, 200);
                }
            }
        }
    }

    //driver sign up
    public function driver_signup(Request $request){
        $phone = $request["phone"];
        $user_id = $request["user_id"];
        $first_name = $request["first_name"];
        $last_name = $request["last_name"];
        $alt_phone = $request["alt_phone"];
        $license = $request["license"];
        $adhar  = $request["adhar"];
        $passport = $request["passport"];
        $image = $request["image"];

        $rules=[
            'phone'         => 'required | numeric | digits:10',
            "user_id"       =>  "required | numeric",
            "first_name"    =>  "required | string",
            "last_name"     =>  "required | string",
            "alt_phone"     =>  "required | digits:10 | unique:drivers",
            "license"       =>  "required",
            "adhar"         =>  "required | digits:12",
            "passport"      =>  "required",
            "image"         =>  "required"
        ];

        $validator=Validator::make($request->all(), $rules);

        if($validator->fails()){
            $error = array('status' => 'error', 'validation' => $validator->errors(), );
            return response()->json($error, 200);
        }else{
            $port_image = $image;
           
            $encoded_data = explode('/',$port_image);
            //dd($encoded_data);
            if($encoded_data[0]!='data:image')
            {
                $base64img = 'data:image/jpg;base64,'. $port_image;
                
            }
            else
            {
                $base64img=$port_image;
            }
            // dd($base64img);
            $base64img = str_replace('\r\n', '', $base64img);  
            $base64img = str_replace('%2B', '+', $base64img);  
            $base64img = str_replace(' ', '+', $base64img);  
            $extension = str_replace("image/", "", substr($base64img, 5, strpos($base64img, ';')-5));
            $base64img = str_replace(substr($base64img, 0, strpos($base64img, ',')+1), "", $base64img);
            //dd($extension);
            $data1 = base64_decode($base64img);
            $target_file_name = time() . '.' . $extension; 
        
            // $path =base_path($path . $target_file_name);
            $path="images/driver/";
            $path =base_path($path . $target_file_name);
        
            //Image::make($data1)->resize($h,$w)->save($path); 
            file_put_contents($path, $data1);
           // $update=Customer::where("id", $user_id)->update(["image"=> $target_file_name]);

            DB::beginTransaction();
            try{
                Driver::where("id", $user_id)->update([
                    "first_name"   =>   $first_name,
                    "last_name"    =>   $last_name,   
                    "alt_phone"     =>  $alt_phone,
                    "license_number"=>  $license,
                    "aadhar"        =>  $adhar,
                    "passport"      =>  $passport,
                    "image"         =>  $target_file_name,
                ]);
                DB::commit();
            
                $error = [
                    'status'        => 'success',
                    'msg'           => 'Registration completed.',
                    "user_id"       =>  $user_id,
                    "phone"         =>  $phone,
                  
                ];
                return response()->json($error, 200);
            }catch(\Exception $e){
                DB::rollback();
                $error = array('status' => 'error', 'msg' => 'Cannot register.');
                return response()->json($error, 200);
            }
        }

    }

    //push notification
    public function push()
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token="cv8Ak3RMSeGsc2eVn4JZRQ:APA91bGYwfvyQMu8R0cfL00vaN0Rv5-KFqsFllOKFOf5_U5fVApIFTC4yliPzD61LXMlmZF714iMxPXIVELGdlt9Ss5BlAWnNE9KCkeU_GMaWMkhmiogzdO-F_59sx1xVS73shyUU1ED";
        $serverKey='AAAAXmbYkDU:APA91bEH9ghqxHYUBkH6kgSjL0TiS0jds3MTjYJPwhOirFqBW3-Eq8NJMNr5S_n5LA9cRu_XsC6pgGMFvewUvHae9eV5h_LV8HBH8PmgVxQs5kjD_V-cpw-1bVHFYZDR5PRqXfwLXjR5';
        $notification = [
            'title' => "test",
            'sound' => true,
            'body'=>"for test",
            'click_action'=>"no action",
            'data2'=>"no data"
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

       $headers = [
        'Authorization: key='.$serverKey,
        'Content-Type: application/json'
    ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
   

        return true;
    }

    //driver login
    public function driver_login(Request $request)
    {
        $phone      =   $request->phone;

        $rules = array(
            'phone'     => 'required|numeric|digits:10',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Please Fix Validation Error');
            return response()->json($error, 200);
        }else{

            $user_phone =   Driver::where("phone_number", $phone)->value("phone_number");

            if($phone == $user_phone){
            
                $details=Driver::where("phone_number", $phone)->first();
                $error = [
                    'status'        =>  'success', 
                    'msg'           =>  'Login successful.',
                    "user_id"       =>   $details->id,
                ];
                return response()->json($error, 200);
            }else{
                $error = array('status' => 'error', 'msg' => 'Please register first.');
                return response()->json($error, 200);
            }
        }  
    }

    //driver profile
    public function driver_profile(Request $request)
    {
        $user_id=$request["user_id"];

        $rules = array(
            'user_id'     => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors(),);
            return response()->json($error, 200);
        }else{

            $data=Driver::where("id", $user_id)->first();
        
            if(strlen($data)>0){
                $cars=DriverVehicle::where("driver_id", $user_id)->get(["vehicle_name", "vehicle_number", ]);
                if(count($cars)==0){
                    $cars=[];
                }
                $user_data=[
                    "status"        =>  "success",
                    "user_id"       =>  $data->id,
                    "first_name"    =>  $data->first_name,
                    "phone_number"  =>  $data->phone_number,
                    "alt_phone"     =>  $data->alt_phone,
                    "license"       =>  $data->license_number,
                    "adhar"         =>  $data->aadhar,
                    "passport"      =>  $data->passport,
                    "image"         =>  asset("images/driver/".$data->image),
                    "driver_status" => $data->status
                ];
                $error = array('status' => 'success', );
                return response()->json([
                    "status"    =>  "success",
                    "driver"    =>  $user_data,
                    "vehicles"  =>   $cars
                ]);
            }else{
                $error = array('status' => 'error', 'msg' => 'Please register first.');
                return response()->json($error, 200);
            }
        }  
    }

    //driver profile update
    public function driver_profile_update(Request $request)
    {
        $user_id = $request["user_id"];
        $first_name = $request["first_name"];
        $phone = $request["phone"];
        $alt_phone = $request["alt_phone"];
        $license = $request["license"];
        $adhar  = $request["adhar"];
        $passport = $request["passport"];
        $image = $request["image"];

        $rules = array(
            "user_id"       =>  "required | numeric",
            'first_name'    =>  "required | string",
            "phone"         =>  "required | digits:10",
            "alt_phone"     =>  "required | digits:10",
            "license"       =>  "required",
            "adhar"         =>  "required | digits:12",
            "passport"      =>  "required",
        );
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors());
            return response()->json($error, 200);
        }else{
            if($image!=null){
                $port_image = $image;
           
                $encoded_data = explode('/',$port_image);
                //dd($encoded_data);
                if($encoded_data[0]!='data:image')
                {
                    $base64img = 'data:image/jpg;base64,'. $port_image;
                    
                }
                else
                {
                    $base64img=$port_image;
                }
                // dd($base64img);
                $base64img = str_replace('\r\n', '', $base64img);  
                $base64img = str_replace('%2B', '+', $base64img);  
                $base64img = str_replace(' ', '+', $base64img);  
                $extension = str_replace("image/", "", substr($base64img, 5, strpos($base64img, ';')-5));
                $base64img = str_replace(substr($base64img, 0, strpos($base64img, ',')+1), "", $base64img);
                //dd($extension);
                $data1 = base64_decode($base64img);
                $target_file_name = time() . '.' . $extension; 
            
                // $path =base_path($path . $target_file_name);
                $path="images/driver/";
                $path =base_path($path . $target_file_name);
            
                //Image::make($data1)->resize($h,$w)->save($path); 
                file_put_contents($path, $data1);
               // $update=Customer::where("id", $user_id)->update(["image"=> $target_file_name]);

               Driver::where("id", $user_id)->update([
                    "image"          =>  $target_file_name
                ]);
            }
           
            $data = Driver::where("id", $user_id)->first();   
           
            $driver_phone=Driver::where("phone_number", $phone)->value("id");
          
            if(strlen($data)==0){
                $error = array('status' => 'error', 'msg' => 'User data not found.');
                return response()->json($error, 200);
            }else{
                //checking whether the email and phone number is same as this user
                //if current id and the given email id's table id are same then the same user same as phone
                if(($data->id == $driver_phone) || ($driver_phone==null)){
                   
                        DB::beginTransaction();
                        try{
                            Driver::where("id", $user_id)->update([
                                "first_name"   =>  $first_name,
                               "phone_number"   =>  $phone,
                               "alt_phone"      =>  $alt_phone,
                               "license_number" =>  $license,
                               "aadhar"         =>  $adhar,
                               "passport"       =>  $passport,
                            ]);
                            DB::commit();
                            $error = array('status' => 'success', 'msg' => 'Profile updated.');
                            return response()->json($error, 200);
                        }catch(\Exception $e){
                            DB::rollback();
                            $error = array('status' => 'error', 'msg' => 'Cannot update the profile.');
                            return response()->json($error, 200);
                        }
                }else{
                    $error = array('status' => 'error', 'msg' => 'Cannot updated. Phone number choosen by another person.');
                    return response()->json($error, 200);
                }

            }
        }
    }

    //driver status
    public function status(Request $request)
    {
        $user_id=$request["user_id"];
        $status=$request["status"];

        $rules = array(
            "user_id"       =>  "required | numeric",
           "status"         =>  "required | string"
        );
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors());
            return response()->json($error, 200);
        }else{
            if(Driver::where("id", $user_id)->update(["status" => $status])){
                return response()->json([
                    "status"    =>  "success",
                    "msg"       =>  "Status updated successfully."
                ]);
            }
        }
    }

    //Trip list
    public function driver_list(Request $request)
    {
        $user_id=$request["user_id"];
        $date=date('Y-m-d', strtotime($request["date"]));

        $rules = array(
            "user_id"       =>  "required | numeric",
            "date"          =>  "required"
        );
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors());
            return response()->json($error, 200);
        }else{
            $trip_details=Driver::find($user_id)->trips;
            if(count($trip_details)>0){
                $trips=[];
                foreach($trip_details as $trip_detail){
                    $lists=TripRequest::where("id", $trip_detail->trip_id)
                        ->where("created_at", $date)->get();
                        foreach($lists as $list){
                            array_push($trips, [
                                "trip_id"       =>  $list->id,
                                "trip_no"       =>  $list->booking_id,
                                "start_point"   =>  $list->from_address,
                                "end_point"     =>  $list->to_address,
                                "airport_city"  =>  $list->airport,
                                "trip_type"     =>  $list->type,
                                "pickup_date"   =>  $list->pickup_date,
                                "pickup_time"   =>  date("g:i A", strtotime($list->pickup_time)),
                                "return_date"   =>  $list->return_date,
                                "distance"      =>  $list->distance,
                                "total_amount"  =>  $list->subtotal,
                                "amount_paid"   =>  $list->total,
                                "payment_method"=>  $list->payment_method,
                                "payment_status"=>  $list->payment_status,
                                "driver_status" =>  $list->status,
                                "customer_name" =>  $list->passanger_name,
                                "customer_no"   =>  $list->passanger_phone,
                                "customer_lat"  =>  $list->pickup_lat,
                                "customer_lon"  =>  $list->pickup_lon,
                                "star"          =>  ReviewModel::where("trip_id", $list->id)->value("star"),
                                "title"         =>  ReviewModel::where("trip_id", $list->id)->value("title"),
                                "review"        =>  ReviewModel::where("trip_id", $list->id)->value("review"),
                            ]);
                    }
                }
               
                return response()->json([
                    "status"    =>  "success",
                    "msg"=> $trips,
                ]);
            }else{
                return response()->json([
                    "status"    =>  "error",
                    "msg"=> "Driver list not assigned.",
                ]);
            }  
        }
    }

    //driver trip status
    public function driver_status(Request $request)
    {
        $trip_id = $request["trip_id"];
        $status = $request["status"];

        $current_status=TripRequest::where("id", $trip_id)->value("status");

        if($current_status=="Pending" && $status=="Confirmed"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);
        }else if($current_status=="Confirmed" && $status=="Assigned Driver"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);

        }else if($current_status=="Assigned Driver" && $status=="On The Way"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);

        }else if($current_status=="On The Way" && $status=="Reached Pickup Point"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);

        }else if($current_status=="Reached Pickup Point" && $status=="Trip Started"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);

        }else if($current_status=="Trip Started" && $status=="Reached Destination"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);

        }else if($current_status=="Reached Destination" && $status=="Completed"){

            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> $status]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> $status]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Trip status updated successfully."
            ]);

        }else{
            return response()->json([
                "status"    =>  "error",
                "msg"       =>  "Invalid status"
            ]);
        }
    }

    //driver reviews
  /*  public function driver_reviews(Request $request)
    {
        $user_id = $request["user_id"];
        $rules = array(
            "user_id"       =>  "required | numeric",
        );
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = array('status' => 'error', 'validation' => $validator->errors());
            return response()->json($error, 200);
        }else{
            $trip_id=Driver::find($user_id)->trips;
            if(count($trip_id)>0){
                $reviews=[];
                foreach($trip_id as $id){
                    $data=ReviewModel::where("trip_id", $id->trip_id)->get();
                    if(count($data)>0){
                        foreach($data as $value){
                            array_push($reviews,[
                                "trip_id" => $value->trip_id,
                                "stars"   =>  $value->star,
                                "title"=>     $value->title,
                                "review"=>     $value->review
                            ]);
                        }
                    }
                }
            
                return response()->json([
                    "status"    => "success",
                    "reviews"   =>  $reviews
                ]);
            }else{
                return response()->json([
                    "status"    => "error",
                    "reviews"   =>  "No review found",
                ]);
            }
        }
    }*/

    //payment
    public function payment(Request $request)
    {
        $trip_id = $request["trip_id"];
        $amount = $request["amount"];

        $trip_sub=TripRequest::where("id", $trip_id)->value("subtotal");
        $trip_tot=TripRequest::where("id", $trip_id)->value("total");
        
        if($trip_sub==($trip_tot+$amount)){
            $request_status=TripRequest::where("id", $trip_id)->update(["status"=> "Completed"]);
            $new_status=NewTrip::where("trip_id", $trip_id)->update(["status"=> "Completed"]);
            TripRequest::where("id", $trip_id)->update(["payment_status" => "Paid"]);
            TripRequest::where("id", $trip_id)->update(["total"=> $trip_tot+$amount]);
            NewTrip::where("trip_id", $trip_id)->update(["fare"=> $trip_tot+$amount]);
            return response()->json([
                "status"    =>  "success",
                "msg"       =>  "Payment collected successfully."
            ]);
        }else{
            return response()->json([
                "status"    =>  "error",
                "msg"       =>  "Please check the amount."
            ]);
        }
    }

    //driver transaction
    public function driver_transaction(Request $request)
    {
        $user_id=$request["user_id"];
        $date=date('Y-m-d', strtotime($request["date"]));

        $rules = array(
            "user_id"   =>  "required | numeric",
            "date"      =>  "required"
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $trip_details = NewTrip::where("new_trips.driver_id", $user_id)
            ->where("new_trips.created_at", $date)
            ->orderBy("id", "desc")
            ->get([
                "new_trips.con_pass_name",
                "new_trips.pickup_address",
                "new_trips.drop_address",
                "new_trips.pickup_date",
                "new_trips.pickup_time",
                "new_trips.status",
                "new_trips.subtotal",
                "new_trips.payment_method",
                "new_trips.trip_id",
                "new_trips.id"
            ]);

            if(count($trip_details)==0){
                return response()->json([
                    "status"=>"error",
                    "msg"   =>  "No trip found."
                ]);
            }else{      
                $transactions=[];
        
                foreach($trip_details as $trip_detail){
                    array_push($transactions, [
                        "transaction_id"    =>  $trip_detail->id,
                        "trip_no"           =>  TripRequest::where("id", $trip_detail->trip_id)->value("booking_id"),
                        "trip_type"         =>  TripRequest::where("id", $trip_detail->trip_id)->value("type"),
                        "passanger_name"    =>  $trip_detail->con_pass_name,
                        "passanger_no"      =>  TripRequest::where("id", $trip_detail->trip_id)->value("passanger_phone"),
                        "pickup_address"    =>  TripRequest::where("id", $trip_detail->trip_id)->value("from_address"),
                        "drop_address"      =>  TripRequest::where("id", $trip_detail->trip_id)->value("to_address"),
                        "airport_city"      =>  TripRequest::where("id", $trip_detail->trip_id)->value("airport"),
                        "pickup_date"       =>  $trip_detail->pickup_date,
                        "pickup_time"       =>  date("g:i A", strtotime($trip_detail->pickup_time)),
                        "amount"            =>  $trip_detail->subtotal,
                        "trip_status"       =>  $trip_detail->status,
                        "payment_method"    =>  $trip_detail->payment_method,
                        "payment_status"    =>  TripRequest::where("id", $trip_detail->trip_id)->value("payment_status"),
                    ]);
                }  
                return response()->json([
                    "status"=>"success",
                    "transactions" => $transactions,
                ]);
            }
        }
    }

    //driver transaction details
    public function transaction_details(Request $request)
    {
        $tran_id=$request["transaction_id"];
    
        $rules = array(
            "transaction_id"   =>  "required | numeric",
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status"    =>  "error",
                "validator"       =>   $validator->errors()
            ]);
        }else{
            $trip_details = NewTrip::where("id", $tran_id)
            ->orderBy("id", "desc")
            ->get([
                "new_trips.con_pass_name",
                "new_trips.pickup_address",
                "new_trips.drop_address",
                "new_trips.pickup_date",
                "new_trips.pickup_time",
                "new_trips.status",
                "new_trips.subtotal",
                "new_trips.payment_method",
                "new_trips.trip_id",
                "new_trips.id"
            ]);

            if(count($trip_details)==0){
                return response()->json([
                    "status"=>"error",
                    "msg"   =>  "No trip found."
                ]);
            }else{      
                $transactions=[];
        
                foreach($trip_details as $trip_detail){
                    array_push($transactions, [
                        "transaction_id"    =>  $trip_detail->id,
                        "trip_no"           =>  TripRequest::where("id", $trip_detail->trip_id)->value("booking_id"),
                        "trip_type"         =>  TripRequest::where("id", $trip_detail->trip_id)->value("type"),
                        "passanger_name"    =>  $trip_detail->con_pass_name,
                        "passanger_no"      =>  TripRequest::where("id", $trip_detail->trip_id)->value("passanger_phone"),
                        "pickup_address"    =>  TripRequest::where("id", $trip_detail->trip_id)->value("from_address"),
                        "drop_address"      =>  TripRequest::where("id", $trip_detail->trip_id)->value("to_address"),
                        "airport_city"      =>  TripRequest::where("id", $trip_detail->trip_id)->value("airport"),
                        "pickup_date"       =>  $trip_detail->pickup_date,
                        "pickup_time"       =>  date("g:i A", strtotime($trip_detail->pickup_time)),
                        "amount"            =>  $trip_detail->subtotal,
                        "trip_status"       =>  $trip_detail->status,
                        "payment_method"    =>  $trip_detail->payment_method,
                        "payment_status"    =>  TripRequest::where("id", $trip_detail->trip_id)->value("payment_status"),
                    ]);
                }  
                return response()->json([
                    "status"=>"success",
                    "transactions" => $transactions,
                ]);
            }
        }
    }
}
