@extends("layouts.layout")
@section("title", "add_about_widget")
@section("content")
<div class="container">
<form action="{{route('about_page_widgets.store')}}" method="post" enctype="multipart/form-data">
    @csrf
      <!--  <legend class="col-form-label">Add About Page Widget</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label"> Icon <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Details <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="details" placeholder="Enter the details" class="form-control" value="{{old('details')}}"> 
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Title <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="title" placeholder="Enter the title" class="form-control" value="{{old('title')}}"> 
                @if($errors->has("title"))
                    <span class="alert alert-danger">{{$errors->first("title")}}</span>
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
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-10 text-center">
              <button class="btn btn-success">Save/button>
            </div>
        </div>
    </form>
</div>
@endsection