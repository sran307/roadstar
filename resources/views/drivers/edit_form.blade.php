@extends("layouts.layout")
@section("title", "edit vehicle")
@section("content")
<div class="container">
    @foreach($vehicles as $vehicle)
    <form action="{{route('update_vehicles',[$vehicle->id])}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Edit Driver Vehicles</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
                <select name="country" id="" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                    <option value="{{$country->country}}" <?php if($vehicle->country==$country->country) echo "selected";?>>{{$country->country}}</option>
                    @endforeach
                </select>                
                @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="driver" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
                <select name="driver" id="" class="form-control">
                    <option value="">Select Driver</option>
                    @foreach($drivers as $driver)
                    <option value="{{$driver->id}}"<?php if($vehicle->driver_id==$driver->id) echo "selected";?>>{{$driver->first_name}}</option>
                    @endforeach
                </select>                
                @if($errors->has("driver"))
                    <span class="alert alert-danger">{{$errors->first("driver")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_type" class="col-md-2 col-form-label">Vehicle Type <span class="star">*</span></label>
            <div class="col-md-8">
                <select name="vehicle_type" id="" class="form-control">
                    <option value="">Select Vehicle Type</option>
                    @foreach($user_vehicles as $user_vehicle)
                    <option value="{{$user_vehicle->vehicle}}" <?php if($vehicle->vehicle_type==$user_vehicle->vehicle) echo "selected";?>>{{$user_vehicle->vehicle}}</option>
                    @endforeach
                </select>                
                @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="brand" class="col-md-2 col-form-label">Brand <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="brand" placeholder="Enter the brand" class="form-control" value="{{$vehicle->brand}}">
                @if($errors->has("brand"))
                    <span class="alert alert-danger">{{$errors->first("brand")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="color" class="col-md-2 col-form-label">Color <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="color" placeholder="Enter vehicle color" class="form-control" value="{{$vehicle->color}}">
                @if($errors->has("color"))
                    <span class="alert alert-danger">{{$errors->first("color")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_name" class="col-md-2 col-form-label">Vehicle Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="vehicle_name" placeholder="Enter vehicle name" class="form-control" value="{{$vehicle->vehicle_name}}">
                @if($errors->has("vehicle_name"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_number" class="col-md-2 col-form-label">Vehicle Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="vehicle_number" placeholder="Enter vehicle number" class="form-control" value="{{$vehicle->vehicle_number}}">
                @if($errors->has("vehicle_number"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_image" class="col-md-2 col-form-label">Vehicle Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/vehicles/'.$vehicle->vehicle_image)}}" alt="vehicle_image">
            </div>
            <div class="col-md-6">
                <input type="file" name="vehicle_image" placeholder="upload image" class="form-control" value="{{old('vehicle_image')}}"> 
                @if($errors->has("vehicle_image"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_image")}}</span>
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