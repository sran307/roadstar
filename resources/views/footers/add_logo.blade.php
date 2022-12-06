@extends("layouts.layout")
@section("title", "add_logo")
@section("content")
<div class="container">
<form action="{{route('footer_logos.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Footer Logo</legend>
        <div class="row form-group">
            <label for="logo" class="col-md-2 col-form-label">Logo <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="logo" placeholder="upload logo" class="form-control"> 
                <span class="d-block">(Logo max-width:1450px max-height:1100px) </span>
                @if($errors->has("logo"))
                    <span class="alert alert-danger">{{$errors->first("logo")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Details <span class="star">*</span> </label>
            <div class="col-md-8">
                <textarea name="details" placeholder="Enter your details" class="form-control">{{old('details')}}</textarea>
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
      <!--  <div class="row form-group">
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
            </div>-->
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <input type="submit" value="save">
            </div>
        </div>
    </form>
</div>
@endsection