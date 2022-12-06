@extends("layouts.layout")
@section("title", "edit-customer")
@section("content")
<div class="container">
    @foreach($customers as $customer)
    <form action="{{route('customers.update',[$customer->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")
        <legend class="col-form-label">Edit customer</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">First Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="first_name" placeholder="Enter your first name" class="form-control" value="{{$customer->customer_first_name}}">
                @if($errors->has("first_name"))
                    <span class="alert alert-danger">{{$errors->first("first_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="last_name" class="col-md-2 col-form-label">Last Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="last_name" placeholder="Enter your last name" class="form-control" value="{{$customer->customer_last_name}}">
                @if($errors->has("last_name"))
                    <span class="alert alert-danger">{{$errors->first("last_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="phone_number" class="col-md-2 col-form-label">Phone Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" value="{{$customer->phone_number}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="col-md-2 col-form-label">Email <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="email" placeholder="Enter your email id" class="form-control" value="{{$customer->email}}">
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="password" class="col-md-2 col-form-label">Password <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="password" name="password" placeholder="Enter your password" class="form-control" value="{{$password}}">
                @if($errors->has("password"))
                    <span class="alert alert-danger">{{$errors->first("password")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="profile_image" class="col-md-2 col-form-label">Profile Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/profile_image/'.$customer->image)}}" alt="profile_image" >
            </div>
            <div class="col-md-7">
                <input type="file" name="image" placeholder="upload image" class="form-control" value="{{old('image')}}"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="country_code" class="col-md-2 col-form-label">Country Code <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="country_code" placeholder="Enter your country_code" class="form-control" value="{{$customer->code}}">
                @if($errors->has("country_code"))
                    <span class="alert alert-danger">{{$errors->first("country_code")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">Currency <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="currency" placeholder="Enter your currency" class="form-control" value="{{$customer->currency}}">
                @if($errors->has("currency"))
                    <span class="alert alert-danger">{{$errors->first("currency")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option>Select Status</option>
                    <option value="active"<?php if($customer->status=="active") echo "selected";?>>Active</option>
                    <option value="inactive" <?php if($customer->status=="inactive") echo "selected";?>>Inactive</option>
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