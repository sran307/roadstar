@extends("layouts.layout")
@section("title", "add vehicle")
@section("content")
<div class="container">
<form action="{{route('add_vehicles_form')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Driver Vehicles</legend>
        <div class="row form-group">
            <label for="driver" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
                <select name="driver" id="" class="form-control">
                    <option value="">Select Driver</option>
                    @foreach($drivers as $driver)
                    <option value="{{$driver->id}}">{{$driver->first_name}}</option>
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
                    @foreach($vehicles as $vehicle)
                    <option value="{{$vehicle->model_name}}">{{$vehicle->model_name}}</option>
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
                <input type="text" name="brand" placeholder="Enter the brand" class="form-control" value="{{old('brand')}}">
                @if($errors->has("brand"))
                    <span class="alert alert-danger">{{$errors->first("brand")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="color" class="col-md-2 col-form-label">Color <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="color" placeholder="Enter vehicle color" class="form-control" value="{{old('color')}}">
                @if($errors->has("color"))
                    <span class="alert alert-danger">{{$errors->first("color")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_name" class="col-md-2 col-form-label">Vehicle Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="vehicle_name" placeholder="Enter vehicle name" class="form-control" value="{{old('vehicle_number')}}">
                @if($errors->has("vehicle_name"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_number" class="col-md-2 col-form-label">Vehicle Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="vehicle_number" placeholder="Enter vehicle number" class="form-control" value="{{old('vehicle_number')}}">
                @if($errors->has("vehicle_number"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="vehicle_image" class="col-md-2 col-form-label">Vehicle Image <span class="star">*</span></label>
            <div class="col-md-8">
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