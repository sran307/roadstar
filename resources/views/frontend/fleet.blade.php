@extends("frontend.layout")
@section("title", "Fleets")
@section("content")
			
	<div class="tj-inner-banner">
	    <div class="container">
	    	<h2>  {{$heading}}  </h2>
	    </div>
	</div>
	<section class="car-fleet">
		<div class="container">
			<div class="row">
				<!--Fleet Column Start-->
				@foreach($fleets as $fleet)
				<div class="col-md-12 col-sm-12"> 		
					<!--Tab Content Start-->
					<div class="tab-content">  
						<div class="tab-pane active" id="car-list">
							<!--Fleet List Box Wrapper Start-->
							<div class="fleet-list">
								<div class="row">
									<!--Fleet List Box Start-->
									<div class="col-md-12 col-sm-12">
										<div class="fleet-list-box">
											<!--Fleet List Thumb Start-->
											<figure class="fleet-thumb">
												<img src="{{asset('images/fleets/'.$fleet->image)}}" alt=""/>
											</figure>
											<!--Fleet List Thumb End-->
											<!--Fleet List Text Start-->
											<div class="fleet-text">
												<div class="price-box">
													<span class="rated">Top Rated</span>
													<strong> Inr {{$fleet->price_per_km}}<span>/ KM</span></strong>
												</div>
												<h3>{{$fleet->brand_name}} {{$fleet->model_name}}</h3>
												<ul class="fleet-meta">
													<li><i class="fas fa-taxi"></i>{{$fleet->name}}</li>
													<li><i class="fas fa-user-circle"></i>{{$fleet->seating}} Passengers</li>
													<li><i class="fas fa-tachometer-alt"></i>5.6/100 MPG</li>
													<li><i class="fas fa-briefcase"></i>Air Bags {{$fleet->bags}}</li>
												</ul>
												<span class="fas fa-star"></span>
												<span class="fas fa-star"></span>
												<span class="fas fa-star"></span>
												<span class="fas fa-star"></span>
												<span class="fas fa-star"></span>
												<?php echo($fleet->features)?>
												<a href="{{route('about')}}" class="tj-btn">Book Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
											</div>
											<!--Fleet List Text Start-->
										</div>
									</div>
									<!--Fleet List Box End-->
								</div>
							</div>
						</div> 
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section> 
		
@endsection