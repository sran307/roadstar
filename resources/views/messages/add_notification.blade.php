@extends("layouts.layout")
@section("title", "notifications")
@section("content")
<div class="container">
<form action="{{route('notification_models.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Notification Messages</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->country}}</option>
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
                   <option value="">Select Type</option>
                   @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->user}}</option>
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
            <input type="text" placeholder="Title" name="title" class="form-control" value="{{old('title')}}">             
               @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="message" class="col-md-2 col-form-label">Message <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="message" placeholder="Message" class="form-control"> {{old('message')}}</textarea> 
                @if($errors->has("message"))
                    <span class="alert alert-danger">{{$errors->first("message")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="image" class="col-md-2 col-form-label">Image <span class="star">*</span></label>
            <div class="col-md-8">
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
