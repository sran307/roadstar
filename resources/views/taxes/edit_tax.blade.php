@extends("layouts.layout")
@section("title", "taxes")
@section("content")
<div class="container">
    @foreach($taxes as $tax)
<form action="{{route('tax_models.update', [$tax->id])}}" method="post" >
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Tax Lists</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}" <?php if($country->id==$tax->country){echo "selected";} ?> >{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Tax Name <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Tax Name" name="name" class="form-control" value="{{$tax->name}}">             
               @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="percent" class="col-md-2 col-form-label">Percent <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Percent" name="percent" class="form-control" value="{{$tax->percent}}">             
               @if($errors->has("percent"))
                    <span class="alert alert-danger">{{$errors->first("percent")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($tax->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($tax->status=="inactive"){echo "selected";} ?>>Inactive</option>
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
