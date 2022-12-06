@extends("layouts.layout")
@section("title", "edit contact")
@section("content")
<div class="container">
    @foreach($contacts as $contact)
    <form action="{{route('contact_models.update',[$contact->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit contact Settings</legend>
        <div class="row form-group">
            <label for="phone" class="col-md-2 col-form-label">Phone Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter the phone number" class="form-control" value="{{$contact->phone_number}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="col-md-2 col-form-label">Email <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="email" placeholder="Enter your email" class="form-control" value="{{$contact->email}}">
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="address" class="col-md-2 col-form-label">Address <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea  name="address" placeholder="Enter the address"  class="form-control">{{$contact->address}}</textarea>
                @if($errors->has("address"))
                    <span class="alert alert-danger">{{$errors->first("address")}}</span>
                @endif
            </div>
        </div>
        
        <div class="row form-group">
            <label for="lat" class="col-md-2 col-form-label">Lat <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lat" placeholder="Enter the lattitude" class="form-control" value="{{$contact->lat}}">
                @if($errors->has("lat"))
                    <span class="alert alert-danger">{{$errors->first("lat")}}</span>
                @endif
            </div>
        </div>
        
        <div class="row form-group">
            <label for="lng" class="col-md-2 col-form-label">Lng <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lng" placeholder="Insert the longitude" class="form-control" value="{{$contact->lng}}">
                @if($errors->has("lng"))
                    <span class="alert alert-danger">{{$errors->first("lng")}}</span>
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