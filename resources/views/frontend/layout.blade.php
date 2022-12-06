<?php
namespace App\Models;
	//header data
	$data = GeneralSetting::all();
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
		$favicon=$value->favicon;
	}
	//slider data
	$sliders=SliderModel::all();
    foreach($sliders as $slider){
        $img=$slider->images;
		$main_heading=$slider->heading1;
		$sub_heading=$slider->heading2;
		$button_name=$slider->button_name;
		$button_url=$slider->button_url;
    }
    $images=explode(",", $img);
	//first widget feature
	$features=Widget1Model::all();
	//about widget
	$abouts=AboutWidget::all();
	//headings
	$heading1=HeadingModel::where("id", 2)->get();
	$heading2=HeadingModel::where("id", 5)->get();
	$heading3=HeadingModel::where("id", 6)->get();
	//second widget
	$widget2first=Widget2Model::where("id", 2)->get();
	$widget2second=Widget2Model::where("id", 3)->get();
	$widget2third=Widget2Model::where("id", 4)->get();
	// third widget security
	$widget3=Widget3Model::all();
	//services
	$services=ServiceModel::take(3)->get();
	//fleets
	$fleets=FleetModel::all();
	//footer logo
	$logos=FooterLogo::all();
	//Footer Links
	$footer_links=FooterLink::all();
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="description" content="{{$description}} ">
		<meta name="keyword" content="{{$keyword}} ">
		<meta name="title" content="{{$title}} ">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title") </title>
        
        <link rel="shortcut icon" href="{{asset('images/logos/'.$favicon)}}" type="image/x-icon">

		<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('css/style.css')}}" rel="stylesheet">
		<link href="{{asset('css/fontawesome-all.min.css')}}" rel="stylesheet">
		<link id="switcher" href="{{asset('css/color.css')}}" rel="stylesheet">
		<link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
		<link href="{{asset('css/responsive.css')}}" rel="stylesheet">
		<link href="{{asset('css/icomoon.css')}}" rel="stylesheet">
		<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
       <style>
           .star{
            	color:red;
            }
            
            .sr_table{
            	border: 2px solid rgb(0,100,255);
            	border-radius: 10px;
            	display: flex;
            	justify-content: space-around;
            	align-items: center;
            }

       </style>
</head>
	<body>
		<div class="tj-wrapper"> 
			<header class="tj-header">
				<!-- Header Section Start -->
				<div class="container">
					<!-- Header Sub Section Start -->
					<div class="row"> 
						<!-- Header Logo Section Start -->
						<div class="col-md-3 col-sm-4 col-xs-12"> 
							<div class="tj-logo headlogo">
								<h1><a href="{{route('home')}}"><img src="{{asset('images/logos/'.$logo)}}" alt=""></a></h1>
							</div>
						</div>
						<!-- Header Logo Section End -->
						<!-- Header address and navbar section start -->
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="row">
								<!-- Header Address Start -->
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="info_box">
										<i class="fa fa-home"></i>
										<div class="info_text">
											<span class="info_title">Address</span>
											<span>{{$address}}</span>
										</div>
									</div>
								</div>
								<!-- Header Address End -->
								<!-- Header Email Start -->
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="info_box">
										<i class="fa fa-envelope"></i>
										<div class="info_text">
											<span class="info_title">Email Us</span>
											<span><a href="mailto:{{$email}}">{{$email}}</a></span>
										</div>
									</div>
								</div>
								<!-- Header Email End -->
								<!-- Header Phone Start -->
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="info_box"> 
											<i class="fas fa-phone-volume"></i> 
										<div class="info_text">
											<span class="info_title">Phone</span>
											<span><a href="tel:{{$phone}}">{{$phone}}</a></span>
										</div>
									</div>
								</div>
								<!-- Header Phone End -->
							</div>						 
							<!-- Header Contact Section End -->
							<!-- Navbar Section Start -->
							<div class="row">
								<div class="col-md-12">
									<div class="tj-nav-row">
										<div class="tj-nav-holder">
											<nav class="navbar navbar-default"> 
												<div class="navbar-header">
												<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tj-navbar-collapse" aria-expanded="false"> 
													<span class="sr-only">Menu</span>
													<span class="icon-bar"></span> 
													<span class="icon-bar"></span> 
													<span class="icon-bar"></span>
												</button>
												</div>
												<div class="collapse navbar-collapse" id="tj-navbar-collapse">
												<ul class="nav navbar-nav">
													<li class="<?php if($path=='home'){ echo('active');}?>"><a href="{{route('home')}}">Home</a></li>
													<li class="<?php if($path=='about'){ echo('active');}?>"><a href="{{route('about')}}">About</a></li>
													<li class="<?php if($path=='service'){ echo('active');}?>"><a href="{{route('service')}}">Services</a></li>
													<li class="<?php if($path=='fleet'){ echo('active');}?>"><a href="{{route('fleet')}}">  Fleets</a></li>
													<li class="<?php if($path=='blog'){ echo('active');}?>"><a href="{{route('blog')}}">Blog</a></li>
													<li class="<?php if($path=='contact'){ echo('active');}?>"><a href="{{route('contact')}}">Contact</a></li> 
												</ul>
												</div>
											</nav> 
										</div>
									</div>
								</div>
							</div>
							<!-- Navbar Section End -->
						</div>
						<!-- Header Address And Navbar Section End -->
					</div>
					<!-- Header Sub Section End -->
				</div>	
				<!-- Header Section End -->	
			</header>
					
			@yield("content")
			
			<!-- Footer Section Start -->
			<section class="tj-footer">
				<div class="container">
					<div class="row">
						<!-- Footer Logo And Social Media Section Start -->
						<div class="col-md-4">
							<div class="about-widget widget">
								<img src="{{asset('images/logos/'.$logo)}}" class="footlogo">
								<p>{{$description}}</p>
								<ul class="fsocial-links">
									@foreach($data as $value)
									<li><a href="{{$value->facebook_url}}" target=_blank><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="{{$value->twitter_url}}" target=_blank><i class="fab fa-twitter"></i></a></li>
									<li><a href="{{$value->linkedin_url}}" target=_blank><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="{{$value->youtube_url}}" target=_blank><i class="fab fa-pinterest-p"></i></a></li>
									<li><a href="{{$value->instagram_url}}" target=_blank><i class="fab fa-instagram"></i></a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<!-- Footer Logo And Social Media Section End -->
						<!-- Page Links Section Start -->
						<div class="col-md-2">
							<div class="links-widget widget">
								<h3><?php echo(HeadingModel::where("id", 9)->value("main_heading"));?></h3>
								<ul class="flinks-list">
									<li><i class="fa fa-angle-double-right"></i><a href="{{route('home')}}">Home</a></li>
                                    <li><i class="fa fa-angle-double-right"></i><a href="{{route('about')}}">About</a></li>
                                    <li><i class="fa fa-angle-double-right"></i><a href="{{route('service')}}">Services</a></li>
                                    <li><i class="fa fa-angle-double-right"></i><a href="{{route('fleet')}}">Fleets</a></li>
                                    <li><i class="fa fa-angle-double-right"></i><a href="{{route('blog')}}">Blog</a></li>
                                    <li><i class="fa fa-angle-double-right"></i><a href="{{route('contact')}}">Contact</a></li>
								</ul>
							</div>
						</div>
						<!-- Page Links Section End -->
						<!-- Services Page Headings Section Start -->
						<div class="col-md-3">
							 <div class="links-widget widget">
							 <h3><?php echo(HeadingModel::where("id", 10)->value("main_heading"));?></h3>
								<ul class="flinks-list">
									@foreach($services as $service)
									<li><i class="fa fa-angle-right"></i><a href="{{$service->button_url}}"> {{$service->heading}} </a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<!-- Services Page Headings Section End -->
						<!-- Footer Contact Section Start -->
						<div class="col-md-3">
							<div class="contact-info widget">
								<h3><?php echo(HeadingModel::where("id", 11)->value("main_heading"));?></h3>
								<ul class="contact-box">
									<li>
										<i class="fas fa-home" aria-hidden="true"></i> {{$address}}
									</li>
									<li>
										<i class="far fa-envelope-open"></i>
										<a href="mailto:{{$email}}">
										{{$email}}</a>
									</li>
									<li>
										<i class="fas fa-phone-square"></i>
										{{$phone}}
									</li>
									<li>
										<i class="fas fa-globe-asia"></i>
										<a href="{{route('home')}}">{{$web_url}}</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- Footer Contact Section End -->
					</div>
				</div>
			</section>
			<!-- Footer Section End-->
			<!-- Copy Right Section Start  -->
			<section class="tj-copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<p>&copy; Copyrights 2021 <a href="index.html">{{$web_name}}</a>. All Rights Reserved.</p>
						</div>
						<div class="col-md-6 col-sm-6">
							<ul class="payment-icons">
								<li><i class="fab fa-cc-visa"></i></li>
								<li><i class="fab fa-cc-mastercard"></i></li>
								<li><i class="fab fa-cc-paypal"></i></li>
								<li><i class="fab fa-cc-discover"></i></li>
								<li><i class="fab fa-cc-jcb"></i></li>
							</ul>
						</div>
					</div>
				</div>
			</section> 
			<!-- Copy Right Section End  -->
		</div>
	 	<!--JQuery-->
		
		<script src="{{asset('js/jquery-1.12.5.min.js')}}"></script>
		<script src="{{asset('js/migrate.js')}}"></script>  
		<script src="{{asset('js/bootstrap.min.js')}}"></script> 
		<script src="{{asset('js/owl.carousel.min.js')}}"></script>	
		<script src="{{asset('js/jquery.counterup.min.js')}}"></script>	
		<script src="{{asset('js/waypoints.min.js')}}"></script>
		<script src="{{asset('js/custom.js')}}"></script>
		<script src="{{asset('js/select2.min.js')}}"></script>
		<script src="{{asset('js/jquery.PrintArea.min.js')}}"></script>
		<script>
			document.addEventListener('contextmenu', event => event.preventDefault()); 
			//oneway and round trip toggling
			$("p.alert").delay(3000).slideUp(500);

			$(".sr_travel_type").change(function (e) { 
				if($(this).val()=="round"){
					//$(".sr_oneway_form").hide();
					$(".sr_show_class").toggleClass("col-md-4 col-sm-4")
					$(".sr_round_form").show();
					$("#sr_type").val("round");
				}else{
					$(".sr_round_form").hide();
					$(".sr_show_class").removeClass("col-md-4 col-sm-4")
					//$(".sr_oneway_form").show();
				}
			});
			//change text in airport
			$("#trip-select").change(function () { 
				if($(this).val()=="fa"){
					$("#p-address").text("Drop Address");
				}else{
					$("#p-address").text("Pick Up Address");
				}
			});
			//city selection dropdown
			$(".sr_pick_address").select2();
			
			//date picker previous date dissable
			var today = new Date();
    		var dd = String(today.getDate()).padStart(2, '0');
    		var mm = String(today.getMonth() + 1).padStart(2, '0');
    		var yyyy = today.getFullYear();
    		today = yyyy + '-' + mm + '-' + dd;
    		$('.sr_pick_date').attr('min',today);

			//passenger details validation
			$("#passenger_details").click(function (e) { 
				//alert("hy");
				e.preventDefault();
			//	console.log($("#sr_name").val());
				var name = $("#sr_name").val();
				var email = $("#sr_email").val();
				var phone = $("#sr_phone").val();
				var pickup = $("#sr_pickup").val();
				
				$.ajax({
					type: "post",
					url: "{{route('passenger_address')}}",
					data: {name: name, email:email, phone:phone, pickup:pickup, "_token": "{{ csrf_token() }}"},
					dataType: "json",
					success: function (response) {
						//console.log(response);
						if(response.status==400){
							//console.log(response.errors.first_name);
							//display this error messages to our registration form
							//empty the previous classes
							$(".error").html("");
							//checking status. If it is undefined then remove and not undefined then add class
							if(response.errors.name!=undefined){
								$(".error_1").addClass("alert alert-danger");
								$(".error_1").text(response.errors.name);
							}else{
								$(".error_1").removeClass("alert alert-danger");
							}
							if(response.errors.email!=undefined){
								$(".error_3").addClass("alert alert-danger");
								$(".error_3").text(response.errors.email);
							}else{
								$(".error_3").removeClass("alert alert-danger");
							}
							if(response.errors.phone!=undefined){
								$(".error_4").addClass("alert alert-danger");
								$(".error_4").text(response.errors.phone);
							}else{
								$(".error_4").removeClass("alert alert-danger");
							}
							if(response.errors.pickup!=undefined){
								$(".error_5").addClass("alert alert-danger");
								$(".error_5").text(response.errors.pickup);
							}else{
								$(".error_5").removeClass("alert alert-danger");
							}
						
						}else if(response.status==200){
							$("#sr_passenger_form").hide();
							$("#sr_pay_form").show();
							$("#sr_name_o").val(response.name);
							$("#sr_email_o").val(response.email);
							$("#sr_phone_o").val(response.phone);
							$("#sr_pickup_o").val(response.pickup);
						}
					}
				});
			});
			
			//paymernt proceed button disable or enable
			$("#amount_paid").keyup(function (e) { 
				var amount=parseInt($("#amount").val());
				if(($(this).val()<0)){
					$("#sr_submit_button").prop('disabled', true);
				}else if(($(this).val())>amount){
					$("#sr_submit_button").prop('disabled', true);
				}else{
					$("#sr_submit_button").prop('disabled', false);
				}
			});
			
			//form back button
			$(document).on("click", "#sr_show", function (){
				$("#sr_pay_form").hide();
				$("#sr_passenger_form").show();
			});
			
		</script> 
		<script>
		$("#print_button").click(function (e) { 
			e.preventDefault();
			var mode="iframe";
			var close=mode=="popup";
			var options={mode:mode, popclose:close};
			$("div.print_area").printArea(options);
		});
	</script>
	<script>
		$(document).on("change","#travel_changer", function () {
			if($(this).val()=="local_120"){
				$("#local_120_id").show();
				$("#local_80_id").hide();
			}else if($(this).val()=="local_80"){
				$("#local_120_id").hide();
				$("#local_80_id").show();
			}
			
		});
    </script>
    <script>
    	$(document).on("change", "#select_trip", function () {
    		if($(this).val()=="fa"){
    			$("#drop_air_city").show();
    			$("#pick_air_city").hide();
    		}else if($(this).val()=="ta"){
    			$("#drop_air_city").hide();
    			$("#pick_air_city").show();
    		}
    
    	});
    </script>
	<script>
		$(".btn-refresh").click(function (e) { 
			e.preventDefault();
			$.ajax({
				type: "GET",
				url: "{{route('refresh_captcha')}}",
				success: function (response) {
					$(".captcha span").html(response);
				}
			});
		});
	</script>
	</body>
</html>