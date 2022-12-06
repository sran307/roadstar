<?php

namespace App\Http\Controllers;
use App\Mail\Email;
use App\Mail\Passanger;
use Illuminate\Http\Request;
use App\Models\{
    AboutPage,
    AboutPageWidget,
    HeadingModel,
    TestimonialModel,
    BlogModel,
    ServiceModel,
    GeneralSetting,
    EmailDetail,
    City,
    State,
    ManageFleet,
    ManageBrand,
    ManageModel,
    Customer,
    DailyFare,
    TripRequest,
    CommentModel,
    CityTrip
};
use Illuminate\Support\Facades\{
    DB, Validator, Session, Mail
};
class FrontendController extends Controller
{
    public function home()
    {
        $path="home";
        $cities=City::all();
        return view("frontend.home", compact("path", "cities"));
    }
    public function about()
    {
        $data=AboutPage::all();
        $widgets=AboutPageWidget::all();
        //dd($widgets[0]['title']);
        $widget1_title=$widgets[0]['title'];
        $widget2_title=$widgets[1]['title'];
        $widget3_title=$widgets[2]['title'];
        $widget4_title=$widgets[3]['title'];
        $widget1_details=$widgets[0]['details'];
        $widget2_details=$widgets[1]['details'];
        $widget3_details=$widgets[2]['details'];
        $widget4_details=$widgets[3]['details'];
        $heading=HeadingModel::where("id", 7)->first();
        $heading=$heading['main_heading'];
        $testimonials=TestimonialModel::all();
        $path="about";
        return view("frontend.about", compact("data",
            "widget1_title",
            "widget2_title",
            "widget3_title",
            "widget4_title",
            "widget1_details",
            "widget2_details",
            "widget3_details",
            "widget4_details",
            "heading",
            "testimonials",
            "path"
        ));
    }
    
    public function blog()
    {
        $heading=HeadingModel::where("id", 8)->first();
        $heading=$heading['main_heading'];
        $blogs=BlogModel::orderBy("id", "desc")->get();
        $path="blog";
        return view("frontend.blog", compact("heading", "blogs", "path"));
    }
    public function service()
    {
        $path="service";
        $heading=HeadingModel::where("id", 10)->first();
        $services=ServiceModel::all();
        return view("frontend.services", compact("heading", "path", "services"));
    }

    public function all_blogs($id)
    {
        $path="blog";
        $heading=HeadingModel::where("id", 8)->first();
        $heading=$heading['main_heading'];
        $blogs=BlogModel::where("id", $id)->get();
        $images=BlogModel::orderBy("id", "desc")->take(3)->get();
        $comments=CommentModel::where("blog_id", $id)->get();
        return view("frontend.all_blogs", compact("heading", "blogs", "path", "comments", "images"));
    }
    public function contact()
    {
        $path="contact";
        $settings=GeneralSetting::first();
        return view("frontend.contact", compact("path", "settings"));
    }
    //email sending 
    public function send_email()
    {
       
        $details=[
            "title" => "mails in",
            "body"  =>  'hey there'
        ];

        Mail::to("teamadsdev15@gmail.com")->send(new Email($details));
             EmailDetail::create([
                "name"      =>  $name,
                "email"     =>  $email,
                "subject"   =>  $subject,
                "message"   =>  $message
            ]);
        if(Mail){
            return back()->with([
                Session::flash('message','Mail Send Successfully!'),
                Session::flash('alert-class', 'alert-success'),
            ]);
        } else {
            return back()->with([
                Session::flash('message', 'Mail Send Failed!'),  
                Session::flash('alert-class', 'alert-danger'),
            ]);
           
        }                    
   
    }

    //captcha
    public function refresh_captcha()
    {
        return captcha_img();
    }
    //fleets
    public function fleet()
    {
        $path="fleet";
        $heading=HeadingModel::where("id", 6)->first();
        $heading=$heading['main_heading'];
        $fleets=ManageFleet::join("manage_models", "manage_models.id", "=", "manage_fleets.model")
                            ->join("manage_brands", "manage_brands.id", "=", "manage_fleets.brand")
                            ->join("fleet_categories", "fleet_categories.id", "=", "manage_fleets.category")
                            ->join("daily_fares", "daily_fares.vehicle_type", "=", "manage_fleets.model")
                            ->get([
                                "manage_models.model_name",
                                "manage_brands.brand_name",
                                "manage_fleets.image",
                                "manage_fleets.seating",
                                "manage_fleets.features",
                                "fleet_categories.name",
                                "manage_fleets.bags",
                                "daily_fares.price_per_km"

                            ]);
        return view("frontend.fleet", compact("path", "heading", "fleets"));
    }

    //fetch city
    public function fetch_city(Request $request)
    {
        $value=$request['city'];
        if($value!=null){
            $cities=City::where("city", "like","$value%")->take(10)->get();
            $cities_states=[];
            foreach($cities  as $city){
                $state=City::find($city->id)->state->name;
                array_push($cities_states, $city->city.",".$state);
            }
        }else{
            $cities_states=$value;
        }
       
        return response()->json([
            "city"=>$cities_states
        ]);
    }

    //cabs viewing
    public function view_cabs(Request $request)
    {
      
        $path="fleet";
        //checking the type
        $type=$request["type"];
       
        if($type=='oneway'){
           
            $cabs=ManageFleet::where("travel_type", "oneway")->get();
           
            $validator=Validator::make($request->all(),[
                "pickup"        =>  "required",
                "drop"          =>  "required",
                "pick_date"     =>  "required",
                "trip_time"      =>  "required",
            ])->validate();
           
            $pick_address=City::where("id", $request["pickup"])->value("city");
            $drop=City::where("id", $request["drop"])->value("city");
            $date=$request["pick_date"];
            $time=$request["trip_time"];
            $cities=City::all();
           
            if(count(CityTrip::where("from_address", $pick_address)->where("to_address", $drop)->get())>0){
                $travel_distance=CityTrip::where("from_address", $pick_address)
                        ->where("to_address", $drop)->value("distance");
                        $rdate=0;

                        return view("frontend.view_cabs", compact("travel_distance", "cabs","path", "pick_address", "drop", "date", "time", "type", "cities", "rdate"));
            }else if(count(CityTrip::where("from_address", $drop)->where("to_address", $pick_address)->get())>0){
                $travel_distance=CityTrip::where("from_address", $drop)
                        ->where("to_address", $pick_address)->value("distance");
                        $rdate=0;

                        return view("frontend.view_cabs", compact("travel_distance", "cabs","path", "pick_address", "drop", "date", "time", "type", "cities", "rdate"));
            }else{
                $path="";
                return view("frontend.trip_error", compact("path"));
            }
        
            

        }else if($type=="round"){
            $cabs=ManageFleet::where("travel_type", "round")->get();
            $validator=Validator::make($request->all(),[
                "pickup"        =>  "required",
                "drop"          =>  "required",
                "pick_date"     =>  "required",
                "trip_time"     =>  "required",
                "return_date"   =>  "required",
            ])->validate();

            $pick_address=City::where("id", $request["pickup"])->value("city");
            $drop=City::where("id", $request["drop"])->value("city");
            $date=$request["pick_date"];
            $time=$request["trip_time"];
            $rdate=$request["return_date"];
            $cities=City::all();
            if(count(CityTrip::where("from_address", $pick_address)->where("to_address", $drop)->get())>0){
                $travel_distance=(CityTrip::where("from_address", $pick_address)
                        ->where("to_address", $drop)->value("distance"))*2;


                        return view("frontend.view_cabs", compact("travel_distance", "cabs","path", "pick_address", "drop", "date", "time", "type", "cities", "rdate"));
            }else if(count(CityTrip::where("from_address", $drop)->where("to_address", $pick_address)->get())>0){
                $travel_distance=(CityTrip::where("from_address", $drop)
                        ->where("to_address", $pick_address)->value("distance"))*2;
                    

                        return view("frontend.view_cabs", compact("travel_distance", "cabs","path", "pick_address", "drop", "date", "time", "type", "cities", "rdate"));
            }else{
                $path="";
                return view("frontend.trip_error", compact("path"));
            }
            

        }else if($type=="local"){
            $cabs=ManageFleet::where("travel_type", "local_80")->get();
            $cabs_120=ManageFleet::where("travel_type", "local_120")->get();

            $pick_address=City::where("id", $request["pickup_city"])->value("city");
            
            $date=$request["local_date"];
            $time=$request["local_time"];
            $cities=City::all();

            return view("frontend.view_cabs_local", compact("cabs_120", "cabs","path", "pick_address", "date", "time", "type", "cities"));

        }else if($type=="airport"){
            $cabs=ManageFleet::where("travel_type", "airport")->get();
            $trip=$request["trip"];

           if($trip=="fa"){
                $validator=Validator::make($request->all(),[
                    "airport_city"       =>  "required",
                    "drop_city"         =>  "required",
                    "pickup_time"       =>  "required",
                    "pickup_date"       =>  "required"
                ])->validate();

                $type="airport_from";
                $trip=$request["trip"];
                $airport_city=$request["airport_city"];
                $airport_address=City::where("id", $airport_city)->value("city");
                $drop_city=City::where("id", $request["drop_city"])->value("city");
                $date=$request["pickup_date"];
                $time=$request["pickup_time"];
                $cities=City::all();
                $rdate=$request["return_date"];
                $pickup_city="";

                if(count(CityTrip::where("from_address", $airport_address)->where("to_address", $drop_city)->get())>0){
                    $travel_distance=(CityTrip::where("from_address", $airport_address)
                            ->where("to_address", $drop_city)->value("distance"));
    
    
                            return view("frontend.view_cabs_airport", compact("pickup_city","airport_address", "trip", "travel_distance", "cabs","path", "drop_city", "date", "time", "type", "cities", "rdate"));
                }else if(count(CityTrip::where("from_address", $drop_city)->where("to_address", $airport_address)->get())>0){
                    $travel_distance=(CityTrip::where("from_address", $drop_city)
                            ->where("to_address", $airport_address)->value("distance"));
                        
    
                            return view("frontend.view_cabs_airport", compact("pickup_city", "airport_address", "trip", "travel_distance", "cabs","path", "drop_city", "date", "time", "type", "cities", "rdate"));

                }else{
                    $path="";
                    return view("frontend.trip_error", compact("path"));
                }
           }else if($trip=="ta"){
                $validator=Validator::make($request->all(),[
                    "airport_city"       =>  "required",
                    "pickup_city"         =>  "required",
                    "pickup_time"       =>  "required",
                    "pickup_date"       =>  "required"
                ])->validate();

                $type="airport_to";
                $trip=$request["trip"];
                $airport_city=$request["airport_city"];
                $airport_address=City::where("id", $airport_city)->value("city");
                $pickup_city=City::where("id", $request["pickup_city"])->value("city");
                $date=$request["pickup_date"];
                $time=$request["pickup_time"];
                $cities=City::all();
                $rdate=$request["return_date"];
                $drop_city="";

                if(count(CityTrip::where("from_address", $airport_address)->where("to_address", $pickup_city)->where('type', 'airport')->get())>0){
                    $travel_distance=(CityTrip::where("from_address", $airport_address)
                            ->where("to_address", $pickup_city)->value("distance"));
        
                            return view("frontend.view_cabs_airport", compact("pickup_city","airport_address", "trip", "travel_distance", "cabs","path", "drop_city", "date", "time", "type", "cities", "rdate"));
                }else if(count(CityTrip::where("from_address", $pickup_city)->where("to_address", $airport_address)->where('type', 'airport')->get())>0){
                    $travel_distance=(CityTrip::where("from_address", $pickup_city)
                            ->where("to_address", $airport_address)->value("distance"));
        
                            return view("frontend.view_cabs_airport", compact("pickup_city", "airport_address", "trip", "travel_distance", "cabs","path", "drop_city", "date", "time", "type", "cities", "rdate"));
                }else{
                    $path="";
                    return view("frontend.trip_error", compact("path"));
                }
            }
        }
       
    }
    //passenger Contact form
    public function contact_form(Request $request)
    {
       
        $type=$request["type"];
        if($type=="oneway"){
            $path="contact";
            $type=$request["type"];
            $trip="null";
            $pick_address=$request["pick_address"];
            $drop_address=$request["drop_address"];
            $airport_address=$request["airport_address"];
            $pick_date=$request["pick_date"];
            $pick_time=$request["trip_time"];
            $car_model=$request["car_model"];
            $car_model=ManageModel::where("id", $car_model)->value("model_name");
            $car_brand=ManageBrand::where("id", $request->car_brand)->value("brand_name");
            $amount=$request["amount"];
            $cities=City::all();
            $distance=$request["distance"];
            $extra_charge=$request["extra_charge"];
            $return_date="";
            $vehicle_id=$request["vehicle_id"];
            $base_km= $request['base_distance'];
            $toll = $request["toll"];
            $driver_allowance = $request["driver_allowance"];
            //dd($base_km);
            if($distance<=10){
                $amount=$request["amount"];
            }else if($distance>10 && $distance<=20){
                $amount=1200;
            }else if($distance>20 && $distance<=30){
                $amount=1400;
            }else if($distance>30 && $distance<=40){
                $amount=1600;
            }else if($distance>40 && $distance<=60){
                $amount=2000;
            }else if($distance>60 && $distance<=80){
                $amount=1200;
            }else if($distance>80 && $distance<=100){
                $amount=3000;
            }else if($distance>100){
                $extra_distance =300;
                $amount = $extra_distance * $extra_charge;
            }

           $net_amount=$amount+$toll+$driver_allowance;
            
            //dd($type);
            //dd($car_brand);
            return view("frontend.contact_form", compact("extra_charge", "toll", "driver_allowance", "net_amount","airport_address","vehicle_id", "return_date","distance", "trip", "path", "type", "pick_address", "drop_address", "pick_date", "pick_time", "car_model", "car_brand", "amount", "cities"));
        }else if($type=="round"){
            $path="contact";
            $type=$request["type"];
            $trip="null";
            $pick_address=$request["pick_address"];
            $drop_address=$request["drop_address"];
            $airport_address=$request["airport_address"];
            $pick_date=$request["pick_date"];
            $return_date=$request["return_date"];
            $pick_time=$request["trip_time"];
            $car_model=$request["car_model"];
            $car_model=ManageModel::where("id", $car_model)->value("model_name");
            $car_brand=ManageBrand::where("id", $request->car_brand)->value("brand_name");
            $extra_charge=$request["extra_charge"];
            $distance=$request["distance"];
            $vehicle_id=$request["vehicle_id"];
            $base_km= $request['base_distance'];
            $toll = $request["toll"];
            $driver_allowance = $request["driver_allowance"];
            //dd($toll);
           if($distance<=$base_km){
            $amount=$request["amount"];
           }else{
                $extra_distance = $distance-$base_km;
                $extra_amount = $extra_distance * $extra_charge;
                $amount=$request["amount"] + $extra_amount;
           }

           $net_amount=$amount+$toll+$driver_allowance;
            $cities=City::all();
            //dd($car_brand);
            return view("frontend.contact_form", compact("net_amount", 'toll', 'driver_allowance', "airport_address","vehicle_id", "return_date","distance", "trip", "path", "type", "pick_address", "drop_address", "pick_date", "pick_time", "car_model", "car_brand", "amount", "cities"));
        }else if($type=="local_80"){
            $path="contact";
            $type="local";
           
            $trip="null";
            $pick_address=$request["pick_address"];
            $airport_address=$request["airport_address"];
            $drop_address="Drop city not selected ";
            $distance=80;
            $return_date="";
            $pick_date=$request["pick_date"];
            $pick_time=$request["trip_time"];
            $car_model=$request["car_model"];
            $car_model=ManageModel::where("id", $car_model)->value("model_name");
            $car_brand=ManageBrand::where("id", $request->car_brand)->value("brand_name");
            $vehicle_id=$request["vehicle_id"];
            $amount=$request["amount"];
            $extra_charge=$request["extra_charge"];
            $distance=$request["distance"];
            $vehicle_id=$request["vehicle_id"];
            $base_km= $request['base_distance'];
            $toll = $request["toll"];
            $driver_allowance = $request["driver_allowance"];
            //dd($toll);
           if($distance<=$base_km){
            $amount=$request["amount"];
           }else{
                $extra_distance = $distance-$base_km;
                $extra_amount = $extra_distance * $extra_charge;
                $amount=$request["amount"] + $extra_amount;
           }
           $net_amount=$amount+$toll+$driver_allowance;
           // dd($amount);
            $cities=City::all();
            //dd($car_brand);
            return view("frontend.contact_form", compact("net_amount", 'toll', 'driver_allowance', "airport_address","vehicle_id", "return_date","distance", "trip", "path", "type", "pick_address", "drop_address", "pick_date", "pick_time", "car_model", "car_brand", "amount", "cities"));
        }else if($type=="local_120"){
            $path="contact";
            $type="local";
            $trip="null";
            $pick_address=$request["pick_address"];
            $airport_address=$request["airport_address"];
            $drop_address="Drop city not selected ";
            $distance=120;
            $return_date="";
            $pick_date=$request["pick_date"];
            $pick_time=$request["trip_time"];
            $car_model=$request["car_model"];
            $car_model=ManageModel::where("id", $car_model)->value("model_name");
            $car_brand=ManageBrand::where("id", $request->car_brand)->value("brand_name");
            $vehicle_id=$request["vehicle_id"];
            $amount=$request["amount"];
            $extra_charge=$request["extra_charge"];
            $distance=$request["distance"];
            $vehicle_id=$request["vehicle_id"];
            $base_km= $request['base_distance'];
            $toll = $request["toll"];
            $driver_allowance = $request["driver_allowance"];
            //dd($toll);
           if($distance<=$base_km){
            $amount=$request["amount"];
           }else{
                $extra_distance = $distance-$base_km;
                $extra_amount = $extra_distance * $extra_charge;
                $amount=$request["amount"] + $extra_amount;
           }
           $net_amount=$amount+$toll+$driver_allowance;
           // dd($amount);
           // dd($amount);
            $cities=City::all();
            //dd($car_brand);
            return view("frontend.contact_form", compact("airport_address", "vehicle_id", "return_date","distance", "trip", "path", "type", "pick_address", "drop_address", "pick_date", "pick_time", "car_model", "car_brand", "amount", "cities"));
        }else if($type=="airport_from"){
            $path="contact";
           
            $trip=$request["trip"];
            $airport_address=$request["airport_address"];
            $pick_address=$request["pick_address"];
            $drop_address=$request["drop_address"];
            $pick_date=$request["pick_date"];
            $pick_time=$request["trip_time"];
            $car_model=$request["car_model"];
            $car_model=ManageModel::where("id", $car_model)->value("model_name");
            $car_brand=ManageBrand::where("id", $request->car_brand)->value("brand_name");
            $amount=$request["amount"];
            $distance=$request["distance"];
            $return_date="";
            $vehicle_id=$request["vehicle_id"];
           // dd($amount);
            $cities=City::all();
            //dd($car_brand);
           
            return view("frontend.contact_form", compact("airport_address", "vehicle_id", "return_date","distance", "trip", "path", "type", "pick_address", "drop_address", "pick_date", "pick_time", "car_model", "car_brand", "amount", "cities"));
        }else if($type=="airport_to"){
            $path="contact";
           
            $trip=$request["trip"];
            $airport_address=$request["airport_address"];
            $pick_address=$request["pick_address"];
            $drop_address=$request["drop_address"];
            $pick_date=$request["pick_date"];
            $pick_time=$request["trip_time"];
            $car_model=$request["car_model"];
            $car_model=ManageModel::where("id", $car_model)->value("model_name");
            $car_brand=ManageBrand::where("id", $request->car_brand)->value("brand_name");
            $amount=$request["amount"];
            $distance=$request["distance"];
            $return_date="";
            $vehicle_id=$request["vehicle_id"];
           // dd($amount);
            $cities=City::all();
            //dd($car_brand);
            
            return view("frontend.contact_form", compact("airport_address", "vehicle_id", "return_date","distance", "trip", "path", "type", "pick_address", "drop_address", "pick_date", "pick_time", "car_model", "car_brand", "amount", "cities"));
        }
        
    }
    //passenger address 
    public function passenger_address(Request $request)
    {
        $name=$request["name"];
        $email=$request["email"];
        $phone=$request["phone"];
        $pickup=$request["pickup"];
        $validate_data=Validator::make($request->all(),[
            "name"=>"required",
            "email"=>"required|email",
            "phone"=>["required","digits:10"],
            "pickup"=>"required",
        ]);
        //validation message 
        if($validate_data->fails()){
            return response()->json([
                "status"=>400,
                "errors"=>$validate_data->messages()
            ]);
        }else{
            return response()->json([
                "status"=>200,
                "name"=>$name,
                "email"=>$email,
                "phone"=>$phone,
                "pickup"=>$pickup
            ]);
        }
    
    }

    public function pickup_confirm(Request $request)
    {
        $pick_address=$request["pick_address"];
        $drop_address=$request["drop_address"];
        $airport_address=$request["airport_address"];
        $amount = $request["amount"];
        $name = $request["name"];
        $email = $request["email"];
        $phone = $request["phone"];
        $pickup = $request["pickup"];
        $model = $request["car_brand"];
        $brand = $request["car_model"];
        $trip = $request["trip"];
        $distance=$request["distance"];
        $type=$request["type"];
        $date=$request["date"];
        $time=$request["time"];
        $vehicle_id=$request["vehicle_id"];
        $path=null;
        if(count(Customer::where("phone_number", $phone)->get())==0){
            Customer::create([
                "customer_first_name"    =>  $name,
                "email"                  =>  $email,
                "phone_number"           =>  $phone
            ]);
            $customer=Customer::where("phone_number", $phone)->value("id");
        }else{
            $customer=Customer::where("phone_number", $phone)->value("id");
        };

        $booking_id = "RSR-".rand(10000, 100000);

        $token = time();
        $vehicle_type=ManageModel::where("model_name", $model)->value("id");
        $payment_status="unpaid";
        $status="Pending";
    
        DB::beginTransaction();
        try{
            TripRequest::create([
                "customer"          =>  $customer,
                "type"              =>  $type,
                "vehicle_type"      =>  $vehicle_type,  
                "from_address"      =>  $pick_address,
                "to_address"        =>  $drop_address,
                "airport"           =>  $airport_address,
                "return_date"       =>  $request["return_date"],
                "pickup_address"    =>  City::where("id", $pickup)->value("city"),
                "subtotal"          =>  $amount,
                "booking_id"        =>  $booking_id,
                "distance"          =>  $distance,
                "status"            =>  "Pending",
                "pickup_date"       =>  $date,
                "pickup_time"       =>  $time,
                "tocken"            =>  $token,
                "vehicle_id"        =>  $vehicle_id,
                "passanger_name"    =>  $name,
                "passanger_email"   =>  $email,
                "passanger_phone"   =>  $phone,
                "payment_method"    =>  "Cash",

            ]);
            DB::commit();
           
            return view("frontend.confirm_page", compact("airport_address", "time","type","token", "payment_status", "amount","status", "distance","model", "drop_address","pick_address", "path", "name", "phone", "email", "date", "time", "booking_id"));
        }catch(\Exception $e){
            DB::rollback();
            return back()->with(
                Session::flash("message", "Cannot add the trip request"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }
    }
    
    //invoice
    public function invoice(Request $request)
    {
        
        $path="null";
        $token=$request["token"];
        $amount_paid=$request["amount_paid"];
        TripRequest::where("tocken", $token)->update([
            "total" =>$amount_paid,
        ]);
        $amount=$request["amount"];
        $trip_details = TripRequest::join("customers", "customers.id", "=", "trip_requests.customer")
        ->join("manage_models", "manage_models.id", "=", "trip_requests.vehicle_type")
        ->where("trip_requests.tocken", $token)
        ->get([
            "trip_requests.passanger_name",
            "trip_requests.passanger_phone",
            "trip_requests.passanger_email",
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

        $name          =  $trip_details[0]->passanger_name;
        $vehicle       =  $trip_details[0]->model_name;
        $type          =  $trip_details[0]->type;
        $from_address  =  $trip_details[0]->pickup_address;
        $to_address    =  $trip_details[0]->to_address;
        $airport_city  =  $trip_details[0]->airport;
        $pickup_date   =  $trip_details[0]->pickup_date;
        $return_date   =  $trip_details[0]->return_date;
        $travel_type   =  $trip_details[0]->travel_type;
        $pickup_time   =  date("g:i A", strtotime($trip_details[0]->pickup_time));
        $distance      =  $trip_details[0]->distance;
        $amount        =  $trip_details[0]->subtotal;
        $booking_id    =  $trip_details[0]->booking_id;
        $vehicle_number=  ManageFleet::where("id", $trip_details[0]->vehicle_id)->value("vehicle_number");
        $fare          =  $trip_details[0]->subtotal;
        $total_amount  =  $trip_details[0]->subtotal;
        $Tax           =  $trip_details[0]->tax;
        $net_amount   =  $trip_details[0]->subtotal+$trip_details[0]->tax;
        $payment_method=  $trip_details[0]->payment_method;
        $payment_status=  $trip_details[0]->payment_status;
        $phone_number =  $trip_details[0]->passanger_phone;
        $email=  $trip_details[0]->passanger_email;
        
        $site_email=GeneralSetting::value("email");
        $site_contact=GeneralSetting::value("phone");
        
        if($amount_paid>$amount){
            return redirect()->route("pickup_confirm")->with(
                Session::flash("message", "Paid amount must be less than total amount"), 
                Session::flash("alert-class", "alert-danger"),
            );
        }else{
            return view("frontend.invoice", compact("airport_city", "vehicle", "return_date","site_email","site_contact", "email","phone_number", "distance","type", "payment_status","fare", "pickup_date","pickup_time", "path", "vehicle_number", "name", "from_address", "to_address", "booking_id"));
        }
    }

    public function fetch_car_model(Request $request)
    {
        $val = $request['val'];
       // $model_number = ManageFleet::where("travel_type", $val)->get();
     //   $html='';
    //    foreach($model_number as $model){
        //    $models = ManageModel::where("id", $model->model)->first();
        //    $html.='<option value='.$models->id.'>'.$models->model.'</option>';
        //}
        return $val;
    }
    
}
