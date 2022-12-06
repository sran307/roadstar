@extends("layouts.layout")
@section("title", "edit_link")
@section("content")
<div class="container">
    @foreach($links as $link)
    <form action="{{route('footer_links.update', [$link->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Footer Links</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Url Name <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="name" placeholder="Enter the url name" class="form-control" value="{{$link->name}}"> 
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/icons/'.$link->icon)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Url <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="url" placeholder="Enter the url" class="form-control" value="{{$link->link}}"> 
                @if($errors->has("url"))
                    <span class="alert alert-danger">{{$errors->first("url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($link->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($link->status=="inactive"){echo "selected";} ?>>Inactive</option>
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