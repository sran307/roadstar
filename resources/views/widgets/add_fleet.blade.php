@extends("layouts.layout")
@section("title", "add_fleet")
@section("content")
<div class="container">
<form action="{{route('fleet_models.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Fleets</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Fleet Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter the  fleet name" class="form-control" value="{{old('name')}}">
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="image" class="col-md-2 col-form-label">Fleet Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                <span class="d-block" >Image max-width 550px and max-height 310px</span>
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Type <span class="star">*</span> </label>
            <div class="col-md-8">
               <select name="type" id="" class="form-control">
                   <option value="">Select A Type</option>
                   <option value="luxery">Luxery</option>
                   <option value="normal">Normal</option>
               </select>
                @if($errors->has("type"))
                    <span class="alert alert-danger">{{$errors->first("type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="speed" class="col-md-2 col-form-label">Speed <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="speed" placeholder="Enter fleet speed" class="form-control" value="{{old('speed')}}">
                @if($errors->has("speed"))
                    <span class="alert alert-danger">{{$errors->first("speed")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="rating" class="col-md-2 col-form-label">Rate The Fleet <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="rating" placeholder="Enter fleet rating" class="form-control" value="{{old('rating')}}">
                <span class="d-block">Enter a value less than 5</span>
                @if($errors->has("rating"))
                    <span class="alert alert-danger">{{$errors->first("rating")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="amount" class="col-md-2 col-form-label">Amount Per Day <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="amount" placeholder="Enter fleet amount per day" class="form-control" value="{{old('amount')}}">
                @if($errors->has("amount"))
                    <span class="alert alert-danger">{{$errors->first("amount")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="passenger" class="col-md-2 col-form-label">Number Of Passengers <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="passenger" placeholder="Enter the number of passengers" class="form-control" value="{{old('passenger')}}">
                @if($errors->has("passenger"))
                    <span class="alert alert-danger">{{$errors->first("passenger")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_name" class="col-md-2 col-form-label">Button Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="button_name" placeholder="Enter the button name" class="form-control" value="{{old('button_name')}}">
                @if($errors->has("button_name"))
                    <span class="alert alert-danger">{{$errors->first("button_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_url" class="col-md-2 col-form-label">Button Url <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="button_url" placeholder="Enter the button url" class="form-control" value="{{old('button_url')}}">
                @if($errors->has("button_url"))
                    <span class="alert alert-danger">{{$errors->first("button_url")}}</span>
                @endif
            </div>
        </div>
      <!--  <div class="row form-group">
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
            </div>-->
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <input type="submit" value="save">
            </div>
        </div>
    </form>
</div>
@endsection