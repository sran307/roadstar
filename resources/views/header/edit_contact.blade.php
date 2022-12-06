@extends("layouts.layout")
@section("title", "headerContact")
@section("content")
<div class="container">
    @foreach($contacts as $contact)
    <form action="{{route('header_contacts.update', [$contact->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Header Contacts</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Contact Name <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Contact name" name="name" class="form-control" value="{{$contact->name}}">             
               @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Details <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="details" placeholder="Details" class="form-control"> {{$contact->details}}</textarea> 
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/icons/'.$contact->icon)}}" alt="contacts">
            </div>
            <div class="col-md-7">
                <input type="file" name="icon" placeholder="upload icon" class="form-control" value="{{old('icon')}}"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($contact->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($contact->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <input type="submit" value="update">
            </div>
        </div>
    </form>
    @endforeach
</div>

@endsection
