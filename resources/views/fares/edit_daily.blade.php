@extends("layouts.layout")
@section("title", "daily_fare")
@section("content")
<div class="container">
    @foreach($fares as $fare)
    <form action="{{route('daily_fares.update', [$fare->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Daily Fare</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}" <?php if($country->id==$fare->country){echo "selected";} ?> >{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_type" class="col-md-2 col-form-label">Vehicle Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="vehicle_type" id="" class="form-control">
                   <option value="">Select Vehicle type</option>
                   @foreach($vehicles as $vehicle)
                    <option value="{{$vehicle->id}}" <?php if($vehicle->id==$fare->vehicle_type){echo "selected";} ?> >{{$vehicle->model_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="trip_type" class="col-md-2 col-form-label">Road Trip Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="trip_type" id="" class="form-control">
                    <option value="">Select Road Trip Type</option>
                    <option value="single"<?php if($fare->road_trip=="8hr"){echo "selected";} ?> >80 Km / 8 Hr</option>
                    <option value="onway" <?php if($fare->road_trip=="12hr"){echo "selected";} ?>>120 Km / 12 Hr</option>

               </select>                
               @if($errors->has("trip_type"))
                    <span class="alert alert-danger">{{$errors->first("trip_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="basefare" class="col-md-2 col-form-label">Base Fare <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="base_fare" placeholder="Enter your base fare" class="form-control" value="{{$fare->base_fare}}">
                @if($errors->has("base_fare"))
                    <span class="alert alert-danger">{{$errors->first("base_fare")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="cover_km" class="col-md-2 col-form-label">Extra KM Price <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="base_fare_km" placeholder="Enter extra km price" class="form-control" value="{{$fare->base_fare_km}}">
                @if($errors->has("base_fare_km"))
                    <span class="alert alert-danger">{{$errors->first("base_fare_km")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fpkm" class="col-md-2 col-form-label">Extra Hour Price <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_km" placeholder="Enter extra hour price" class="form-control" value="{{$fare->price_per_km}}">
                @if($errors->has("price_per_km"))
                    <span class="alert alert-danger">{{$errors->first("price_per_km")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($fare->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($fare->status=="inactive"){echo "selected";} ?>>Inactive</option>
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
