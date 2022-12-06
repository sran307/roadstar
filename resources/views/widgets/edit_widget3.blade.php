@extends("layouts.layout")
@section("title", "edit_widget")
@section("content")
<div class="container">
    @foreach($widgets as $widget)
    <form action="{{route('widget3_models.update', [$widget->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
      <legend class="col-form-label"> Security Widget </legend>
        <div class="row form-group">
            <label for="heading" class="col-md-2 col-form-label">Heading <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="heading" placeholder="Enter the  heading" class="form-control" value="{{$widget->heading}}">
                @if($errors->has("heading"))
                    <span class="alert alert-danger">{{$errors->first("heading")}}</span>
                @endif
            </div>
        </div>
       <!-- <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/icons/'.$widget->images)}}" width="50px" height="50px" alt="images">
            </div>
            <div class="col-md-6"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Size must be 500kb and max-width 1920px and max-height 1080px</span>
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div> 
        </div>-->
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Details <span class="star">*</span> </label>
            <div class="col-md-8">
                <textarea name="details" id="summernote">{{$widget->details}}</textarea>
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_name" class="col-md-2 col-form-label">Button Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="button_name" placeholder="Enter the button name" class="form-control" value="{{$widget->button_name}}">
                @if($errors->has("button_name"))
                    <span class="alert alert-danger">{{$errors->first("button_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_url" class="col-md-2 col-form-label">Button Url <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="button_url" placeholder="Enter your button url" class="form-control" value="{{$widget->button_url}}">
                @if($errors->has("button_url"))
                    <span class="alert alert-danger">{{$errors->first("button_url")}}</span>
                @endif
            </div>
        </div>
      <!--  <div class="row form-group">
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