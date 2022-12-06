@extends("layouts.layout")
@section("title", "edit_payment")
@section("content")
<div class="container">
    @foreach($payments as $payment)
    <form action="{{route('footer_payments.update', [$payment->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Footer Payments</legend>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/icons/'.$payment->icon)}}" alt="images">
            </div>
            <div class="col-md-7"> 
                <input type="file" name="icon" placeholder="upload logo" class="form-control"> 
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
               <input type="submit" value="update">
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection