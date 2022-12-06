@extends("layouts.layout")
@section("title", "add_brand")
@section("content")
<div class="container">
<form action="{{route('manage_brands.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add Brand</legend>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Brand Code <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="code" placeholder="Enter the brand code" class="form-control" value="{{$id}}" readonly> 
                @if($errors->has("code"))
                    <span class="alert alert-danger">{{$errors->first("code")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Brand Name <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="text" name="name" placeholder="Enter the name" class="form-control" value="{{old('name')}}"> 
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
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