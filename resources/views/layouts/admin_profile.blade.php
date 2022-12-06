@extends("layouts.layout")
@section("title", "profile")
@section("content")
<div class="container mx-5">
    @foreach($data as $value)
    <form action="{{route('update_profile',[$value->id])}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">PROFILE</legend>
        
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Full name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter your fullname" class="form-control" value={{$value->user_first_name}}>
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="form-label col-md-2">Email <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="email" name="email"  class="form-control" placeholder="Enter your email" value={{$value->email}}>
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="password" class="col-form-label col-md-2">password <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="password" name="password" placeholder="Enter your password" class="form-control" value={{$decrypt_password}}>
                @if($errors->has("password"))
                    <span class="alert alert-danger">{{$errors->first("password")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="password" class="col-form-label col-md-2">Phone Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" value={{$value->phone_number}}>
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="image" class="col-md-2 col-form-label">profile image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/profile_image/'.$value->image)}}" alt="admin">
            </div>
            <div class="col-md-7">
                <input type="file" name="image"  class="form-control">
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>  
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary">Update</button>
            </div>
        </div>
        @endforeach
    </form>
</div>


@endsection