@extends("layouts.layout")
@section("title", "edit_widget")
@section("content")
<div class="container">
    @foreach($widgets as $widget)
    <form action="{{route('about_widgets.update', [$widget->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
      <legend class="col-form-label">Edit About Widget</legend>
        <div class="row form-group">
            <label for="heading" class="col-md-2 col-form-label">Heading <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="heading" placeholder="Enter the  heading" class="form-control" value="{{$widget->title}}">
                @if($errors->has("heading"))
                    <span class="alert alert-danger">{{$errors->first("heading")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/icons/'.$widget->image)}}" alt="images">
            </div>
            <div class="col-md-6"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                <span>Size must be 200kb and max-width 900px and max-height 720px</span>
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Description <span class="star">*</span> </label>
            <div class="col-md-8">
                <textarea id="summernote" name="details">{{$widget->details}}</textarea>
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
       <!-- <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($widget->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($widget->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-10 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection