@extends("frontend.layout")
@section("title", "Cabs")
@section("content")

<div class="viewcabcabz">
	<div class="container sr_bg">
        <div class="row">
            <div class="col-md-5">
                <div class="pickadalone">
                     <span>{{$pick_address}}</span> > <span>({{$type}})</span>
                 </div>
            </div>
            <div class="col-md-2">
               <div class="devtantz">
                <p>Pick Up</p>
                <p>{{$date}}</p>
                 </div>  
            </div>
            <div class="col-md-2">
                 <div class="devtantz">
                <p>Time</p>
                <p><?php echo (date("g:i A", strtotime($time))); ?></p>
                
            </div>
           
            <div class="col-md-3">
                 <div class="devdfztantz">
                <button class="btn btn-primary" data-toggle="modal" id="modify_model" data-target="#trip_Modal">Modify</button>
            </div>
        </div>
    </div>
    <div class="row sr_travel_type">
        <div class="col-md-6 devdfztantz ">
            <select name="travel_type" id="travel_changer" class="form-control">
                <option value="local_80" selected>8 hrs|80 kms</option>
                <option value="local_120">12 hrs|120 kms</option>
            </select>
        </div>
    </div>

<section class="viewcabz" id="local_80_id" style="display:block">
	<div class="container">
        @foreach($cabs as $cab)
        <div class="sr_cabs_table">
                  <?php $basefare=App\Models\DailyFare::where("vehicle_type", $cab->model)->where("road_trip", "8hr")->value("base_fare");
                    $basefare_km=App\Models\DailyFare::where("vehicle_type", $cab->model)->where("road_trip", "8hr")->value("base_fare_km");
                    $price_per_km=App\Models\DailyFare::where("vehicle_type", $cab->model)->where("road_trip", "8hr")->value("price_per_km");
                   
                   ?>
                    <div class="srcaimgz"><img src="{{asset('images/fleets/'.$cab->image)}}" alt=""></div>
                    <div><?php echo(App\Models\ManageBrand::where("id", $cab->brand)->value("brand_name")." / ". App\Models\ManageModel::where("id", $cab->model)->value("model_name"));?></div>
                    <div class="text-center"><img src="images/icons/gst.png" alt=""><p>Includes Toll <br>State Tax& Gst</p></div>
                    <div class="text-center"><img src="images/icons/cert.png" alt=""><p>Top Rated Cabs &<br> Chauffeurs</p></div>
                    <div>Extra Hour Charge {{$basefare_km}} & Extra KM Charge {{$price_per_km}} , {{$basefare,}}> upto 80 km</div>
                    <div>
                        <form action="{{route('passenger_contact')}}" method="post">
                            @csrf
                            <input type="hidden" name="type" id="model_type" value="local_80">
                            <input type="hidden" name="pick_address" value="{{$pick_address}}">
                         
                            <input type="hidden" name="pick_date" id="model_pick_date" value="{{$date}}">
                            <input type="hidden" name="trip_time" value="{{$time}}">
                            <input type="hidden" name="car_model" value="{{$cab->model}}">
                            <input type="hidden" name="car_brand" value="{{$cab->brand}}">
                            <input type="hidden" name="vehicle_id" value="<?php echo(App\Models\ManageFleet::where("travel_type","local_80")->where("model", $cab->model)->value("id"))?>">
                            <input type="hidden" name="amount" value="{{$basefare}}">
                            
                           
                            <button class="btn btn-primary" type="submit">SELECT</button>
                        </form>
                    </div>
               
        </div>	
		@endforeach			
	</div>
</section> 

<section class="viewcabz" id="local_120_id" style="display:none">
	<div class="container">
        @foreach($cabs_120 as $cab)
        <div class="sr_cabs_table">
                  <?php $basefare=App\Models\DailyFare::where("vehicle_type", $cab->model)->where("road_trip", "12hr")->value("base_fare");
                    $basefare_km=App\Models\DailyFare::where("vehicle_type", $cab->model)->where("road_trip", "12hr")->value("base_fare_km");
                    $price_per_km=App\Models\DailyFare::where("vehicle_type", $cab->model)->where("road_trip", "12hr")->value("price_per_km");
                   
                   ?>
                    <div class="srcaimgz"><img src="{{asset('images/fleets/'.$cab->image)}}" alt=""></div>
                     <div><?php echo(App\Models\ManageBrand::where("id", $cab->brand)->value("brand_name")." / ". App\Models\ManageModel::where("id", $cab->model)->value("model_name"));?></div>
                    <div class="text-center"><img src="images/icons/gst.png" alt=""><p>Includes Toll <br>State Tax& Gst</p></div>
                    <div class="text-center"><img src="images/icons/cert.png" alt=""><p>Top Rated Cabs &<br> Chauffeurs</p></div>
                    <div>Extra Hour Charge {{$basefare_km}} & Extra KM Charge {{$price_per_km}} , {{$basefare,}}> upto 120 km</div>
                    <div>
                        <form action="{{route('passenger_contact')}}" method="post">
                            @csrf
                            <input type="hidden" name="type" id="model_type" value="local_120">
                            <input type="hidden" name="pick_address" value="{{$pick_address}}">
                         
                            <input type="hidden" name="pick_date" id="model_pick_date" value="{{$date}}">
                            <input type="hidden" name="trip_time" value="{{$time}}">
                            <input type="hidden" name="car_model" value="{{$cab->model}}">
                            <input type="hidden" name="car_brand" value="{{$cab->brand}}">
                            <input type="hidden" name="vehicle_id" value="<?php echo(App\Models\ManageFleet::where("travel_type","local_120")->where("model", $cab->model)->value("id"))?>">
                            <input type="hidden" name="amount" value="{{$basefare}}">
                            
                           
                            <button class="btn btn-primary" type="submit">SELECT</button>
                        </form>
                    </div>
               
        </div>	
		@endforeach			
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="trip_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="tab-content">
                       <div class="tab-pane active" id="two-way"> 
								<form method="POST" action="{{route('view_cabs')}}" class="trip-frm2">
								    @csrf
								    <input type="hidden" name="type" value="local">
									<div class="col-md-12 col-sm-12">
										<h5> City </h5>
										<select name="pickup_city" class="form-control sr_pick_addres" required>
											<option value="">Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}"<?php if($city->city==$pick_address){ echo("selected");}?>>{{$city->city}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-12 col-sm-12">
										<h5>Pick Up </h5>
										<div class="field-box">
											<input type="date" name="local_date" value="{{$date}}" class="form-control sr_pick_date" required>
										</div>
									</div>
									<div class="col-md-12 col-sm-12">
										<h5>Pick Up At</h5>
										<div class="field-box">
											<select name="local_time"class="form-control" id="" required>
													<option value="{{$time}}">{{date("g:i A", strtotime($time))}}</option>
												<?php	
														date_default_timezone_set('Asia/Kolkata');
														for($hours=date("H"); $hours<24; $hours++){
    														for($mins=date("i"); $mins<60; $mins+=15) {
        														$time = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
																echo "<option value='$time'>".date("g:i A", strtotime($time))."</option>";
															}
														}
												?>
											</select>
										</div>
									</div>
									 
									<div class="col-md-9 col-sm-9">
										<div class="field-box havprcode">
											<input type="checkbox" name="fleet_coupon" id="fleet_coupon">
											<label for="fleet_coupon">I have Promotional Code</label>
										</div>
									</div>
									<div class="col-md-3 col-sm-3">
										<button type="submit" class="search-btn">Search Cabs <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>	
									</div>
								</form>
										<!--Banner Form 2 Content End-->
							</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
