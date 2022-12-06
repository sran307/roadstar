@extends("layouts.layout")
@section("title", "add_fleet_category")
@section("content")
<div class="container">
<form action="{{route('fleet_categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Fleet Category</legend>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Category Code <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="code" placeholder="Enter the category code" class="form-control" value="{{$id}}" readonly> 
                @if($errors->has("code"))
                    <span class="alert alert-danger">{{$errors->first("code")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Name <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="name" placeholder="Enter the name" class="form-control" value="{{old('name')}}"> 
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Image <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="image" placeholder="upload logo" class="form-control"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
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
               <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection