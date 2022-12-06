@extends("layouts.layout")
@section("title", "add_widget")
@section("content")
<div class="container">
<form action="{{route('about_widgets.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add About Widget</legend>
        <div class="row form-group">
            <label for="heading" class="col-md-2 col-form-label">Heading <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="heading" placeholder="Enter the  heading" class="form-control" value="{{old('heading')}}">
                @if($errors->has("heading"))
                    <span class="alert alert-danger">{{$errors->first("heading")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                <span>Size must be 200kb and max-width 900px and max-height 720px</span>
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Details <span class="star">*</span> </label>
            <div class="col-md-8">
                <textarea name="details" placeholder="Enter your details" rows="10" class="form-control">{{old('details')}}</textarea>
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