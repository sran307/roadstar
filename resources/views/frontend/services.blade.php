@extends("frontend.layout")
@section("title", "Service")
@section("content")
<?php
$sliders=App\Models\SliderModel::all();
?>
	<!--Inner Banner Section Start
	<div class="tj-inner-banner">
	    <div class="container">
	    	<h2>{{$heading->main_heading}}</h2>
	    </div>
	</div> 	
	<!--Cab Services Section Start-->
	<div class="tj-slider">
		<div class="tj-cab-slider sr_service_slider" id="cab-slider">
			@foreach($sliders as $slider)
			<div class="slide-item">
					<img src="{{asset('images/slider_image/'.$slider->images)}}" alt=""/>
			</div>
			@endforeach
		</div>
		<div class="homeslidecaption sr_service_slider">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12 col-xxl-12">
					<div class="slide-itemz"> 
						<div class="slide-caption sr_service_caption">
							<div class="slide-inner">
								<h2>{{$heading->main_heading}}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<section class="cab-services">
		<div class="container">
			<div class="row">
				<!--Cab Services Heading Start-->
			<!--	<div class="tj-heading-style">
					<h3> {{$heading->main_heading}}</h3>
						<p>{{$heading->sub_heading}}</p>
				</div>-->
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
						<!--Cab Services Info End-->
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>		
	<!--Cab Services Section Start--> 
			
@endsection