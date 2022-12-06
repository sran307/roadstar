@extends("frontend.layout")
@section("title", "Cabs")
@section("content")

<div class="viewcabcabz">
	<div class="container sr_bg">
        <div class="row">
            <div class="col-md-5">
                <div class="pickadalone">
                     <span>{{$pick_address}}</span> > <span>{{$drop}}</span><span>({{$type}})</span>
                 </div>
            </div>
            <div class="col-md-2">
               <div class="devtantz">
                <p>Pick Up</p>
                <p>{{$date}}</p>
                 </div>  
            </div>
            @if($type=="round")
            <div class="col-md-2">
                 <div class="devtantz">
                <p>Return</p>
                <p>{{$rdate}}</p>
            </div>
            </div>
            @endif
            <div class="col-md-2">
                 <div class="devtantz">
                <p>Time</p>
                <p><?php echo (date("g:i A", strtotime($time))); ?></p>
                
            </div>
            </div>
            <div class="col-md-3">
                 <div class="devdfztantz">
                <button class="btn btn-primary" data-toggle="modal" id="modify_model" data-target="#trip_Modal">Modify</button>
            </div>
            </div>
        </div>
      
    </div>
</div>

<section class="viewcabz">
	<div class="container">
        @foreach($cabs as $cab)
        <div class="sr_cabs_table">
                  <?php $basefare=App\Models\OutstationModel::where("vehicle_type", $cab->model)->where('type', $type)->value("base_fare");
                    $basefare_km=App\Models\OutstationModel::where("vehicle_type", $cab->model)->where('type', $type)->value("base_fare_km");
                    $price_per_km=App\Models\OutstationModel::where("vehicle_type", $cab->model)->where('type', $type)->value("price_per_km");
                    $driver_allowance=App\Models\OutstationModel::where("vehicle_type", $cab->model)->where('type', $type)->value("allowance");
                    $toll=App\Models\OutstationModel::where("vehicle_type", $cab->model)->where('type', $type)->value("extra_charge");
                    //dd($driver_allowance);
                    $total_distance=$travel_distance;
                    $remain_distance=$total_distance-$basefare_km;?>
                    <div class="srcaimgz"><img src="{{asset('images/fleets/'.$cab->image)}}" alt=""></div>
                     <div><?php echo(App\Models\ManageBrand::where("id", $cab->brand)->value("brand_name")." / ". App\Models\ManageModel::where("id", $cab->model)->value("model_name"));?></div>
                    <div class="text-center"><img src="images/icons/gst.png" alt=""><p>Includes Toll <br>State Tax& Gst</p></div>
                    <div class="text-center"><img src="images/icons/cert.png" alt=""><p>Top Rated Cabs &<br> Chauffeurs</p></div>
                    <div>{{$travel_distance}}km Distance, Price: {{$basefare,}}> upto {{$basefare_km}}km</div>
                    <div>
                        <form action="{{route('passenger_contact')}}" method="post">
                            @csrf
                            <input type="hidden" name="type" id="model_type" value="{{$type}}">
                            <input type="hidden" name="pick_address" value="{{$pick_address}}">
                            <input type="hidden" name="drop_address" value="{{$drop}}">
                            <input type="hidden" name="pick_date" id="model_pick_date" value="{{$date}}">
                            <input type="hidden" name="trip_time" value="{{$time}}">
                            <input type="hidden" name="car_model" value="{{$cab->model}}">
                            <input type="hidden" name="car_brand" value="{{$cab->brand}}">
                            <input type="hidden" name="vehicle_id" value="<?php echo(App\Models\ManageFleet::where("travel_type", $type)->where("model", $cab->model)->value("id"))?>">
                            <input type="hidden" name="distance" value="{{$travel_distance}}">
                            <input type="hidden" name="return_date" value="{{$rdate}}">
                            <input type="hidden" name="amount" value="{{$basefare}}">
                            <input type="hidden" name="base_distance" value="{{$basefare_km}}">
                            <input type="hidden" name="extra_charge" value='{{$price_per_km}}'>
                            <input type="hidden" name="driver_allowance" value="{{$driver_allowance}}">
                            <input type="hidden" name="toll" value="{{$toll}}">
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
                        <div class="tab-pane active" id="one-way"> 
                        <form method="POST" action="{{route('view_cabs')}}" class="trip-frm2 sr_oneway_form">
                            @csrf
                            @method("post")
                            <div class="col-md-12 col-sm-12">
                                <div class="wayinline">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input sr_travel_type" value="oneway" name="type" <?php if($type=="oneway"){echo("checked");}?>> One Way
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input sr_travel_type" value="round" id="model_check_type" name="type" <?php if($type=="round"){echo("checked");}?>> Round Trip
                                        </label>
                                    </div> 
                                </div>
                            </div>
                            <!-- One way form start -->
                                <div class="col-md-12 col-sm-12">
                                    <h5>From</h5>
                                    <select name="pickup" class="form-control" id="sr_pick_address" >
                                        <option value="">Select Pick Up City</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}"<?php if($city->city==$pick_address){ echo("selected");}?>>{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h5>To</h5>
                                    <select name="drop" class="form-control" id="sr_drop_address" >
                                        <option value="">Select Drop City</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}"<?php if($city->city==$drop){ echo("selected");}?>>{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 sr_show_class" >
                                    <h5>Pick Up </h5>
                                    <div class="field-box">
                                        <input type="date" name="pick_date" value="{{$date}}" class="form-control sr_model_pick_date">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 sr_round_form"<?php if($type!="round"){ echo('style="display:none"');}?> >
                                    <h5>Return </h5>
                                    <div class="field-box">
                                        <input type="date" name="return_date" value="{{$rdate}}" class="form-control sr_model_return_date">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 sr_show_class" required>
                                    <h5>Pick Up At</h5>
                                    <div class="field-box">
											<select name="trip_time"  class="form-control" id="">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
