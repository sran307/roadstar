@extends("frontend.layout")
@section("title", "Contact")
@section("content")
	<!-- Heading Section Start -->
	<div class="tj-inner-banner">
	    <div class="container">
	    	<h2>Contact</h2>
	    </div>
	</div>
  <!-- Heading Section End -->
  <!-- Body Section Start -->
	<section class="tj-contact-section">
		<div class="container">
			<div class="row"> 
				@if(session()->has("message"))
				<p class="alert {{session()->get('alert-class')}} text-center">{{session()->get("message")}}</p>
				@endif
				<div class="tj-heading-style">
					<h3>Contact</h3>
				</div>
				<div class="col-md-8 col-sm-8">
					<!-- Form Section Start -->
					<div class="form-holder">
						<form method="POST" class="tj-contact-form" id="contact-form" action="{{route('send_email')}}">
							@csrf
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<!--Inner Holder Start-->
									<div class="inner-holder">
										<label for="name">Name <span class="star">*</span></label>
										<input placeholder="Enter Your Name" name="name" type="text" id="name" required>
									</div>
									<!--Inner Holder End-->
								</div>
								<div class="col-md-6 col-sm-6 no-pad">
									<!--Inner Holder Start-->
									<div class="inner-holder">
										<label for="email">Email <span class="star">*</span></label>
										<input placeholder="Enter Your Email" name="email" type="email" id="email">
									</div>
									<!--Inner Holder End-->
								</div>
								<div class="col-md-12 col-sm-12">
									<!--Inner Holder Start-->
									<div class="inner-holder">
										<label for="subject">Subject <span class="star">*</span></label>
										<input placeholder="Your Subject" name="subject" type="text" id="subject">
									</div>
									<!--Inner Holder End-->
								</div>
								<div class="col-md-12 col-sm-12">
									<!--Inner Holder Start-->
									<div class="inner-holder">
										<label for="message">Message <span class="star">*</span></label>
										<textarea name="message" placeholder="Your Message" id="message"></textarea>
									</div>
									<!--Inner Holder End-->
								</div>
								<div class="col-md-12 col-sm-12">
									<!--Inner Holder Start-->
									<div class="inner-holder">
										<label for="captcha">Captcha <span class="star">*</span></label>
										<div class="captcha">
											<span>{!!captcha_img()!!}</span>
											<button type="button" class="btn btn-danger btn-refresh">Refresh</button>
										</div>
										<input placeholder="Enter Captcha " name="captcha" type="text" id="captcha">
									</div>
									<!--Inner Holder End-->
								</div>
								
								<div class="col-md-12 col-sm-12">
									<div class="inner-holder">
										<button class="btn-submit" type="submit" id="frm_submit_btn">Send Message <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- Form Section End -->
				</div>
				<!-- Contact Section Start -->
				<div class="col-md-4 col-sm-4">
					<div class="address-box">
						<div class="add-info">
							<span class="icon-map icomoon"></span>
							<p>{{$settings->address}} </p>
						</div>
						<div class="add-info">
							<span class="icon-phone icomoon"></span>
							<p>
								<a href="tel:{{$settings->phone}}">{{$settings->phone}}</a> 
							</p>
						</div>
						<div class="add-info">
							<span class="icon-mail-envelope-open icomoon"></span>
							<p> 
							<a href="mailto:{{$settings->email}}">{{$settings->email}}</a>
						</p>
					</div>
				</div>
				<!-- Contact Section End -->
			</div>
		</div>
	</section>
	
	
	
	<section class="comazect">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12 col-lg-12 col-xxl-12">
	               <div class="mapizame">
	                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d121883.56883580946!2d78.51100505820311!3d17.322229099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcba3362464b18b%3A0x8bafa0c96aa8b0eb!2sRoadster%20self%20drive%20cars(RTR)!5e0!3m2!1sen!2sin!4v1642598648139!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	               </div> 
	            </div>
	        </div>
	    </div>
	</section>
	
	
	<!-- Body Section End -->	 
@endsection