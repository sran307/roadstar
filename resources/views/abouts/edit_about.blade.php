@extends("layouts.layout")
@section("title", "edit_about")
@section("content")
<div class="container">
    @foreach($abouts as $about)
    <form action="{{route('about_pages.update', [$about->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
       <legend class="col-form-label">About</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Main Heading <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="main_heading" placeholder="Enter the main heading" class="form-control" value="{{$about->heading1}}"> 
                @if($errors->has("main_heading"))
                    <span class="alert alert-danger">{{$errors->first("main_heading")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Sub Heading <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="sub_heading" placeholder="Enter the sub heading" class="form-control" value="{{$about->heading2}}"> 
                @if($errors->has("sub_heading"))
                    <span class="alert alert-danger">{{$errors->first("sub_heading")}}</span>
                @endif
            </div>
        </div>
       <!-- <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Banner Image <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/page_images/'.$about->bg_image)}}" width="50px" height="50px" alt="images">
            </div>
            <div class="col-md-6"> 
                <input type="file" name="banner_image" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Image max-width=794px and max-height=244px</span>
                @if($errors->has("banner_image"))
                    <span class="alert alert-danger">{{$errors->first("banner_image")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/page_images/'.$about->image)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Image max-width=900px and max-height=719px</span>
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
      <!--  <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Url <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="url" placeholder="Enter the url" class="form-control" value="{{$about->url}}"> 
                @if($errors->has("url"))
                    <span class="alert alert-danger">{{$errors->first("url")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row form-group">
            <label for="url" class="col-md-2 col-form-label">Description 1<span class="star">*</span> </label>
            <div class="col-md-8"> 
                <textarea name="details" id="summernote">{{$about->details}}</textarea> 
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
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