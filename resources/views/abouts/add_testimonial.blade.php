@extends("layouts.layout")
@section("title", "add_testimonial")
@section("content")
<div class="container">
<form action="{{route('testimonial_models.store')}}" method="post" enctype="multipart/form-data">
    @csrf
       <legend class="col-form-label">Add Testimonial</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Name <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="name" placeholder="Enter the name" class="form-control" value="{{old('name')}}"> 
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="rating" class="col-md-2 col-form-label">Rating <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="rating" placeholder="Enter the rating" class="form-control" value="{{old('rating')}}"> 
                <span class="d-block">Rating must be less than or equal to 5</span>
                @if($errors->has("rating"))
                    <span class="alert alert-danger">{{$errors->first("rating")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Description<span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea type="text" name="description" placeholder="Enter the description" class="form-control">{{old('description')}}</textarea> 
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
              <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection