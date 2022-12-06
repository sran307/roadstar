@extends("layouts.layout")
@section("title", "edit_model")
@section("content")
<div class="container">
<form action="{{route('manage_models.update', $model->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
        <legend class="col-form-label">Add Model</legend>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Model Number <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="model_number" placeholder="Enter the model number" class="form-control" value="{{$model->model_number}}"> 
                @if($errors->has("model_number"))
                    <span class="alert alert-danger">{{$errors->first("model_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Model Name <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="model_name" placeholder="Enter the model name" class="form-control" value="{{$model->model_name}}"> 
                @if($errors->has("model_name"))
                    <span class="alert alert-danger">{{$errors->first("model_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="brands" class="col-md-2 col-form-label">Brands <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="brand" id="" class="form-control">
                   <option value="">Select Brand</option>
                   @foreach($brands as $brand)
                    <option value="{{$brand->id}}"<?php if($brand->id==$model->brand){echo "selected";}?>>{{$brand->brand_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("brand"))
                    <span class="alert alert-danger">{{$errors->first("brand")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="year" class="col-md-2 col-form-label">Year <span class="star">*</span></label>
            <div class="col-md-8"> 
            <select name="year" id="ddlYears" class="form-control">
                <option value="{{$model->year}}">{{$model->year}}</option>
            </select>
                @if($errors->has("year"))
                    <span class="alert alert-danger">{{$errors->first("year")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Image <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/fleets/'.$model->image)}}" width="50px" height="50px" alt="images">
            </div>
            <div class="col-md-6"> 
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
                    <option value="active"<?php if($model->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($model->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection