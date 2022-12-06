@extends("frontend.layout")
@section("title", "Cabs")
@section("content")

<div class="viewcabcabz">
	<div class="container sr_bg">
        <div class="row">
            <div class="col-md-5"  <?php if($type=="airport_to"){echo 'style="display:none"';}?>>
                <div class="pickadalone">
                     <span>{{$airport_address}}</span> > <span>{{$drop_city}}</span><span>({{$type}})</span>
                 </div>
            </div>
			<div class="col-md-5"  <?php if($type=="airport_from"){echo 'style="display:none"';}?>>
                <div class="pickadalone">
                     <span>{{$pickup_city}}</span> > <span>{{$airport_address}}</span><span>({{$type}})</span>
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
            </div>
           
            <div class="col-md-3">
                 <div class="devdfztantz">
                <button class="btn btn-primary" data-toggle="modal" id="modify_model" data-target="#trip_Modal">Modify</button>
            </div>
        </div>
	</div>

<section class="viewcabz">
	<div class="container">
        @foreach($cabs as $cab)
        <div class="sr_cabs_table">
            <?php $basefare=App\Models\OutstationModel::where("vehicle_type", $cab->model)->value("base_fare");
				$basefare_km=App\Models\OutstationModel::where("vehicle_type", $cab->model)->value("base_fare_km");
				$price_per_km=App\Models\OutstationModel::where("vehicle_type", $cab->model)->value("price_per_km");
                   
            ?>
            <div class="srcaimgz"><img src="{{asset('images/fleets/'.$cab->image)}}" alt=""></div>
            <div><?php echo(App\Models\ManageBrand::where("id", $cab->brand)->value("brand_name")." / ". App\Models\ManageModel::where("id", $cab->model)->value("model_name"));?></div>
            <div class="text-center"><img src="images/icons/gst.png" alt=""><p>Includes Toll <br>State Tax& Gst</p></div>
            <div class="text-center"><img src="images/icons/cert.png" alt=""><p>Top Rated Cabs &<br> Chauffeurs</p></div>
            <div>{{round((($travel_distance-$basefare_km)*$price_per_km)+$basefare),}}> upto {{$travel_distance}}km</div>
            <div>
                <form action="{{route('passenger_contact')}}" method="post">
                    @csrf
                    <input type="hidden" name="type" id="model_type" value="{{$type}}">
                    <input type="hidden" name="pick_address" value="{{$pickup_city}}">
					<input type="hidden" name="airport_address" value="{{$airport_address}}">
					<input type="hidden" name="drop_address" value="{{$drop_city}}">
                    <input type="hidden" name="pick_date" id="model_pick_date" value="{{$date}}">
                    <input type="hidden" name="trip_time" value="{{$time}}">
                    <input type="hidden" name="car_model" value="{{$cab->model}}">
                    <input type="hidden" name="car_brand" value="{{$cab->brand}}">
					<input type="hidden" name="distance" value="{{$travel_distance}}">
                    <input type="hidden" name="vehicle_id" value="<?php echo(App\Models\ManageFleet::where("travel_type","local_80")->where("model", $cab->model)->value("id"))?>">
                    <input type="hidden" name="amount" value="{{round((($travel_distance-$basefare_km)*$price_per_km)+$basefare),}}">
                            
                           
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
                        <div class="tab-pane active" id="third-way">
								<!--Banner Form 2 Content Start-->
								<form method="POST" action="{{route('view_cabs')}}" class="trip-frm2">
								    @csrf
								    <input type="hidden" name="type" value="airport">
								    <div class="col-md-12 col-sm-12">
										<h5> City </h5>
										<select name="airport_city" class="form-control sr_pick_addres">
											<option value="">Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}"<?php if($city->city==$airport_address){ echo("selected");}?>>{{$city->city}}</option>
											@endforeach
										</select>
										@if($errors->has("airport_city"))
                    						<span class="alert alert-danger">{{$errors->first("airport_city")}}</span>
                						@endif
									
									</div>
									<div class="col-md-12 col-sm-12">
										<h5>Trip </h5>
										<select name="trip" class="form-control" id="select_trip">
											<option value="fa">Cab From The Airport</option>
											<option value="ta">Cab To The Airport</option>
										</select>
									</div>	
									<div class="col-md-12 col-sm-12" id="pick_air_city" style="display:none">
										<h5>Pick Up Address</h5>
										<select name="pickup_city" class="form-control sr_pick_addres">
											<option value="">Select Pick Up City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}"<?php if($city->city==$pickup_city){ echo("selected");}?>>{{$city->city}}</option>
											@endforeach
										</select>
										@if($errors->has("pickup_city"))
                    						<span class="alert alert-danger">{{$errors->first("pickup_city")}}</span>
                						@endif
									</div>
									<div class="col-md-12 col-sm-12" id="drop_air_city">
										<h5>Drop Address</h5>
										<select name="drop_city" class="form-control sr_pick_addres">
											<option value="">Select Drop City</option>
											@foreach($cities as $city)
										<option value="{{$city->id}}"<?php if($city->city==$drop_city){ echo("selected");}?>>{{$city->city}}</option>
											@endforeach
										</select>
										@if($errors->has("drop_city"))
                    						<span class="alert alert-danger">{{$errors->first("drop_city")}}</span>
                						@endif
									</div>
													
									<div class="col-md-6 col-sm-6">
										<h5>Pick Up </h5>
										<div class="field-box">
											<input type="date" name="pickup_date" value="{{$date}}" class="form-control sr_pick_date">
											@if($errors->has("pickup_date"))
                    							<span class="alert alert-danger">{{$errors->first("pickup_date")}}</span>
                							@endif
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<h5>Pick Up At</h5>
										<div class="field-box">
											<select name="pickup_time"class="form-control" id="">
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
											@if($errors->has("pickup_time"))
                    							<span class="alert alert-danger">{{$errors->first("pickup_time")}}</span>
                							@endif
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
