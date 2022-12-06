@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
    <div>
        <h6>Edit Payment type </h6>
        @foreach($payments as $payment)
        <form action="{{route('payment_types.update', [$payment->id])}}" method="post">
            @csrf
            @method("put")
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
</div>


@endsection