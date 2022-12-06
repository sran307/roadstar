@extends("layouts.layout")
@section("title", "add_trip_request")
@section("content")
<div class="container">
<form action="{{route('trip_requests.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Trip Request</legend>
        <div class="row form-group">
            <label for="customer" class="col-md-2 col-form-label">Customer <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="customer" placeholder="Enter customer name" class="form-control" value="{{old('customer')}}">              
               @if($errors->has("customer"))
                    <span class="alert alert-danger">{{$errors->first("customer")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="distance" class="col-md-2 col-form-label">Distance <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="distance" placeholder="Enter your distance" class="form-control" value="{{old('distance')}}">
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
                    <option value="{{$vehicle->id}}">{{$vehicle->model_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("vehicle_type"))
                    <span class="alert alert-danger">{{$errors->first("vehicle_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="paddress" class="col-md-2 col-form-label">Pick Up Address <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="pickup_address" placeholder="Enter your pickup_address" class="form-control"> {{old('pickup_address')}}</textarea>
                @if($errors->has("pickup_address"))
                    <span class="alert alert-danger">{{$errors->first("pickup_address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lan" class="col-md-2 col-form-label">Pick up lattittude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="lattitude" placeholder="Enter your pickup lattittude" class="form-control" value="{{old('pickup_lattitude')}}">
                @if($errors->has("lattitude"))
                    <span class="alert alert-danger">{{$errors->first("lattitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lon" class="col-md-2 col-form-label">Pick up longitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="longitude" placeholder="Enter your pickup longitude" class="form-control" value="{{old('pickup_longitude')}}">
                @if($errors->has("longitude"))
                    <span class="alert alert-danger">{{$errors->first("longitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="drop_address" class="col-md-2 col-form-label">Drop Adress <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="drop_address" placeholder="Enter your drop address" class="form-control" >{{old('drop_address')}}</textarea>
                @if($errors->has("drop_address"))
                    <span class="alert alert-danger">{{$errors->first("drop_address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lan" class="col-md-2 col-form-label">Drop lattittude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="drop_lattitude" placeholder="Enter your drop lattittude" class="form-control" value="{{old('drop_lattitude')}}">
                @if($errors->has("drop_lattitude"))
                    <span class="alert alert-danger">{{$errors->first("drop_lattitude")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="lon" class="col-md-2 col-form-label">Drop longitude <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="drop_longitude" placeholder="Enter your pickup longitude" class="form-control" value="{{old('drop_longitude')}}">
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
                <option value="cash">Cash</option>
               </select>                
               @if($errors->has("payment_method"))
                    <span class="alert alert-danger">{{$errors->first("payment_method")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="total" class="col-md-2 col-form-label">Total <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Total" name="total" class="form-control" value="{{old('total')}}">
               @if($errors->has("total"))
                    <span class="alert alert-danger">{{$errors->first("total")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="total" class="col-md-2 col-form-label">Subtotal <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Subtotal" name="subtotal" class="form-control" value="{{old('subtotal')}}">
               @if($errors->has("subtotal"))
                    <span class="alert alert-danger">{{$errors->first("subtotal")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="discound" class="col-md-2 col-form-label">Discount <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="discount" name="discount" class="form-control" value="{{old('discount')}}">
               @if($errors->has("discount"))
                    <span class="alert alert-danger">{{$errors->first("discount")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="tax" class="col-md-2 col-form-label">Tax <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" placeholder="Tax" name="tax" class="form-control" value="{{old('tax')}}">
               @if($errors->has("tax"))
                    <span class="alert alert-danger">{{$errors->first("tax")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                   <option value="">Select status</option>
                   @foreach($statuses as $status)
                    <option value="{{$status->status}}">{{$status->status}}</option>
                    @endforeach
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
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
