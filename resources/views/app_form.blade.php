@extends("layouts.layout")
@section("title", "app details")
@section("content")
<div class="container">
@foreach($data as $value)
<form action="{{route('app_update',[$value->id])}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Edit App Settings</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">App Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter the app name" class="form-control" value={{$value->name}}>
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">App Logo <span class="star">*</span></label>
            <div class="col-md-4">
                <img src="{{asset('images/logos/'.$value->logo)}}" width="50px" height="50px" alt="">
            </div>
            <div class="col-md-4">
                <input type="file" name="logo" placeholder="Insert the logo" class="form-control">
                @if($errors->has("logo"))
                    <span class="alert alert-danger">{{$errors->first("logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">App Version <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="version" placeholder="Enter your app version" class="form-control" value={{$value->version}}>
                @if($errors->has("version"))
                    <span class="alert alert-danger">{{$errors->first("version")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Default Currency <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="currency" placeholder="Enter the currerncy" class="form-control" value={{$value->currency}}>
                @if($errors->has("currency"))
                    <span class="alert alert-danger">{{$errors->first("currency")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Login Image <span class="star">*</span></label>
            <div class="col-md-4">
                <img src="{{asset('images/logos/'.$value->login_image)}}" width="50px" height="50px" alt="">
            </div>
            <div class="col-md-4">
                <input type="file" name="login_image" placeholder="Choose the image" class="form-control">
                @if($errors->has("login_image"))
                    <span class="alert alert-danger">{{$errors->first("login_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Default Currency Symbol <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="symbol" placeholder="Insert the symbol" class="form-control" value={{$value->symbol}}>
                @if($errors->has("symbol"))
                    <span class="alert alert-danger">{{$errors->first("symbol")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">About Us <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea type="text" name="about" placeholder="Enter something about us" class="form-control" > {{$value->about}}</textarea>
                @if($errors->has("about"))
                    <span class="alert alert-danger">{{$errors->first("about")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Refferal Amount <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="amount" placeholder="Enter the amount" class="form-control" value={{$value->amount}}>
                @if($errors->has("amount"))
                    <span class="alert alert-danger">{{$errors->first("amount")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Default lattitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lattitude" placeholder="Enter the lattitude" class="form-control" value={{$value->lattitude}}>
                @if($errors->has("lattitude"))
                    <span class="alert alert-danger">{{$errors->first("lattitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Default Longitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="longitude" placeholder="Enter the longitude" class="form-control" value={{$value->longitude}}>
                @if($errors->has("longitude"))
                    <span class="alert alert-danger">{{$errors->first("longitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
        @endforeach
    </form>
</div>

@endsection