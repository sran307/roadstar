@extends("layouts.layout")
@section("title", "edit_testimonial")
@section("content")
<div class="container">
    @foreach($models as $model)
    <form action="{{route('testimonial_models.update', [$model->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
       <legend class="col-form-label">Edit Testimonial</legend>
        <div class="row form-group">
            <label for="image" class="col-md-2 col-form-label"> Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/profile_image/'.$model->image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Name <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="name" placeholder="Enter the name" class="form-control" value="{{$model->name}}"> 
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="rating" class="col-md-2 col-form-label">Rating <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="rating" placeholder="Enter the rating" class="form-control" value="{{$model->rating}}"> 
                <span class="d-block">Rating must be less than or equal to 5</span>
                @if($errors->has("rating"))
                    <span class="alert alert-danger">{{$errors->first("rating")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Description<span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea type="text" name="description" placeholder="Enter the description" class="form-control">{{$model->description}}</textarea> 
                @if($errors->has("description"))
                    <span class="alert alert-danger">{{$errors->first("description")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($model->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($model->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection