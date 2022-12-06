@extends("layouts.layout")
@section("title", "add trip-type")
@section("content")
<div class="container">
    @foreach($trips as $trip)
    <form action="{{route('trip_types.update',[$trip->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")
        <legend class="col-form-label">Edit Trip Type</legend>
        <div class="row form-group">
            <label for="active_icon" class="col-md-2 col-form-label">Active Icon<span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/icons/'.$trip->active)}}" width="75px" height="75px" alt="active_icon"> 
            </div>
            <div class="col-md-6">
                <input type="file" name="active_icon" class="form-control">
                @if($errors->has("active_icon"))
                    <span class="alert alert-danger">{{$errors->first("active_icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="inactive_icon" class="col-md-2 col-form-label">Inactive Icon<span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/icons/'.$trip->inactive)}}" width="75px" height="75px" alt="active_icon"> 
            </div>
            <div class="col-md-6">
                <input type="file" name="inactive_icon" class="form-control">
                @if($errors->has("inactive_icon"))
                    <span class="alert alert-danger">{{$errors->first("inactive_icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter trip name" class="form-control" value="{{$trip->name}}">
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option>Select Status</option>
                    <option value="active"<?php if($trip->status=="active") echo "selected";?>>Active</option>
                    <option value="inactive" <?php if($trip->status=="inactive") echo "selected";?>>Inactive</option>
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