@extends("layouts.layout")
@section("title", "edit trip")
@section("content")
<div class="container">
    @foreach($trips as $trip)
    <form action="{{route('trip_update',[$trip->id])}}" method="post">
    @csrf
   
        <legend class="col-form-label">Edit trip Settings</legend>
        <div class="row form-group">
            <label for="commission" class="col-md-2 col-form-label">Admin Commission<span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="commission" placeholder="Enter the commission" class="form-control" value="{{$trip->commision}}">
                @if($errors->has("commission"))
                    <span class="alert alert-danger">{{$errors->first("commission")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="time" class="col-md-2 col-form-label">Maximum Searching Time <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="time" placeholder="Enter your maximum searching time" class="form-control" value="{{$trip->time}}">
                @if($errors->has("time"))
                    <span class="alert alert-danger">{{$errors->first("time")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="address" class="col-md-2 col-form-label">Booking Searching Radius <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text"  name="radius" placeholder="Enter the searching radius"  class="form-control" value="{{$trip->radius}}">
                @if($errors->has("radius"))
                    <span class="alert alert-danger">{{$errors->first("radius")}}</span>
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