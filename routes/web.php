<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    RegistrationController, 
    TripController,
    FrontendController,
    DriverQueryController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
//frontend
Route::get("/", "FrontendController@home")->name("home");
Route::get("about", "FrontendController@about")->name("about");
Route::get("blog", "FrontendController@blog")->name("blog");
Route::get("service", "FrontendController@service")->name("service");
Route::get("all_blogs/{id}", "FrontendController@all_blogs")->name("all_blogs");
Route::get("contact", "FrontendController@contact")->name("contact");
Route::get("fleet", "FrontendController@fleet")->name("fleet");
Route::get("refresh_captcha", "FrontendController@refresh_captcha")->name("refresh_captcha");
//email
Route::post("send_email", "FrontendController@send_email")->name("send_email");
Route::get("/push", "ApiController@push")->name("push");
Route::post("fetch_car_model", "FrontendController@fetch_car_model")->name("fetch_car_model");
//fetching city 
Route::post("fetch_city", "FrontendController@fetch_city")->name("fetch_city");
//view cabs
Route::post("view_cabs", "FrontendController@view_cabs")->name("view_cabs");
//contact form for passenger
Route::post("passenger_contact", "FrontendController@contact_form")->name("passenger_contact");
//order confirmation
Route::post("pickup_confirm", "FrontendController@pickup_confirm")->name("pickup_confirm");
//address details of passenger
Route::post("passenger_address", "FrontendController@passenger_address")->name("passenger_address");
//payment
Route::post("payment_details", "FrontendController@payment_details")->name("payment_details");
Route::get("getDistance", "FrontendController@getDistance")->name("getDistance");

//invoice
Route::post("invoice", "FrontendController@invoice")->name("invoice");

//Route::view("/", "layouts.layout")->name("home");
Route::get("admin/login", "RegistrationController@login")->name("login");
Route::get("admin", "RegistrationController@login")->name("login");
Route::post("login_form", "RegistrationController@login_form")->name("login_form");


//middleware for checking login
Route::group(["middleware"=>["web", "login"]],function(){
    Route::get("logout", "RegistrationController@logout")->name("logout");
    //middleware for admin operation
    Route::group([
        'middleware'=>'is_admin',
        'prefix'=>'admin',
    ], function(){
        Route::get("profile", "RegistrationController@profile")->name("profile");
        Route::view("dashboard", "layouts.dashboard")->name("dashboard");
        Route::get("app_details", "RegistrationController@app_details")->name("app_details");
        Route::get("edit_app/{id}", "RegistrationController@edit_app")->name("edit_app");
        Route::post("update_profile/{id}", "RegistrationController@update_profile")->name("update_profile");
        Route::post("app_update/{id}", "RegistrationController@app_update")->name("app_update");
        //feature settings
        Route::get("feature_setting", "FeatureController@feature_setting")->name("feature_setting");
        Route::resource("feature_settings", FeatureController::class);
        //contact settings
        Route::get("contact_setting", "ContactController@contact_setting")->name("contact_setting");
        Route::resource("contact_models", ContactController::class);
        //trip settings
        Route::get("trip_setting", "TripController@trip_page")->name("trip_page");
        Route::get("trip_edit/{id}", "TripController@trip_edit")->name("trip_edit");
        Route::post("trip_update/{id}", "TripController@trip_update")->name("trip_update");
        //cancellation settings
        Route::get("cancel_page", "TripController@cancel_page")->name("cancel_page");
        Route::get("cancel_edit/{id}", "TripController@cancel_edit")->name("cancel_edit");
        Route::post("cancel_update/{id}", "TripController@cancel_update")->name("cancel_update");
        //customer operations
        Route::get("wallet", "CustomerController@wallet")->name("wallet");
        Route::get("export_csv", "CustomerController@export_csv")->name("export_csv");
        Route::get("export_xlsx", "CustomerController@export_xlsx")->name("export_xlsx");
        Route::get("export_pdf", "CustomerController@export_pdf")->name("export_pdf");
        Route::get("sos_edit/{id}", "CustomerController@sos_edit")->name("sos_edit");
        Route::get("customer_edit/{id}", "CustomerController@edit")->name("customer_edit");
        Route::get("customer_delete/{id}", "CustomerController@customer_delete")->name("customer_delete");
        Route::post("search", "CustomerController@search")->name("search");
        Route::resource("customers", CustomerController::class);
        Route::resource("sos_models", SosController::class);
        //driver
        Route::post("driver_search", "DriverController@driver_search")->name("driver_search");
        Route::get("driver_delete/{id}", "DriverController@driver_delete")->name("driver_delete");
        Route::get("driver_edit/{id}", "DriverController@driver_edit")->name("driver_edit");
        Route::get("driver_wallet", "DriverController@wallet")->name("driver_wallet");
        Route::get("driver_earnings", "DriverController@earnings")->name("driver_earnings");
        Route::get("vehicles", "DriverController@vehicles")->name("vehicles");
        Route::get("add_vehicles", "DriverController@add_vehicles")->name("add_vehicles");
        Route::post("add_vehicles_form", "DriverController@add_vehicles_form")->name("add_vehicles_form");
        Route::get("edit_vehicles/{id}", "DriverController@edit_vehicles")->name("edit_vehicles");
        Route::post("update_vehicles/{id}", "DriverController@update_vehicles")->name("update_vehicles");
        Route::get("withdrawals", "DriverController@withdrawals")->name("withdrawals");
        Route::get("bank_details", "DriverController@bank_details")->name("bank_details");
        Route::resource("drivers", DriverController::class);
        //vehicle categories
        Route::resource("vehicle_managements", VehicleController::class);
        //trip types
        Route::post("get_vehicle", "NewTripController@get_vehicle")->name("get_vehicle");
         //trip data fetching
        Route::post("fetch_trip","NewTripController@fetch_data")->name("fetch_trip");
        Route::post("trip_phone_search", "NewTripController@trip_phone_search")->name("trip_phone_search");
        Route::post("trip_date_search", "NewTripController@trip_date_search")->name("trip_date_search");
        Route::get("new_trip_edit/{id}", "NewTripController@edit")->name("new_trip_edit");

        Route::post("trip_type_date_search", "TripManagement@trip_type_date_search")->name("trip_type_date_search");
        Route::get("trip_type_edit/{id}", "TripManagement@edit")->name("trip_type_edit");
        Route::get("trip_type_delete/{id}", "TripManagement@destroy")->name("trip_type_delete");
        Route::resource("trip_types", TripManagement::class);

        Route::post("assign_driver", "NewTripController@assign_driver")->name("assign_driver");
        Route::post("choose_driver", "NewTripController@choose_driver")->name("choose_driver");
        Route::resource("new_trips", NewTripController::class);
        //trip Request
        Route::get("driver_trip_request","RequestController@driver_trip")->name("driver_trip_request");
        Route::resource("status_models", RequestController::class);

        Route::post("trip_confirmed", "TripRequestController@trip_confirmed")->name("trip_confirmed");
        Route::post("trip_request_search", "TripRequestController@trip_request_search")->name("trip_request_search");
        Route::post("trip_request_date", "TripRequestController@trip_request_date")->name("trip_request_date");
        Route::get("trip_request_edit/{id}", "TripRequestController@edit")->name("trip_request_edit");
        Route::get("trip_request_delete/{id}", "TripRequestController@destroy")->name("trip_request_delete");
        Route::resource("trip_requests", TripRequestController::class);
        //fare management
        Route::resource("fare_models", FareManagement::class);
        //daily fare
        Route::resource("daily_fares", DailyFareController::class);
        //outstation fare
        Route::resource("outstation_models", OutstationController::class);
        //packages
        Route::resource("package_models", PackageController::class);
        //Rental fare
        Route::resource("rental_models", RentalController::class);
        //complaint category
        Route::resource("complaint_categories", ComplaintController::class);
        //complaint sub category
        Route::resource("complaint_subs", SubCategoryController::class);
        //complaints
        Route::post("complaint_search", "Complaints@complaint_search")->name("complaint_search");
        Route::post("complaint_search_date", "Complaints@complaint_search_date")->name("complaint_search_date");
        Route::get("complaints_edit/{id}", "Complaints@complaints_edit")->name("complaints_edit");
        Route::resource("complaints_models", Complaints::class);
        //payment
        Route::resource("payment_models", PaymentController::class);
        //payment types
        Route::resource("payment_types", PaymentTypeController::class);
        //payment history
        Route::resource("payment_histories", PaymentHistoryController::class);
        //Booking status 
        Route::resource("status_models", StatusController::class);
        //Tax list
        Route::resource("tax_models", TaxController::class);
        //country
        Route::resource("countries", CountryController::class);
        //user type
        Route::resource("user_types", UserTypeController::class);
        //Cancellation
        Route::resource("cancellations", CancelController::class);
        //message
        Route::resource("message_models", MessageController::class);
        //notification message
        Route::resource("notification_models", NotificationController::class);
        //map
        Route::view("live_tracking","map")->name("live_tracking");
        //cities
        Route::post("city_distance", "CityController@city_distance")->name("city_distance");
        Route::resource("city_trips", CityController::class);
        //front end operations
        //General settings
        Route::resource("general_settings", GeneralSettingController::class);
        //header contact
        Route::resource("header_contacts", HeaderContactController::class);
        //slider settings
        Route::resource("slider_models", SliderController::class);
        //widget1
        Route::resource("widget1_models", Widget1Controller::class);
        //titles
        Route::resource("heading_models", HeadingController::class);
        //widget 2
        Route::resource("widget2_models", Widget2Controller::class);
        //About Widget
        Route::resource("about_widgets", AboutWidgetController::class);
        //widget 3
        Route::resource("widget3_models", Widget3Controller::class);
        //services page
        Route::resource("service_models", ServiceController::class);
        //Fleet management
        Route::resource("fleet_models", FleetController::class);
        //footer logo
        Route::resource("footer_logos", FooterLogoController::class);
        //social media icons
        Route::resource("social_icons", SocialController::class);
        //footer titles
        Route::resource("footer_titles", FooterTitleController::class);
        //external links
        Route::resource("footer_links", FooterLinkController::class);
        //footer services
        Route::resource("footer_services", FooterServiceController::class);
        //footer contact
        Route::resource("footer_contacts", FooterContactController::class);
        //Footer Payment Icon
        Route::resource("footer_payments", FooterPaymentController::class);
        //About page
        //Main heading
        Route::resource("about_pages", AboutPageController::class);
        //Background Image
        Route::resource("background_images", BackgroundImageController::class);
        //About page widget
        Route::resource("about_page_widgets", AboutPageWidgetController::class);
        //testimonials
        Route::resource("testimonial_models", TestimonialController::class);
        //blog management
        Route::resource("blog_models", BlogController::class);
        //comment management
        Route::resource("comment_models", CommentController::class);
        //fleet category
        Route::resource("fleet_categories", FleetCategoryController::class);
        //manage brands
        Route::resource("manage_brands", ManageBrandController::class);
        //manage models
        Route::resource("manage_models", ManageModelController::class);
        //manage fleets
        Route::post("fetch_model", "ManageFleetController@fetch_model")->name("fetch_model");
        Route::post("fleet_search", "ManageFleetController@fleet_search")->name("fleet_search");
        Route::get("fleet_edit/{id}", "ManageFleetController@edit")->name("fleet_edit");
        Route::get("fleet_delete/{id}", "ManageFleetController@fleet_delete")->name("fleet_delete");
        Route::resource("manage_fleets", ManageFleetController::class);
        //manage fleets
        Route::resource("email_details", EmailController::class);
        //Driver queries
        Route::get("driver_queries", "DriverQueryController@driver_queries")->name("driver_queries");
        //driver recharge queries
        Route::resource("driver_recharges", DriverRechargeController::class);

        //reports
        Route::get("trip_report", "ReportController@trip_report")->name("trip_report");
        Route::post("trip_detail", "ReportController@trip_detail")->name("trip_detail");

        Route::get("transaction_report", "ReportController@transaction_report")->name("transaction_report");
        Route::post("transaction_detail", "ReportController@transaction_detail")->name("transaction_detail");

        Route::get("driver_report", "ReportController@driver_report")->name("driver_report");
        Route::post("driver_detail", "ReportController@driver_detail")->name("driver_detail");
        Route::post("driver_select", "ReportController@driver_select")->name("driver_select");
       
    });

    
});