@extends("frontend.layout")
@section("title", "About")
@section("content")		
	<!--Inner Banner Section Start-->
	@foreach($data as $value)
	<div class="tj-inner-banner">
	    <div class="container">
	    	<h2>{{$value->heading1}}</h2>
	    </div>
	</div>
	 <!--About Facts Section Start-->
	 <!-- About Widget Section Start -->
	<section class="tj-aboutus">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="about-info bounceInLeft animated delay-2s">
						<div class="tj-heading-style">
							<h3>{{$value->heading2}}</h3>
						</div>
							<div><?php echo $value->details ?></div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="about-banner bounceInRight animated delay-2s">
							<img src="{{asset('images/page_images/'.$value->image)}}" alt=""/>
						</div>
					</div>
				</div>
			</div>
		</section>
		@endforeach
		<!-- About Widget Section End -->
		<!-- Widget 2 Start -->
		<section class="tj-facts2">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="fact-outer">
							<i class="far fa-smile"></i>
							<div class="fact-desc">
								<h3 class="fact-num">{{$widget1_details}}</h3>
								<strong>K</strong>
								<span>{{$widget1_title}}</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="fact-outer">
							<i class="fas fa-tachometer-alt"></i>
							<div class="fact-desc">
								<h3 class="fact-num">{{$widget2_details}}</h3>
								<strong>K</strong>
								<span>{{$widget2_title}}</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="fact-outer">
							<i class="fas fa-user-circle"></i>
							<div class="fact-desc">
								<h3 class="fact-num">{{$widget3_details}}</h3>
								<span>{{$widget3_title}}</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="fact-outer">
							<i class="far fa-map"></i>
							<div class="fact-desc">
								<h3 class="fact-num">{{$widget4_details}}</h3>
								<span>{{$widget4_title}}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Widget 2 End -->	
		<!-- Testimonial Section Start -->	
		<section class="tj-reviews">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="tj-heading-style">
							<h3>{{$heading}}</h3>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div id="testimonial-slider" class="reviews-slider">
						@foreach($testimonials as $testimonial)
							@if($testimonial->status=="active")
							<div class="review-item">
								<figure class="img-box">
									<img src="{{asset('images/profile_image/'.$testimonial->image)}}" alt="" />
								</figure>
								<div class="review-info">
									<strong>{{$testimonial->name}}</strong>
									@for($i=1;$i<=$testimonial->rating;$i++)
									<span class="icon-star-empty icomoon rating"></span>
									@endfor
									@for($i=1;$i<=(5-$testimonial->rating);$i++)
									<span class="icon-star-empty icomoon"></span>
									@endfor
									<div class="review-quote">
										<p>{{$testimonial->description}}</p>
									</div>
								</div>
							</div>
							@endif
						@endforeach
						</div>
					</div>	
				</div>
			</div>
		</section>
	 	<!-- Testimonial Section End -->	
@endsection
			
			
			
	 