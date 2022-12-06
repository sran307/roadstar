@extends("layouts.layout")
@section("title", "outstationfare")
@section("content")
<div class="container">
    @foreach($fares as $fare)
    <form action="{{route('outstation_models.update', [$fare->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Outstation Fare</legend>
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
            <label for="basefare" class="col-md-2 col-form-label">Base Fare <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="base_fare" placeholder="Enter your base fare" class="form-control" value="{{$fare->base_fare}}">
                @if($errors->has("base_fare"))
                    <span class="alert alert-danger">{{$errors->first("base_fare")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="cover_km" class="col-md-2 col-form-label">Base Fare Cover KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="base_fare_km" placeholder="Enter your base fare cover km" class="form-control" value="{{$fare->base_fare_km}}">
                @if($errors->has("base_fare_km"))
                    <span class="alert alert-danger">{{$errors->first("base_fare_km")}}</span>
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
            <label for="fpkm" class="col-md-2 col-form-label">Total coverage KM <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="total_coverage_km" placeholder="Enter your total coverage km" class="form-control" value="{{$fare->total_km}}">
                @if($errors->has("total_coverage_km"))
                    <span class="alert alert-danger">{{$errors->first("total_coverage_km")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="allowance" class="col-md-2 col-form-label">Driver Allowance <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="allowance" placeholder="Enter driver allowance" class="form-control" value="{{$fare->allowance}}">
                @if($errors->has("allowance"))
                    <span class="alert alert-danger">{{$errors->first("allowance")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="type" id="" class="form-control">
                    <option value="oneway"<?php if($fare->type=="oneway"){echo "selected";} ?>>One Way Trip</option>
                    <option value="round" <?php if($fare->type=="round"){echo "selected";} ?>>Rounded Trip</option>
               </select>                
               @if($errors->has("type"))
                    <span class="alert alert-danger">{{$errors->first("type")}}</span>
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
