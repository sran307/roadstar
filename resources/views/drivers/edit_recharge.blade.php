@extends("layouts.layout")
@section("title", "edit_recharge")
@section("content")
<div class="container">
<form action="{{route('driver_recharges.update', $recharges->id)}}" method="post" >
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Recharge</legend>
        <div class="row form-group">
            <label for="driver" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="driver" id="" class="form-control">
                    <option value="">Select A Driver</option>
                    @foreach($drivers as $driver)
                        <option value="{{$driver->id}}" <?php if($driver->id==$recharges->driver){ echo "selected";} ?> >{{$driver->first_name." ".$driver->last_name}}</option>
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
                <input type="text" name="amount" placeholder="Enter the amount" class="form-control" value="{{$recharges->amount}}">
                @if($errors->has("amount"))
                    <span class="alert alert-danger">{{$errors->first("amount")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
              <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

@endsection