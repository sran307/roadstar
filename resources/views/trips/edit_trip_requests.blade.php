@extends("layouts.layout")
@section("title", "edit_trip_request")
@section("content")
<div class="container">
    @foreach($requests as $request)
    <form action="{{route('trip_requests.update', [$request->id])}}" method="post" >
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Trip Request</legend>
        <div class="row form-group">
            <label for="customer" class="col-md-2 col-form-label">Customer <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" name="customer" placeholder="Enter customer name" class="form-control" value="{{$request->passanger_name}}">            
               @if($errors->has("customer"))
                    <span class="alert alert-danger">{{$errors->first("customer")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="distance" class="col-md-2 col-form-label">Distance <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="distance" placeholder="Enter your distance" class="form-control" value="{{$request->distance}}">
                @if($errors->has("distance"))
                    <span class="alert alert-danger">{{$errors->first("distance")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Vehicle Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="vehicle_type" class="form-control">
                   <option value="">Select Vehicle Type</option>
                   @foreach($vehicles as $vehicle)
                    <option value="{{$vehicle->id}}"<?php if($request->vehicle_type==$vehicle->id) echo "selected";?>>{{$vehicle->model_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="paddress" class="col-md-2 col-form-label">From Address <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="pickup_address" placeholder="Enter your pickup_address" class="form-control"> <?php if($request->type=="airport_from"){echo $request->airport;}?>
                        <?php if($request->type=="airport_to"){echo $request->from_address;}?>
                        <?php if($request->type!="airport_from" && $request->type!="airport_to"){echo $request->from_address;}?></textarea>
                @if($errors->has("pickup_address"))
                    <span class="alert alert-danger">{{$errors->first("pickup_address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lan" class="col-md-2 col-form-label">Pick up lattittude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lattitude" placeholder="Enter your pickup lattittude" class="form-control" value="{{$request->pickup_lat}}">
                @if($errors->has("lattitude"))
                    <span class="alert alert-danger">{{$errors->first("lattitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lon" class="col-md-2 col-form-label">Pick up longitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="longitude" placeholder="Enter your pickup longitude" class="form-control" value="{{$request->pickup_lon}}">
                @if($errors->has("longitude"))
                    <span class="alert alert-danger">{{$errors->first("longitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="drop_address" class="col-md-2 col-form-label">To Adress <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="drop_address" placeholder="Enter your drop address" class="form-control" ><?php if($request->type=="airport_from"){echo $request->to_address;}?>
                        <?php if($request->type=="airport_to"){echo $request->airport;}?>
                        <?php if($request->type!="airport_from" && $request->type!="airport_to"){echo $request->to_address;}?></textarea>
                @if($errors->has("drop_address"))
                    <span class="alert alert-danger">{{$errors->first("drop_address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lan" class="col-md-2 col-form-label">Drop lattittude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="drop_lattitude" placeholder="Enter your drop lattittude" class="form-control" value="{{$request->drop_lat}}">
                @if($errors->has("drop_lattitude"))
                    <span class="alert alert-danger">{{$errors->first("drop_lattitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lon" class="col-md-2 col-form-label">Drop longitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="drop_longitude" placeholder="Enter your pickup longitude" class="form-control" value="{{$request->drop_lon}}">
                @if($errors->has("drop_longitude"))
                    <span class="alert alert-danger">{{$errors->first("drop_longitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="payment" class="col-md-2 col-form-label">Payment Method <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="payment_method" id="" class="form-control">
                <option value="">Select payment method</option>
                @foreach($payment_methods as $payment)
                <option value="{{$payment->payment}}"<?php if($request->payment_method==$payment->payment) echo "selected";?>>{{$payment->payment}}</option>
                @endforeach
               </select>                
               @if($errors->has("payment_method"))
                    <span class="alert alert-danger">{{$errors->first("payment_method")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="total" class="col-md-2 col-form-label">Amount Paid <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Total" name="total" class="form-control" value="{{$request->total}}">
               @if($errors->has("total"))
                    <span class="alert alert-danger">{{$errors->first("total")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="total" class="col-md-2 col-form-label">Total <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Subtotal" name="subtotal" class="form-control" value="{{$request->subtotal}}">
               @if($errors->has("subtotal"))
                    <span class="alert alert-danger">{{$errors->first("subtotal")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="discound" class="col-md-2 col-form-label">Discount <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="discount" name="discount" class="form-control" value="{{$request->discount}}">
               @if($errors->has("discount"))
                    <span class="alert alert-danger">{{$errors->first("discount")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="tax" class="col-md-2 col-form-label">Tax <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Tax" name="tax" class="form-control" value="{{$request->tax}}">
               @if($errors->has("tax"))
                    <span class="alert alert-danger">{{$errors->first("tax")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="booking_status" class="form-control">
                   <option value="">Select status</option>
                   @foreach($statuses as $status)
                   <option value="{{$status->status}}"<?php if($request->status==$status->status) echo "selected";?>>{{$status->status}}</option>
                    @endforeach
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
                <input type="hidden" value="{{$request->id}}" id="trip_status_id">
               <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
<script>
    $(document).on("change", "#booking_status", function () {
        var value=$(this).val();
        var id=$("#trip_status_id").val();
       if(value=="Confirmed"){
          $.ajax({
              type: "post",
              url: "{{route('trip_confirmed')}}",
              data: {value: value, id:id, "_token": "{{ csrf_token() }}"},
              dataType: "json",
              success: function (response) {
                  if(response.status==200){
                    window.location.href = "{{route('new_trips.index')}}";
                  }
              }
          });
       }
    });

</script>
@endsection
