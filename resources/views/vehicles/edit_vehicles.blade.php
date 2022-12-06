@extends("layouts.layout")
@section("title", "edit vehicle")
@section("content")
<div class="container">
    @foreach($vehicles as $vehicle)
    <form action="{{route('vehicle_managements.update',[$vehicle->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Vehicle</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
                <select name="country" id="" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" <?php if($vehicle->country_id==$country->id) echo "selected";?>>{{$country->country}}</option>
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
                <input type="text" name="vehicle_type" class="form-control" placeholder="Enter vehicle type" value="{{$vehicle->vehicle_type}}">           
                @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="description" class="col-md-2 col-form-label">Description <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea type="text" name="description" placeholder="Description" class="form-control"> {{$vehicle->description}}</textarea>
                @if($errors->has("description"))
                    <span class="alert alert-danger">{{$errors->first("description")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fare" class="col-md-2 col-form-label">Base Fare <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="fare" placeholder="Enter the base fare" class="form-control" value="{{$vehicle->fare}}">
                @if($errors->has("fare"))
                    <span class="alert alert-danger">{{$errors->first("fare")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="ppm" class="col-md-2 col-form-label">Price Per KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_km" placeholder="Enter the price per km" class="form-control" value="{{$vehicle->price_km}}">
                @if($errors->has("price_per_km"))
                    <span class="alert alert-danger">{{$errors->first("price_per_km")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="active_icon" class="col-md-2 col-form-label">Active Icon <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/icons/'.$vehicle->image)}}" alt="vehicle_image">
            </div>
            <div class="col-md-7">
                <input type="file" name="image" placeholder="upload image" class="form-control" value="{{old('image')}}"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_level" class="col-md-2 col-form-label">Vehicle Level <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="vehicle_level" placeholder="Enter the vehicle level" class="form-control" value="{{$vehicle->vehicle_level}}">
                @if($errors->has("vehicle_level"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_level")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option>Select Status</option>
                    <option value="active"<?php if($vehicle->status=="active") echo "selected";?>>Active</option>
                    <option value="inactive" <?php if($vehicle->status=="inactive") echo "selected";?>>Inactive</option>
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