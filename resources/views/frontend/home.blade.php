@extends("frontend.layout")
@section("title", "Road Star-Go Anywhere")
@section("content")
<?php
	//header data
	$data = App\Models\GeneralSetting::all();
	foreach($data as $value){
		$logo=$value->website_logo;
		$address=$value->address;
		$email=$value->email;
		$phone=$value->phone;
		$web_url=$value->website_url;
		$web_name=$value->site_name;
		$title=$value->meta_title;
		$keyword=$value->meta_keyword;
		$description=$value->meta_description;
	}
	//slider data
	$sliders=App\Models\SliderModel::all();
	//first widget feature
	$features=App\Models\Widget1Model::all();
	//about widget
	$abouts=App\Models\AboutWidget::all();
	//headings
	$heading1=App\Models\HeadingModel::where("id", 2)->get();
	$heading2=App\Models\HeadingModel::where("id", 5)->get();
	$heading3=App\Models\HeadingModel::where("id", 6)->get();
	//second widget
	$widget2first=App\Models\Widget2Model::where("id", 2)->get();
	$widget2second=App\Models\Widget2Model::where("id", 3)->get();
	$widget2third=App\Models\Widget2Model::where("id", 4)->get();
	// third widget security
	$widget3=App\Models\Widget3Model::all();
	//services
	$services=App\Models\ServiceModel::all()->take(3);
	//fleets
	$fleets=App\Models\FleetModel::all();
	//footer logo
	$logos=App\Models\FooterLogo::all();
	//Footer Links
	$footer_links=App\Models\FooterLink::all();

	$airports = App\Models\CityTrip::where("type", "airport")->get();
?>	
<!------------------------------- Starting HTMl Seection ----------------------------------------------------------------------->
	<!-- Slider Header Section Start -->
	<div class="tj-slider">
		<!-- Slider Image Section Start -->
		<div class="tj-cab-slider" id="cab-slider">
			@foreach($sliders as $slider)
			<div class="slide-item">
				<img src="{{asset('images/slider_image/'.$slider->images)}}" alt=""/>
			</div>
			@endforeach
		</div>
		<!-- Slider Image Section End -->

		<div class="homeslidecaption">
			<div class="row">
				<!-- Slider Heading Section Start -->
				<div class="col-md-7 col-sm-6 col-lg-7 col-xxl-7">
					<div class="slide-itemz"> 
						<div class="slide-caption">
							<div class="slide-inner">
								<strong>{{$sliders[0]->heading1}}</strong>
								<h2>{{$sliders[0]->heading2}}</h2>
							<!--	<div class="slide-btns">
									<a href="{{$slider->button_url}}" class="btn-style-2">{{$slider->button_url}}  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
								</div>-->
							</div>
						</div>
					</div>
				</div>
				<!-- Slider Heading Section End -->
				<!-- Form Section Start -->
				<div class="col-md-5 col-sm-6 col-lg-5 col-xxl-5">
					<div class="tj-banner-form2 waydetails">
						<!-- Form Head Section Start -->
						<div class="tj-form2-tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#one-way" data-toggle="tab"> Out Station </a></li>
								<li><a href="#two-way" data-toggle="tab"> Local </a></li>
								<li><a href="#third-way" data-toggle="tab"> Airport </a></li>
							</ul>
						</div> 
						<!-- Form Head Section End-->
						<div class="tab-content"> 
							<div class="tab-pane active" id="one-way"> 
							
									<div class="col-md-12 col-sm-12">
										<div class="wayinline">
											<div class="form-check-inline">
												<label class="form-check-label">
													<input type="radio" class="form-check-input sr_travel_type" value="oneway" name="optradio" checked> One Way
												</label>
											</div>
											<div class="form-check-inline">
												<label class="form-check-label">
													<input type="radio" class="form-check-input sr_travel_type" value="round" name="optradio"> Round Trip
												</label>
											</div> 
										</div>
									</div>
									<!-- One way form start -->
								<form method="POST" action="view_cabs" class="trip-frm2 sr_oneway_form">
									@csrf
									<input type="hidden" name="type" id="sr_type" value="oneway">
									<div class="col-md-12 col-sm-12">
										<h5>From</h5>
										<select name="pickup" class="form-control sr_pick_address" >
											<option value="">Select Pick Up City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->city}}</option>
											@endforeach
										</select>
											@if($errors->has("pickup"))
                    						<span class="alert alert-danger">{{$errors->first("pickup")}}</span>
                						@endif
									</div>
									<div class="col-md-12 col-sm-12">
										<h5>To</h5>
										<select name="drop" class="form-control sr_pick_address">
											<option value="">Select Drop City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->city}}</option>
											@endforeach
										</select>
											@if($errors->has("drop"))
                    						<span class="alert alert-danger">{{$errors->first("drop")}}</span>
                						@endif
									</div>
									<div class="col-md-6 col-sm-6 sr_show_class">
										<h5>Pick Up </h5>
										<div class="field-box">
											<input type="date" name="pick_date" value="{{date('Y-m-d')}}" class="form-control sr_pick_date">
												@if($errors->has("pick_date"))
                    						<span class="alert alert-danger">{{$errors->first("pick_date")}}</span>
                						@endif
										</div>
									</div>
									<div class="col-md-4 col-sm-4 sr_round_form" style="display:none" >
										<h5>Return </h5>
										<div class="field-box">
											<input type="date" name="return_date" class="form-control sr_pick_date">
												@if($errors->has("return_date"))
                    						<span class="alert alert-danger">{{$errors->first("return_date")}}</span>
                						@endif
										</div>
									</div>
									<div class="col-md-6 col-sm-6 sr_show_class">
										<h5>Pick Up At</h5>
										<div class="field-box">
											<select name="trip_time"class="form-control" id="">
												<option value="">--:--</option>
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
												@if($errors->has("trip_time"))
                    						<span class="alert alert-danger">{{$errors->first("trip_time")}}</span>
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
	
							<div class="tab-pane" id="two-way"> 
								<form method="POST" action="{{route('view_cabs')}}" class="trip-frm2">
								    @csrf
								    <input type="hidden" name="type" value="local">
									<div class="col-md-12 col-sm-12">
										<h5> City </h5>
										<select name="pickup_city" class="form-control sr_pick_address" required>
											<option value="">Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->city}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-12 col-sm-12">
										<h5>Pick Up </h5>
										<div class="field-box">
											<input type="date" name="local_date" value="{{date('Y-m-d')}}" class="form-control sr_pick_date" required>
										</div>
									</div>
									<div class="col-md-12 col-sm-12">
										<h5>Pick Up At</h5>
										<div class="field-box">
											<select name="local_time"class="form-control" id="" required>
												<option value="">--:--</option>
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

							<div class="tab-pane" id="third-way">
								<!--Banner Form 2 Content Start-->
								<form method="POST" action="{{route('view_cabs')}}" class="trip-frm2">
								    @csrf
								    <input type="hidden" name="type" value="airport">
								    <div class="col-md-12 col-sm-12">
										<h5> City </h5>
										<select name="airport_city" class="form-control sr_pick_address">
											<option value="">Select City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->city}}</option>
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
										<select name="pickup_city" class="form-control sr_pick_address">
											<option value="">Select Pick Up City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->city}}</option>
											@endforeach
										</select>
										@if($errors->has("pickup_city"))
                    						<span class="alert alert-danger">{{$errors->first("pickup_city")}}</span>
                						@endif
									</div>
									<div class="col-md-12 col-sm-12" id="drop_air_city">
										<h5>Drop Address</h5>
										<select name="drop_city" class="form-control sr_pick_address">
											<option value="">Select Drop City</option>
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->city}}</option>
											@endforeach
										</select>
										@if($errors->has("drop_city"))
                    						<span class="alert alert-danger">{{$errors->first("drop_city")}}</span>
                						@endif
									</div>
													
									<div class="col-md-6 col-sm-6">
										<h5>Pick Up </h5>
										<div class="field-box">
											<input type="date" name="pickup_date" value="{{date('Y-m-d')}}" class="form-control sr_pick_date">
											@if($errors->has("pickup_date"))
                    							<span class="alert alert-danger">{{$errors->first("pickup_date")}}</span>
                							@endif
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<h5>Pick Up At</h5>
										<div class="field-box">
											<select name="pickup_time"class="form-control" id="">
												<option value="">--:--</option>
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
				<!-- Form Section End -->
			</div>
		</div>
	</div>
	<!-- Slider Header Section End -->
	<!-- Feature Widget section Start -->
	<section class="tj-offers">
		<div class="row">
			@foreach($features as $feature)
			<div class="col-md-3 col-sm-6">
				<div class="offer-box">
					<img src="{{asset('images/icons/'.$feature->icon)}}" alt=""/>
					<div class="offer-info">
						<h4>{{$feature->heading}}</h4>
						<p>{{$feature->details}}</p>
					</div>
				</div>
			</div>
			@endforeach
			<!--<div class="col-md-3 col-sm-6">
				<div class="offer-box">
				<img src="images/24-hours.png" alt=""/>
					<div class="offer-info">
						<h4>24/7 Customer Care</h4>
						<p>Roadstar was founded for helping out and connecting various travelers to different places..</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="offer-box">
					<img src="images/moving-home.png" alt=""/>
					<div class="offer-info">
						<h4>Home Pickups</h4>
						<p>Roadstar was founded for helping out and connecting various travelers to different places.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="offer-box">
					<img src="images/handshake.png" alt=""/>
					<div class="offer-info">
						<h4>Easy Bookings</h4>
						<p>Roadstar was founded for helping out and connecting various travelers to different places.</p>
					</div>
				</div>
			</div>-->
		</div>
	</section>
	<!-- Feature Widget section End -->
	<!-- About US Section Start -->
	<section class="tj-welcome">
		<div class="container">
			@foreach($abouts as $about)
			<div class="row">
				<div class="col-md-6 col-sm-7">
					<div class="about-info">
						<div class="tj-heading-style">
							<h3> {{$about->title}}</h3>
						</div>
					<?php echo $about->details; ?>
				</div>
			</div>
			<div class="col-md-6 col-sm-5">
				<div class="welcome-banner">
					<img src="{{asset('images/icons/'.$about->image)}}" alt=""/>
				</div>
			</div> 
			@endforeach
		</div>
	</section>
	<!-- About US Section End -->
	<!-- Booking Section Start -->	
	<section class="tj-book-services">
		<div class="container">
			<div class="row"> 
				<div class="col-md-12 col-sm-12">
					<div class="tj-heading-style">
						@foreach($heading1 as $value)
						<h3>{{$value->main_heading}}</h3>
						<p>{{$value->sub_heading}}</p>
						@endforeach
					</div>
				</div>
				<!--Booking Services Heading End-->
				<!--Booking Services Box Start-->
				<div class="col-md-4 col-sm-4">
					<div class="service-box">
						<div class="icon-outer">
							<span>01</span>
							<i class="far fa-edit"></i>
						</div>
						<div class="service-caption">
							@foreach($widget2first as $value)
							<h3>{{$value->heading}}</h3>
							<p>{{$value->details}}</p>
							<a href="{{route('about')}}">{{$value->button_name}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
							@endforeach
						</div>
					</div>
				</div>
				<!--Booking Services Box End-->
				<!--Booking Services Box Start-->
				<div class="col-md-4 col-sm-4">
					<div class="service-box">
						<div class="icon-outer">
							<span>02</span>
							<i class="fas fa-taxi"></i>
						</div>
						<div class="service-caption">
							@foreach($widget2second as $value)
							<h3>{{$value->heading}}</h3>
							<p>{{$value->details}}</p>
							<a href="{{route('about')}}">{{$value->button_name}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
							@endforeach
						</div>
					</div>
				</div>
				<!--Booking Services Box End-->
				<!--Booking Services Box Start-->
				<div class="col-md-4 col-sm-4">
					<div class="service-box">
						<div class="icon-outer">
							<span>03</span>
							<i class="far fa-thumbs-up"></i>
						</div>
						<div class="service-caption">
						@foreach($widget2third as $value)
							<h3>{{$value->heading}}</h3>
							<p>{{$value->details}}</p>
							<a href="{{route('about')}}">{{$value->button_name}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
						@endforeach
					</div>
				</div>
			</div>
			<!--Booking Services Box End-->
		</div>
	</section>
	<!-- Booking Section End -->			 
	<!-- Safety Widget Section Start -->		 
	<section class="tj-promo-offer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="promo-box">
						@foreach($widget3 as $value)
						<h3> {{$value->heading}} </h3>
						<p> {{$value->details}} </p>
						<a href="{{route('about')}}"> {{$value->button_name}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Safety Widget Section End -->	
	<!-- Services Widget Section Start -->		 
	<section class="cab-services">
		<div class="container">
			<div class="row">
				<!--Cab Services Heading Start-->
				<div class="tj-heading-style">
					@foreach($heading2 as $value)
					<h3>{{$value->main_heading}}</h3>
					<p> {{$value->sub_heading}} </p>
					@endforeach
				</div>
				<!--Cab Services Heading End-->
				@foreach($services as $service)
				<div class="col-md-4 col-sm-4">
					<div class="cab-service-box">
						<figure class="service-thumb">
							<img src="{{asset('images/icons/'.$service->images)}}" alt=""/>
						</figure>
						<div class="service-desc">
							<h4>{{$service->heading}}</h4>
							<div><?php echo $service->details; ?></div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>		
	<!-- Services Widget Section End -->			
	<!-- Fleet Section Start -->	
	<section class="tj-cab-collection">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="tj-heading-style">
						@foreach($heading3 as $heading)
						<h3> {{$heading->main_heading}} </h3>
						<p>{{$heading->sub_heading}}</p>
						@endforeach
					</div>
				</div>
				<div class="cab-col-outer">
					@foreach($fleets as $fleet)
					<div class="col-md-6 col-sm-6">
						<div class="fleet-grid-box">
							<figure class="fleet-thumb">
								<img src="{{asset('images/fleets/'.$fleet->image)}}" alt="">
								<figcaption class="fleet-caption">
									<div class="price-box">
										<strong>${{$fleet->amount_per_day}} <span>/ day</span></strong>
									</div>
									<span class="rated">Top Rated</span>
								</figcaption>
							</figure>
							<div class="fleet-info-box">
								<div class="fleet-info">
									<h3>{{$fleet->name}}</h3>
									@for($i=0;$i<$fleet->rating;$i++)
									<span class="fas fa-star"></span>
									@endfor
									<ul class="fleet-meta">
										<li><i class="fas fa-taxi"></i>{{$fleet->type}}</li>
										<li><i class="fas fa-user-circle"></i>{{$fleet->passengers}} Passengers</li>
										<li><i class="fas fa-tachometer-alt"></i>{{$fleet->speed}}/100 MPG</li>
									</ul>
								</div>
								<a href="{{route('fleet')}}" class="tj-btn2">{{$fleet->button_name}}<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
							</div>
							<!--Fleet Grid Text End-->
						</div>
					</div>
					<!--Fleet Grid Box End-->
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<!-- Fleet Section End -->	  
@endsection