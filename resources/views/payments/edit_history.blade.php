@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
    @foreach($payments as $payment)
<form action="{{route('payment_histories.update', [$payment->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Payment History</legend>
        <div class="row form-group">
            <label for="trip" class="col-md-2 col-form-label">Trip <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="trip" id="" class="form-control">
                   <option value="">Select Trip</option>
                   @foreach($trips as $trip)
                    <option value="{{$trip->id}}" <?php if($payment->trip_id==$trip->id){ echo("selected");}?>>{{$trip->trip_id}}</option>
                    @endforeach
               </select>                
               @if($errors->has("trip"))
                    <span class="alert alert-danger">{{$errors->first("trip")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="mode" class="col-md-2 col-form-label">Mode <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Mode" name="mode" class="form-control" value="{{$payment->mode}}">             
               @if($errors->has("mode"))
                    <span class="alert alert-danger">{{$errors->first("mode")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="amount" class="col-md-2 col-form-label">Amount <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Amount" name="amount" class="form-control" value="{{$payment->amount}}">             
               @if($errors->has("amount"))
                    <span class="alert alert-danger">{{$errors->first("amount")}}</span>
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
