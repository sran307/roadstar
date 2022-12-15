<?php
    $data =App\Models\GeneralSetting::all();
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
	$image=App\Models\User::where("role",1)->value("image");
?>
<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CoreUI CSS -->
    <!--<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">-->
    <link rel="stylesheet" href="{{asset('css/coreui.min.css')}}" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.3/css/perfect-scrollbar.css" integrity="sha512-2xznCEl5y5T5huJ2hCmwhvVtIGVF1j/aNUEJwi/BzpWPKEzsZPGpwnP1JrIMmjPpQaVicWOYVu8QvAIg9hwv9w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <!--official bootstrap css-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" crossorigin="anonymous">
    <link href="{{asset('css/fontawesome-all.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/css-admin/style.css')}}" rel="stylesheet">
    <!--JQuery-->

    <script src="{{asset('js/jquery-3.5.1.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/perfect-scrollbar.min.js')}}" ></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/coreui.min.js')}}"></script>

    
   
    <script src="{{asset('js/bootstrap.min.js')}}"  crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script src="{{asset('js/table2csv.js')}}"></script>
    <script src="{{asset('js/chart.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

    <title>@yield('title')</title>
    <style>
       
        .star{
            color:red;
        }
        .w-5{
            display:none;
        }
        #map {
            height: 70%;
        }
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    </head>
    <body class="c-app">
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <img src="{{asset('images/logos/'.$logo)}}" class="sr_app_logo" alt="logo">
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#signet"></use>
            </svg>
        </div>

        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
            <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Dashboard</a>
            </li>
            
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                </svg> CMS</a>
                <ul class="nav-group-items">
                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                    </svg> Home Page Widgets</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{route('slider_models.index')}}"><span class="nav-icon"></span>Slider Widget</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('widget1_models.index')}}"><span class="nav-icon"></span>Feature Widget</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('about_widgets.index')}}"><span class="nav-icon"></span>About Widget</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('heading_models.index')}}"><span class="nav-icon"></span>Titles</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('widget2_models.index')}}"><span class="nav-icon"></span>Booking Widget </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('widget3_models.index')}}"><span class="nav-icon"></span>Safety Widget</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('fleet_models.index')}}"><span class="nav-icon"></span>Fleets Widget</a></li>
                      <!--  <li class="nav-item"><a class="nav-link" href="{{route('footer_logos.index')}}"><span class="nav-icon"></span>Footer Logo</a></li>
                         <li class="nav-item"><a class="nav-link" href="{{route('social_icons.index')}}"><span class="nav-icon"></span>Social Media Icons</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('footer_titles.index')}}"><span class="nav-icon"></span>Footer Titles</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{route('footer_links.index')}}"><span class="nav-icon"></span>Footer Links</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('footer_services.index')}}"><span class="nav-icon"></span>Footer Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('footer_contacts.index')}}"><span class="nav-icon"></span>Footer Contacts</a></li> 
                        <li class="nav-item"><a class="nav-link" href="{{route('footer_payments.index')}}"><span class="nav-icon"></span>Footer Payment Icons</a></li> -->                   
                    </ul>
                </li>
                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                    </svg> About Page Widgets</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{route('about_pages.index')}}"><span class="nav-icon"></span>About Page</a></li>
                        <!--  <li class="nav-item"><a class="nav-link" href="{{route('background_images.index')}}"><span class="nav-icon"></span>Background Image</a></li>-->
                        <li class="nav-item"><a class="nav-link" href="{{route('about_page_widgets.index')}}"><span class="nav-icon"></span>About Page Widget</a></li>
                         <li class="nav-item"><a class="nav-link" href="{{route('testimonial_models.index')}}"><span class="nav-icon"></span>Testimonials</a></li>
                    </ul>
                </li>
                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                    </svg> Services</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{route('service_models.index')}}"><span class="nav-icon"></span>Services Widget</a></li>
                    </ul>
                </li>
                <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                    </svg> Blogs</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="{{route('blog_models.index')}}"><span class="nav-icon"></span>Blog Management</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('comment_models.index')}}"><span class="nav-icon"></span>Comment Management</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                </svg> Settings</a>
                <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{route('general_settings.index')}}"><span class="nav-icon"></span>General Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('app_details')}}"><span class="nav-icon"></span> App Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('feature_setting')}}"><span class="nav-icon"></span> Feature Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact_setting')}}"><span class="nav-icon"></span> Contact Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('trip_page')}}"><span class="nav-icon"></span> Trip Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('cancel_page')}}"><span class="nav-icon"></span> Cancellation Settings</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-people"></use>
                </svg> Customers</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('customers.index')}}"><span class="nav-icon"></span>Customers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('sos_models.index')}}"><span class="nav-icon"></span> Customers SOS Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('wallet')}}"><span class="nav-icon"></span> Customer Wallet Histories</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-people"></use>
                </svg> Drivers</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('drivers.index')}}"><span class="nav-icon"></span> Manage Drivers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('driver_queries')}}"><span class="nav-icon"></span> Driver Queries</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('driver_recharges.index')}}"><span class="nav-icon"></span> Driver Recharges</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('vehicles')}}"><span class="nav-icon"></span> Driver Vehicles</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('driver_wallet')}}"><span class="nav-icon"></span> Driver Wallet Histories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('driver_earnings')}}"><span class="nav-icon"></span> Driver Earnings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('withdrawals')}}"><span class="nav-icon"></span> Driver Withdrawals</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('bank_details')}}"><span class="nav-icon"></span> Driver Bank Details</a></li>
               </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-people"></use>
                </svg> Manage Fleet</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('fleet_categories.index')}}"><span class="nav-icon"></span> Manage Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manage_brands.index')}}"><span class="nav-icon"></span> Manage Brands</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manage_models.index')}}"><span class="nav-icon"></span> Manage Models</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('manage_fleets.index')}}"><span class="nav-icon"></span> Manage Fleets</a></li>
               </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bus-alt"></use>
                </svg> Trips</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('new_trips.index')}}"><span class="nav-icon"></span>Trips</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('trip_types.index')}}"><span class="nav-icon"></span> Trip Types</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('trip_requests.index')}}"><span class="nav-icon"></span> Trip Requests</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('driver_trip_request')}}"><span class="nav-icon"></span> Driver Trip Requests</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('status_models.index')}}"><span class="nav-icon"></span> Trip Request Status</a></li>            
                </ul>
             </li>
             <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
                </svg> Fare Managements</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('fare_models.index')}}"><span class="nav-icon"></span>Additional Fare Kilometers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('daily_fares.index')}}"><span class="nav-icon"></span> Daily Fare</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('outstation_models.index')}}"><span class="nav-icon"></span> Out Station Fare Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('package_models.index')}}"><span class="nav-icon"></span> Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('rental_models.index')}}"><span class="nav-icon"></span> Rental Fare Management</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
                </svg> Reports</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('trip_report')}}"><span class="nav-icon"></span>Trip Report</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('transaction_report')}}"><span class="nav-icon"></span> Transaction Report</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('driver_report')}}"><span class="nav-icon"></span> Driver Report</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('live_tracking')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Live Tracking</a>
            </li>
             <li class="nav-item"><a class="nav-link" href="{{route('city_trips.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg>City Management</a>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
                </svg> Complaints</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('complaint_categories.index')}}"><span class="nav-icon"></span>Complaint Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('complaint_subs.index')}}"><span class="nav-icon"></span> Complaint Sub Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('complaints_models.index')}}"><span class="nav-icon"></span> Complaints</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
                </svg> Payments</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('payment_models.index')}}"><span class="nav-icon"></span>Payment Methods</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('payment_types.index')}}"><span class="nav-icon"></span> Payment Types</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('payment_histories.index')}}"><span class="nav-icon"></span> Payment Histories</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('status_models.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Booking Status</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('tax_models.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Tax Lists</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('notification_models.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Notification Messages</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('message_models.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Message</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('email_details.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> All Mails</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('cancellations.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Cancellation Reason</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('user_types.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> User Types</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('countries.index')}}">
                <svg class="nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Country</a>
            </li>
        </ul>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                    <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                    </svg></a>
               <ul class="header-nav ms-3">
                    <li class="nav-item dropdown"><a class="nav-link py-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md"><img class="avatar-img" src="{{asset('images/profile_image/'.$image)}}" alt="user@email.com"></div></a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <!--<div class="dropdown-header bg-light py-2">-->
                            <!--        <div class="fw-semibold">Account</div>-->
                            <!--</div>-->
                            <a class="dropdown-item" href="{{route('profile')}}">
                               Profile
                            </a>
                            <a class="dropdown-item" href="{{route('logout')}}">
                               Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        @if(session()->has("message"))
            <p class="alert {{session()->get('alert-class')}} text-center">{{session()->get("message")}}</p>
        @endif
        
        <div class="body flex-grow-1 px-3" id="body"> 
                <div class="nippcontz">
               
                    @yield("content")
                </div> 
        </div>
        <footer class="footer">
          <!--  <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> &copy; 2021 creativeLabs.</div>
            <div class="ms-auto">Powered by&nbsp;<a href="">CoreUI UI Components</a></div>-->
        </footer>
    </div>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then CoreUI JS -->
   
   @yield("script")
	
   
    <script>
        $(document).ready(function() {
           $("p.alert").delay(3000).slideUp(300);
            $('#summernote').summernote({
                placeholder: 'Details',
                tabsize: 2,
                height: 200
            });

            //Reference the DropDownList.
            var ddlYears = document.getElementById("ddlYears");
    
            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();
    
            //Loop and add the Year values to DropDownList.
            for (var i = 1950; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        
        });

    </script>
    </body>
</html>