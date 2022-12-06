@extends("layouts.layout")
@section("title", "edit_trip")
@section("content")
<div class="container">
    @foreach($trips as $trip)
    <form action="{{route('new_trips.update',[$trip->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")
        <legend class="col-form-label">Edit Trip</legend>
        <div class="row form-group">
            <label for="trip_id" class="col-md-2 col-form-label">Trip Id <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="trip_id" placeholder="Enter your trip id" class="form-control" value="Trip-{{$trip->trip_id}}" readonly>
                @if($errors->has("trip_id"))
                    <span class="alert alert-danger">{{$errors->first("trip_id")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="customer" class="col-md-2 col-form-label">Customer <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="customer" id="" class="form-control">
                   <option value="">Select Customer</option>
                   @foreach($customers as $customer)
                   <option value="{{$customer->id}}"<?php if($trip->customer_id==$customer->id) echo "selected";?>>{{$customer->customer_first_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("customer"))
                    <span class="alert alert-danger">{{$errors->first("customer")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="driver" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="driver" id="driver_id" class="form-control">
                   <option value="">Select Driver</option>
                   @foreach($drivers as $driver)
                   <option value="{{$driver->id}}"<?php if($trip->driver_id==$driver->id) echo "selected";?>>{{$driver->first_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("driver"))
                    <span class="alert alert-danger">{{$errors->first("driver")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="trip_id" class="col-md-2 col-form-label">Phone Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter your phone_number" class="form-control" value="{{$trip->phone_number}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date" class="col-md-2 col-form-label">PickUp Date <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="date" name="pickup_date" placeholder="Enter your pickup date" class="form-control" value="{{$trip->pickup_date}}">
                @if($errors->has("pickup_date"))
                    <span class="alert alert-danger">{{$errors->first("pickup_date")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="time" class="col-md-2 col-form-label">PickUp Time <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="time" name="pickup_time" placeholder="Enter your pickup time" class="form-control" value="{{$trip->pickup_time}}">
                @if($errors->has("pickup_time"))
                    <span class="alert alert-danger">{{$errors->first("pickup_time")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="pickup_address" class="col-md-2 col-form-label">Pickup Adress <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="pickup_address" placeholder="Enter your pickup address" class="form-control" >{{$trip->pickup_address}}</textarea>
                @if($errors->has("pickup_address"))
                    <span class="alert alert-danger">{{$errors->first("pickup_address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="drop_address" class="col-md-2 col-form-label">Drop Adress <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="drop_address" placeholder="Enter your drop address" class="form-control" >{{$trip->drop_address}}</textarea>
                @if($errors->has("drop_address"))
                    <span class="alert alert-danger">{{$errors->first("drop_address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lan" class="col-md-2 col-form-label">pick up lattittude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lattitude" placeholder="Enter your pickup lattittude" class="form-control" value="{{$trip->pickup_lat}}">
                @if($errors->has("lattitude"))
                    <span class="alert alert-danger">{{$errors->first("lattitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lon" class="col-md-2 col-form-label">pick up longitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="longitude" placeholder="Enter your pickup longitude" class="form-control" value="{{$trip->pickup_lon}}">
                @if($errors->has("longitude"))
                    <span class="alert alert-danger">{{$errors->first("longitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle" class="col-md-2 col-form-label">Vehicle_number <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="vehicle number" name="vehicle_number" class="form-control" id="vehicle_number" value="{{$trip->vehicle_number}}">
               @if($errors->has("vehicle_number"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="payment" class="col-md-2 col-form-label">Payment Method <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="payment_method" id="" class="form-control">
                <option value="">Select payment method</option>
                <option value="cash"<?php if($trip->payment_method=="cash") echo "selected";?>>Cash</option>
               </select>                
               @if($errors->has("payment_method"))
                    <span class="alert alert-danger">{{$errors->first("payment_method")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="total" class="col-md-2 col-form-label">Subtotal <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Subtotal" name="subtotal" class="form-control" value="{{$trip->subtotal}}">
               @if($errors->has("subtotal"))
                    <span class="alert alert-danger">{{$errors->first("subtotal")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="discound" class="col-md-2 col-form-label">Discount <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="discount" name="discount" class="form-control" value="{{$trip->discount}}">
               @if($errors->has("discount"))
                    <span class="alert alert-danger">{{$errors->first("discount")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fare" class="col-md-2 col-form-label">Fare <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Fare" name="fare" class="form-control" value="{{$trip->fare}}">
               @if($errors->has("fare"))
                    <span class="alert alert-danger">{{$errors->first("fare")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    @foreach($statuses as $status)
                    <option value="{{$status->status}}"<?php if($trip->status==$status->status) echo "selected";?>>{{$status->status}}</option>
                    @endforeach
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>

@endsection
@section("script")
<div id="map"></div>
    
    <script>
        function initMap() {
            const myLatlng = { lat: 8.526312424821525, lng: 76.9490145150109};
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: myLatlng,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Click the map to get Lat/Lng!",
                position: myLatlng,
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                    // Close the current InfoWindow.
                    infoWindow.close();
                    // Create a new InfoWindow.
                    infoWindow = new google.maps.InfoWindow({
                        position: mapsMouseEvent.latLng,
                    });
                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                infoWindow.open(map);
                $("#lat").val(mapsMouseEvent.latLng.lat());
                $("#lon").val(mapsMouseEvent.latLng.lng());
            });
        }
    </script>
   <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUxK3RbivFIANz6kMCUII80AWW53q8sQQ&callback=initMap&v=weekly"
      async
    ></script>
@endsection