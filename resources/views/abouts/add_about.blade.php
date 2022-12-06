@extends("layouts.layout")
@section("title", "add_aboutUs")
@section("content")
<div class="container">
<form action="{{route('about_pages.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add About Us</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Main Heading <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="main_heading" placeholder="Enter the main heading" class="form-control" value="{{old('main_heading')}}"> 
                @if($errors->has("main_heading"))
                    <span class="alert alert-danger">{{$errors->first("main_heading")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Sub Heading <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="sub_heading" placeholder="Enter the sub heading" class="form-control" value="{{old('sub_heading')}}"> 
                @if($errors->has("sub_heading"))
                    <span class="alert alert-danger">{{$errors->first("sub_heading")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Banner Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="banner_image" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Image max-width=794px and max-height=244px</span>
                @if($errors->has("banner_image"))
                    <span class="alert alert-danger">{{$errors->first("banner_image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Image max-width=900px and max-height=719px</span>
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Url <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="url" placeholder="Enter the url" class="form-control" value="{{old('url')}}"> 
                @if($errors->has("url"))
                    <span class="alert alert-danger">{{$errors->first("url")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Details<span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea type="text" name="details" rows="10" placeholder="Enter the details" class="form-control">{{old('details')}}</textarea> 
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
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
               <input type="submit" value="save">
            </div>
        </div>
    </form>
</div>
@endsection