@extends("layouts.layout")
@section("title", "add customer sos")
@section("content")
<div class="container">
<form action="{{route('sos_models.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Customer SOs Contacts</legend>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Customer <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="customer" id="" class="form-control">
                   <option value="">Select Customer</option>
                   @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->customer_first_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("customer"))
                    <span class="alert alert-danger">{{$errors->first("customer")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter your sos name" class="form-control" value="{{old('name')}}">
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="phone_number" class="col-md-2 col-form-label">Phone Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" value="{{old('phone_number')}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                   <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
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