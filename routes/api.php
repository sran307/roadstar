<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//mobile verifiction
Route::post("check_phone", [ApiController::class, "check_phone"])->name("check_phone");

//values inserting
Route::post("user_details", [ApiController::class, "user_details"])->name("user_details");

//user login
Route::post("user_login", [ApiController::class, "user_login"])->name("user_login");

//user profile
Route::post("user_profile", [ApiController::class, "user_profile"])->name("user_profile");

//Edit user profile
Route::post("user_edit_profile", [ApiController::class, "user_edit_profile"])->name("user_edit_profile");

//about page api
Route::get("about_details", [ApiController::class, "about_details"])->name("about_details");

//admin contact details
Route::get("admin_contact", [ApiController::class, "admin_contact"])->name("admin_contact");

//updating profile image
Route::post("update_profile_image", [ApiController::class, "update_profile_image"])->name("update_profile_image");

//get cities
Route::get("get_city", [ApiController::class, "get_city"])->name("get_city");

//oneway form
Route::post("form_data", [ApiController::class, "form_data"])->name("form_data");

//local trip
Route::post("local_data", [ApiController::class, "local_data"])->name("local_data");

//travel type
Route::get("local_type", [ApiController::class, "local_type"])->name("local_type");

//airport trip
Route::post("airport_data", [ApiController::class, "airport_data"])->name("airport_data");

//view cabs
Route::post("view_cabs", [ApiController::class, "view_cabs"])->name("view_cabs");

//cab details
Route::post("cab_details", [ApiController::class, "cab_details"])->name("cab_details");

//trip booking details
Route::post("booking_details", [ApiController::class, "booking_details"])->name("booking_details");

//pickup details
Route::post("pickup_details", [ApiController::class, "pickup_details"])->name("pickup_details");

//booking placed
Route::post("place_booking", [ApiController::class, "place_booking"])->name("place_booking");

//trip listing
Route::post("trip_list", [ApiController::class, "trip_list"])->name("trip_list");

//trip details
Route::post("trip_details", [ApiController::class, "trip_details"])->name("trip_details");

//invoice
Route::post("app_invoice", [ApiController::class, "app_invoice"])->name("app_invoice");

//reviews
Route::post("reviews", [ApiController::class, "reviews"])->name("reviews");

//cancel booking
Route::post("cancel_booking", [ApiController::class, "cancel_booking"])->name("cancel_booking");

//complaints
Route::post("complaints", [ApiController::class, "complaints"])->name("complaints");

//complaint list
Route::post("complaint_list", [ApiController::class, "complaint_list"])->name("complaint_list");

//driver mobile number
Route::post("driver_mobile",[ApiController::class, "driver_mobile"])->name("driver_mobile");

//driver signup
Route::post("driver_signup", [ApiController::class, "driver_signup"])->name("driver_signup");

//driver login
Route::post("driver_login", [ApiController::class, "driver_login"])->name("driver_login");

//driver 
Route::post("driver_profile", [ApiController::class, "driver_profile"])->name("driver_profile");

//driver profile update
Route::post("driver_profile_update", [ApiController::class, "driver_profile_update"])->name("driver_profile_update");

//user Transactions
Route::post("transaction", [ApiController::class, "transaction"])->name("transaction");

//driver status change
Route::post("status", [ApiController::class, "status"])->name("status");

//driver trip listing
Route::post("driver_list", [ApiController::class, "driver_list"])->name("driver_list");

//driver trip status
Route::post("driver_status", [ApiController::class, "driver_status"])->name("driver_status");

//driver reviews
Route::post("driver_reviews", [ApiController::class, "driver_reviews"])->name("driver_reviews");

//payment collection
Route::post("payment", [ApiController::class, "payment"])->name("payment");

//driver transaction
Route::post("driver_transaction", [ApiController::class, "driver_transaction"])->name("driver_transaction");

//driver transaction details
Route::post("transaction_details", [ApiController::class, "transaction_details"])->name("transaction_details");