@extends("layouts.layout")
@section("title", "edit_blog")
@section("content")
<div class="container">
    @foreach($models as $model)
    <form action="{{route('blog_models.update', [$model->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
      <legend class="col-form-label">Edit Blog</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/blogs/'.$model->image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Image max-width: 360px max-height: 245px</span>
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="title" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="title" placeholder="Enter the title" class="form-control" value="{{$model->title}}"> 
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Description<span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea name="description" placeholder="Enter the description" class="form-control">{{$model->description}}</textarea> 
                @if($errors->has("description"))
                    <span class="alert alert-danger">{{$errors->first("description")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date" class="col-md-2 col-form-label">Date <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="date" name="date" placeholder="Enter the date" class="form-control" value="{{$model->date}}"> 
                @if($errors->has("date"))
                    <span class="alert alert-danger">{{$errors->first("date")}}</span>
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
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection