@extends("layouts.layout")
@section("title", "country")
@section("content")
<div class="container">
    @foreach($countries as $country)
    <form action="{{route('countries.update', [$country->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Add Country</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Country" name="country" class="form-control" value="{{$country->country}}">             
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">Currency <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Currency" name="currency" class="form-control" value="{{$country->currency}}">             
               @if($errors->has("currency"))
                    <span class="alert alert-danger">{{$errors->first("currency")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Phone Code <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Phone Code" name="phone_code" class="form-control" value="{{$country->phone_code}}">             
               @if($errors->has("phone_code"))
                    <span class="alert alert-danger">{{$errors->first("phone_code")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($country->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($country->status=="inactive"){echo "selected";} ?>>Inactive</option>
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
