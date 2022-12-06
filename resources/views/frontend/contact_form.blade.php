@extends("frontend.layout")
@section("title", "Contact")
@section("content")

<div class="passcontact">
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <div class="conpikdefrm">
            <div>
                <h5 class="sr_heading">Contact & Pick Up Details</h5>
            </div>
            <form action="{{route('pickup_confirm')}}" id="sr_passenger_form_de" method="post" >
                @csrf
                <div class="row form-group">
                    <div class="col-md-12"> 
                        <input type="text" name="name" placeholder="Name *" class="form-control" required> 
                        <p class="error error_1"></p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12"> 
                        <input type="email" name="email" placeholder="Email Address *" class="form-control" required> 
                        <p class="error error_3"></p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12"> 
                       <input type="text" name="phone" placeholder="Phone Number *" class="form-control"  required>
                       <p class="error error_4"></p> 
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12"> 
                        <select name="pickup" id="sr_pickup" class="form-control sr_pick_address"  required>
							<option value="">Select Pick Up City</option>
							@foreach($cities as $city)
							<option value="{{$city->id}}"
                            <?php
                                if($type=="airport_from"){
                                    if($city->city==$airport_address){echo("selected");}
                                }else if($type=="airport_to"){
                                    if($city->city==$pick_address){echo("selected");}
                                }else{
                                    if($city->city==$pick_address){echo("selected");}
                                }
                                
                             ?>
                             >{{$city->city}}</option>
							@endforeach
						</select>
                        <p class="error error_5"></p>
                    </div>
                </div>
                <input type="hidden" name="pick_address" id="pick_address" value="{{$pick_address}}">
                <input type="hidden" name="drop_address" id="drop_address" value="{{$drop_address}}">
                <input type="hidden" name="airport_address" value="{{$airport_address}}">
                <input type="hidden" name="amount" id="amount" value="{{$net_amount}}">
                <input type="hidden" name="car_model" id="car_model" value="{{$car_brand}}">
                <input type="hidden" name="car_brand" id="car_brand" value="{{$car_model}}">
                <input type="hidden" name="trip" value="{{$trip}}">
                <input type="hidden" name="distance" value="{{$distance}}">
                <input type="hidden" value={{$type}} name="type">
                <input type="hidden" name="date" value="{{$pick_date}}">
                <input type="hidden" name="time" value="{{$pick_time}}">
                <input type="hidden" name="return_date" value="{{$return_date}}">
                <input type="hidden" name="vehicle_id" value="{{$vehicle_id}}">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" type="submit" >PROCEED</button>
                    </div>
                </div>
            </form>
            <hr>
            
              
           
        </div>
        </div>
        
        
        <div class="col-md-6">
        <div class="youbookdetz">
            <h5>Your Booking Details</h5>
            <div class="row form-group">
                <label for="capacity" class="col-md-4 col-form-label">Itinerary:</label>
                <div class="col-md-8" <?php if($type!="airport_from"){echo 'style="display:none"';}?>> 
                    <p>{{$airport_address}} > {{$drop_address}}</p>
                </div>
                <div class="col-md-8" <?php if($type!="airport_to"){echo 'style="display:none"';}?>> 
                    <p>{{$pick_address}} > {{$airport_address}}</p>
                </div>
                <div class="col-md-8"<?php if($type=="airport_from" || $type=="airport_to"){echo 'style="display:none"';}?>> 
                    <p>{{$pick_address}} > {{$drop_address}}</p>
                </div>
            </div>
            <div class="row form-group">
                <label for="capacity" class="col-md-4 col-form-label">Pick Up Date:</label>
                <div class="col-md-8"> 
                    <p>
                        <?php 
                            $time=strtotime($pick_date);
                            $month=date("F",$time);
                            $year=date("Y",$time);
                            $date=date("d", $time);
                            echo($month.' '.$date.', '.$year) ;
                        ?>
                        at
                        {{date("g:i A", strtotime($pick_time));}}
                    </p>
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-4 col-form-label">Car Type:</label>
                <div class="col-md-8"> 
                    <p>{{$car_brand}} , {{$car_model}}</p>
                   
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-4 col-form-label">Total Fare:</label>
                <div class="col-md-8"> 
                    <p>INR {{$amount}}</p>
                   
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-4 col-form-label">Toll & Nighthalt:</label>
                <div class="col-md-8"> 
                    <p>INR {{$toll}}</p>
                   
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-4 col-form-label">Driver Allowance:</label>
                <div class="col-md-8"> 
                    <p>INR {{$driver_allowance}}</p>
                   
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-4 col-form-label">Net Amount:</label>
                <div class="col-md-8"> 
                    <p>INR {{$net_amount}}</p>
                   
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
