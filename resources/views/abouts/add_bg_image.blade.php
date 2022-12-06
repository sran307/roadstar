@extends("layouts.layout")
@section("title", "add_background_image")
@section("content")
<div class="container">
<form action="{{route('background_images.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Background Image</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Background Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="background_image" placeholder="upload logo" class="form-control"> 
                <span class="d-block">Image max-width=794px and max-height=308px</span>
                @if($errors->has("background_image"))
                    <span class="alert alert-danger">{{$errors->first("background_image")}}</span>
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