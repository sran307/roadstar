@extends("layouts.layout")
@section("title", "add_recharge")
@section("content")
<div class="container">
<form action="{{route('driver_recharges.store')}}" method="post" >
    @csrf
        <legend class="col-form-label">Add Recharge</legend>
        <div class="row form-group">
            <label for="driver" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="driver" id="" class="form-control">
                    <option value="">Select A Driver</option>
                    @foreach($drivers as $driver)
                        <option value="{{$driver->id}}" >{{$driver->first_name." ".$driver->last_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("driver"))
                    <span class="alert alert-danger">{{$errors->first("driver")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="amount" class="col-md-2 col-form-label">Amount <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="amount" placeholder="Enter the amount" class="form-control" value="{{old('amount')}}">
                @if($errors->has("amount"))
                    <span class="alert alert-danger">{{$errors->first("amount")}}</span>
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