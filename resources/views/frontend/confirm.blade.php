@extends("frontend.layout")
@section("title", "Contact")
@section("content")
<div class="container">
    <h5>{{$name}}, your booking from {{$pickup}} is confirmed.</h5>

    <p>
        You will receive the reservation details 
        with booking ID S0122-4991508 on your email address and mobile soon.
    </p>
    <p>
        You will receive your driver details without fail, 1.5 hours 
        prior to your pick up time. We seek your cooperation to avoid
        enquiring about the driver details before the specified time.
    </p>
    <div>
        <p>Note: Owing to state-wise lockdowns and restrictions in vehicular movement, 
            we are bound by the dynamic nature of the latest rules. While we don't anticipate any 
            restriction for your trip, we urge you to refer 
            the respective official government notification and comply with the rules for road travel.
        </p>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 text-center">
            <h5>Your Booking Details</h5>
        </div>
        <div class="col-md-3 col-sm-3">
            <h6>Itenarary</h6>
            <p>{{$pickup}} > {{$drop}}</p>
        </div>
        <div class="col-md-3 col-sm-3">
            <h6>Pick Up date</h6>
            <p>{{$date}}</p>
        </div>
        <div class="col-md-3 col-sm-3">
            <h6>Car Type</h6>
            <p>{{$brand}}, {{$model}}</p>
        </div>
        <div class="col-md-3 col-sm-3">
            <h6>Total Fare</h6>
            <p>{{$amount}}</p>
        </div>
    </div>
</div>

@endsection
