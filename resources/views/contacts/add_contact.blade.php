@extends("layouts.layout")
@section("title", "add contact")
@section("content")
<div class="container">
    <form action="{{route('contact_models.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add contact Settings</legend>
        <div class="row form-group">
            <label for="phone" class="col-md-2 col-form-label">Phone Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter the phone number" class="form-control" value="{{old('phone_number')}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="col-md-2 col-form-label">Email <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="email" placeholder="Enter your email" class="form-control" value="{{old('email')}}">
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="address" class="col-md-2 col-form-label">Address <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea  name="address" placeholder="Enter the address"  class="form-control">{{old('address')}}</textarea>
                @if($errors->has("address"))
                    <span class="alert alert-danger">{{$errors->first("address")}}</span>
                @endif
            </div>
        </div>
        
        <div class="row form-group">
            <label for="lat" class="col-md-2 col-form-label">Lat <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lat" placeholder="Enter the lattitude" class="form-control" value="{{old('lat')}}">
                @if($errors->has("lat"))
                    <span class="alert alert-danger">{{$errors->first("lat")}}</span>
                @endif
            </div>
        </div>
        
        <div class="row form-group">
            <label for="lng" class="col-md-2 col-form-label">Lng <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lng" placeholder="Enter the longitude" class="form-control" value="{{old('lng')}}">
                @if($errors->has("lng"))
                    <span class="alert alert-danger">{{$errors->first("lng")}}</span>
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