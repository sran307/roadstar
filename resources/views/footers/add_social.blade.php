@extends("layouts.layout")
@section("title", "add_icon")
@section("content")
<div class="container">
<form action="{{route('social_icons.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Social Media Icon</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
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