@extends("layouts.layout")
@section("title", "notification")
@section("content")
<div class="container">
    @foreach($messages as $message)
    <form action="{{route('notification_models.update', [$message->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Notification Messages</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}" <?php if($country->id==$message->country){echo "selected";} ?> >{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Types <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="type" id="" class="form-control">
                   <option value="">Select types</option>
                   @foreach($types as $type)
                    <option value="{{$type->id}}" <?php if($type->id==$message->type){echo "selected";} ?> >{{$type->user}}</option>
                    @endforeach
               </select>                
               @if($errors->has("type"))
                    <span class="alert alert-danger">{{$errors->first("type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="title" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Title" name="title" class="form-control" value="{{$message->title}}">             
               @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="message" class="col-md-2 col-form-label">Message <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="message" placeholder="Message" class="form-control"> {{$message->message}}</textarea> 
                @if($errors->has("message"))
                    <span class="alert alert-danger">{{$errors->first("message")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="image" class="col-md-2 col-form-label">Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/profile_image/'.$message->image)}}" alt="">
            </div>
            <div class="col-md-7">
                <input type="file" name="image" placeholder="upload image" class="form-control" value="{{old('image')}}"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($message->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($message->status=="inactive"){echo "selected";} ?>>Inactive</option>
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
