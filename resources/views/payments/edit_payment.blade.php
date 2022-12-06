@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
    @foreach($payments as $payment)
<form action="{{route('payment_models.update', [$payment->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Payment Methods</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                   <option value="">Select country</option>
                   @foreach($countries as $country)
                    <option value="{{$country->id}}" <?php if($country->id==$payment->country){echo "selected";} ?> >{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="payment" class="col-md-2 col-form-label">Payment <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Payment" name="payment" class="form-control" value="{{$payment->payment}}">             
               @if($errors->has("payment"))
                    <span class="alert alert-danger">{{$errors->first("payment")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="payment_type" class="col-md-2 col-form-label">Payment Type <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Payment Type" name="payment_type" class="form-control" value="{{$payment->payment_type}}">             
               @if($errors->has("payment_type"))
                    <span class="alert alert-danger">{{$errors->first("payment_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/icons/'.$payment->icon)}}" width="100px" height="100px" alt="">
            </div>
            <div class="col-md-6">
                <input type="file" name="icon" placeholder="upload image" class="form-control" value="{{old('icon')}}"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active"<?php if($payment->status=="active"){echo "selected";} ?>>Active</option>
                    <option value="inactive" <?php if($payment->status=="inactive"){echo "selected";} ?>>Inactive</option>
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
