@extends("layouts.layout")
@section("title", "add_service")
@section("content")
<div class="container">
<form action="{{route('service_models.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Service</legend>
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
                <span class="d-block" >Size must be less than 10kb and max-width 293px and 195</span>
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Details <span class="star">*</span> </label>
            <div class="col-md-8">
                <textarea name="details" id="summernote">{{old('details')}}</textarea>
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
     <!--   <div class="row form-group">
            <label for="button_icon" class="col-md-2 col-form-label">Button Icon <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="button_icon" placeholder="Enter the button icon" class="form-control" value="{{old('button_icon')}}">
                @if($errors->has("button_icon"))
                    <span class="alert alert-danger">{{$errors->first("button_icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="button_url" class="col-md-2 col-form-label">Button Url <span class="star">*</span> </label>
            <div class="col-md-8">
                <input type="text" name="button_url" placeholder="Enter your button url" class="form-control" value="{{old('button_url')}}">
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
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-10 text-center">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection