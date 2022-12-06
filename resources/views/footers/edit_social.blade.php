@extends("layouts.layout")
@section("title", "edit_icons")
@section("content")
<div class="container">
    @foreach($icons as $icon)
    <form action="{{route('social_icons.update', [$icon->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Social media Icon</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/icons/'.$icon->icon)}}" alt="images">
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
                <input type="text" name="url" placeholder="Enter the url" class="form-control" value="{{$icon->link}}"> 
                @if($errors->has("url"))
                    <span class="alert alert-danger">{{$errors->first("url")}}</span>
                @endif
            </div>
        </div>
    </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($icon->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($icon->status=="inactive"){echo "selected";} ?>>Inactive</option>
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