@extends("layouts.layout")
@section("title", "edit_title")
@section("content")
<div class="container">
    @foreach($titles as $title)
    <form action="{{route('heading_models.update', [$title->id])}}" method="post">
    @csrf
    @method("put")
      <legend class="col-form-label">Edit Title </legend>
        <div class="row form-group">
            <label for="title" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="title" placeholder="Enter the  Title" class="form-control" value="{{$title->main_heading}}">
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="subtitle" class="col-md-2 col-form-label">Sub Title </label>
            <div class="col-md-8">
                <input type="text" name="sub_title" placeholder="Enter the  Subt title" class="form-control" value="{{$title->sub_heading}}">
                @if($errors->has("sub_title"))
                    <span class="alert alert-danger">{{$errors->first("sub_title")}}</span>
                @endif
            </div>
        </div>
        <!--<div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($title->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($title->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div> 
        </div>-->
        <div class="row">
            <div class="col-md-10 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection