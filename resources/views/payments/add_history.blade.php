@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
<form action="{{route('payment_histories.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add Payment History</legend>
        <div class="row form-group">
            <label for="trip" class="col-md-2 col-form-label">Trip <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="trip" id="" class="form-control">
                   <option value="">Select Trip</option>
                   @foreach($trips as $trip)
                    <option value="{{$trip->id}}">{{$trip->trip_id}}</option>
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
            <input type="text" placeholder="Mode" name="mode" class="form-control" value="{{old('mode')}}">             
               @if($errors->has("mode"))
                    <span class="alert alert-danger">{{$errors->first("mode")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="amount" class="col-md-2 col-form-label">Amount <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Amount" name="amount" class="form-control" value="{{old('amount')}}">             
               @if($errors->has("amount"))
                    <span class="alert alert-danger">{{$errors->first("amount")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>

@endsection
