@extends("layouts.layout")
@section("title", "rentalfare")
@section("content")
<div class="container">
<form action="{{route('rental_models.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add Rental Fare Management</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->country}}</option>
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
                    <option value="{{$vehicle->id}}">{{$vehicle->vehicle_type}}</option>
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
                   <option value="">Select Package</option>
                   @foreach($packages as $package)
                    <option value="{{$package->id}}">{{$package->name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("package"))
                    <span class="alert alert-danger">{{$errors->first("package")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fpkm" class="col-md-2 col-form-label">Price Per KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_km" placeholder="Enter your price per km" class="form-control" value="{{old('price_per_km')}}">
                @if($errors->has("price_per_km"))
                    <span class="alert alert-danger">{{$errors->first("price_per_km")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="fphr" class="col-md-2 col-form-label">Price Per Hour <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="price_per_hour" placeholder="Enter your price per hour" class="form-control" value="{{old('price_per_hour')}}">
                @if($errors->has("price_per_hour"))
                    <span class="alert alert-danger">{{$errors->first("price_per_hour")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="price" class="col-md-2 col-form-label">Package Price <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="package_price" placeholder="Enter your package price" class="form-control" value="{{old('package_price')}}">
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
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>

@endsection
