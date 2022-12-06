@extends("layouts.layout")
@section("title", "edit_about_widget")
@section("content")
<div class="container">
    @foreach($widgets as $widget)
    <form action="{{route('about_page_widgets.update', [$widget->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
      <legend class="col-form-label">Widgets</legend>
        <!--<div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Icon <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/icons/'.$widget->icon)}}" width="50px" height="50px" alt="images">
            </div>
            <div class="col-md-6"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Details <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="details" placeholder="Enter the details" class="form-control" value="{{$widget->details}}"> 
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="title" placeholder="Enter the title" class="form-control" value="{{$widget->title}}"> 
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
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
        </div>-->
        <div class="row">
            <div class="col-md-10 text-center">
              <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection