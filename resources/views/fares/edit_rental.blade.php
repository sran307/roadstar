@extends("layouts.layout")
@section("title", "rental_fare")
@section("content")
<div class="container">
    @foreach($fares as $fare)
    <form action="{{route('rental_models.update', [$fare->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Rental Fare Management</legend>
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
                    <option value="{{$vehicle->id}}" <?php if($vehicle->id==$fare->vehicle_type){echo "selected";} ?> >{{$vehicle->vehicle_type}}</option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="package" class="col-md-2 col-form-label">Package Id <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="package" id="" class="form-control">
                   <option value="">Select Package Id</option>
                   @foreach($packages as $package)
                    <option value="{{$package->id}}" <?php if($package->id==$fare->package_id){echo "selected";} ?> >{{$package->name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fpkm" class="col-md-2 col-form-label">Price Per KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_km" placeholder="Enter your price per km" class="form-control" value="{{$fare->price_per_km}}">
                @if($errors->has("price_per_km"))
                    <span class="alert alert-danger">{{$errors->first("price_per_km")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fphr" class="col-md-2 col-form-label">Price Per Hour <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_hour" placeholder="Enter your price per hour" class="form-control" value="{{$fare->price_per_hour}}">
                @if($errors->has("price_per_hour"))
                    <span class="alert alert-danger">{{$errors->first("price_per_hour")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="price" class="col-md-2 col-form-label">Package Price <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="package_price" placeholder="Enter your package price" class="form-control" value="{{$fare->package_price}}">
                @if($errors->has("package_price"))
                    <span class="alert alert-danger">{{$errors->first("package_price")}}</span>
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
