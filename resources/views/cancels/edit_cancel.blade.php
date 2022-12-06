@extends("layouts.layout")
@section("title", "Cancels")
@section("content")
<div class="container">
    <div>
        <h6>Edit Cancellation Reason </h6>
        @foreach($cancels as $cancel)
        <form action="{{route('cancellations.update', [$cancel->id])}}" method="post">
            @csrf
            @method("put")
            <div class="row form-group">
                <label for="reason" class="col-md-2 col-form-label">Cancellation Reason <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="Cancellation Reason" name="reason" class="form-control" value="{{$cancel->reason}}">             
                @if($errors->has("reason"))
                        <span class="alert alert-danger">{{$errors->first("reason")}}</span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-2 col-form-label">Type <span class="star">*</span></label>
                <div class="col-md-8">
                <select name="type" id="" class="form-control">
                        <option value="">Select Status</option>
                        @foreach($types as $type)
                        <option value="{{$type->user}}"<?php if($cancel->user_type==$type->user){echo "selected";} ?>>{{$type->user}}</option>
                       @endforeach
                </select>                
                @if($errors->has("type"))
                        <span class="alert alert-danger">{{$errors->first("type")}}</span>
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