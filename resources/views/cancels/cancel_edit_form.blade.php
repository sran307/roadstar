@extends("layouts.layout")
@section("title", "edit cancel")
@section("content")
<div class="container">
    @foreach($details as $detail)
    <form action="{{route('cancel_update',[$detail->id])}}" method="post">
    @csrf
   
        <legend class="col-form-label">Edit cancel Settings</legend>
        <div class="row form-group">
            <label for="commission" class="col-md-2 col-form-label">Number Of Free Cancellation<span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="number" placeholder="Enter the commission" class="form-control" value="{{$detail->number}}">
                @if($errors->has("number"))
                    <span class="alert alert-danger">{{$errors->first("number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="time" class="col-md-2 col-form-label">Cancellation Charge<span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="charge" placeholder="Enter your maximum searching time" class="form-control" value="{{$detail->charge}}">
                @if($errors->has("charge"))
                    <span class="alert alert-danger">{{$errors->first("charge")}}</span>
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