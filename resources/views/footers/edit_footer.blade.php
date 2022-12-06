@extends("layouts.layout")
@section("title", "edit_logo")
@section("content")
<div class="container">
    @foreach($logos as $logo)
    <form action="{{route('footer_logos.update', [$logo->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Footer Logo</legend>
        <div class="row form-group">
            <label for="logo" class="col-md-2 col-form-label">Logo <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/logos/'.$logo->logo)}}" alt="images">
            </div>
            <div class="col-md-7"> 
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
                <textarea name="details" placeholder="Enter your details" class="form-control">{{$logo->details}}</textarea>
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
    </div>
   <!--     <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($logo->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($logo->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-10 text-center">
               <input type="submit" value="update">
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection