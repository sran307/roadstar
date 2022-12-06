@extends("layouts.layout")
@section("title", "edit_slider")
@section("content")
<div class="container">
    @foreach($sliders as $slider)
    <form action="{{route('slider_models.update', [$slider->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
     <legend class="col-form-label">Edit Slider </legend>
        <div class="row form-group">
            <label for="heading1" class="col-md-2 col-form-label">Heading 1 <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="heading1" placeholder="Enter the first heading" class="form-control" value="{{$slider->heading1}}">
                @if($errors->has("heading1"))
                    <span class="alert alert-danger">{{$errors->first("heading1")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="heading2" class="col-md-2 col-form-label">Heading 2 <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="heading2" placeholder="Enter the second heading" class="form-control" value="{{$slider->heading2}}">
                @if($errors->has("heading2"))
                    <span class="alert alert-danger">{{$errors->first("heading2")}}</span>
                @endif
            </div>
        </div>
        
        <div class="row form-group">
            <label for="image" class="col-md-2 col-form-label">Slider Images </label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/slider_image/'.$slider->images)}}" alt="images">
            </div>
            <div class="col-md-7" id="image"> 
                <input type="file" name="images" placeholder="upload logo" class="form-control">
                <span>Image  max-width 1920px and 1080px</span> 
                @if($errors->has("images"))
                    <span class="alert alert-danger">{{$errors->first("images")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_name" class="col-md-2 col-form-label">Button Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="button_name" placeholder="Enter the button name" class="form-control" value="{{$slider->button_name}}">
                @if($errors->has("button_name"))
                    <span class="alert alert-danger">{{$errors->first("button_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_url" class="col-md-2 col-form-label">Button Url <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="button_url" placeholder="Enter your button url" class="form-control" value="{{$slider->button_url}}">
                @if($errors->has("button_url"))
                    <span class="alert alert-danger">{{$errors->first("button_url")}}</span>
                @endif
            </div>
        </div>
      <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($slider->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($slider->status=="inactive"){echo "selected";} ?>>Inactive</option>
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
<script>
    $(document).ready(function () {
        var count=0;
        $(document).on("click", "#add", function () {
            count++;
            $("#image").append("<input type='file' name='images[]' class='form-control my-2'>\
            <span>Image  max-width 1920px and 1080px</span>");
        });
    });
</script>
@endsection