@extends("layouts.layout")
@section("title", "add_blog")
@section("content")
<div class="container">
<form action="{{route('blog_models.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Blog</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Image <span class="star">*</span></label>
            <div class="col-md-8"> 
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
                <input type="text" name="title" placeholder="Enter the title" class="form-control" value="{{old('title')}}"> 
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Description<span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea name="description" placeholder="Enter the description" class="form-control">{{old('description')}}</textarea> 
                @if($errors->has("description"))
                    <span class="alert alert-danger">{{$errors->first("description")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date" class="col-md-2 col-form-label">Date <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="date" name="date" placeholder="Enter the date" class="form-control" value="{{old('date')}}"> 
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
            <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection