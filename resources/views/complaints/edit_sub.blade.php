@extends("layouts.layout")
@section("title", "complaints")
@section("content")
<div class="container">
    @foreach($complaints as $complaint)
    <form action="{{route('complaint_subs.update', [$complaint->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Complaint Sub Categories</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}" <?php if($country->id==$complaint->country){echo "selected";} ?> >{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="category" class="col-md-2 col-form-label">Complaint Category <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="category" id="" class="form-control">
                   <option value="">Select Complaint Category</option>
                   @foreach($categories as $category)
                    <option value="{{$category->id}}" <?php if($category->id==$complaint->category){echo "selected";} ?>>{{$category->complaint}}</option>
                    @endforeach
               </select>                
               @if($errors->has("category"))
                    <span class="alert alert-danger">{{$errors->first("category")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="sub_category" class="col-md-2 col-form-label">Complaint Sub Category <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="sub_category" placeholder="Enter your complaint sub category" class="form-control" value="{{$complaint->sub_category}}">
                @if($errors->has("sub_category"))
                    <span class="alert alert-danger">{{$errors->first("sub_category")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($complaint->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($complaint->status=="inactive"){echo "selected";} ?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>

@endsection
