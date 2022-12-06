@extends("layouts.layout")
@section("title", "addcomplaints")
@section("content")
<div class="container">
<form action="{{route('complaints_models.store')}}" method="post" >
    @csrf
        <legend class="col-form-label">Add Complaints</legend>
        <div class="row form-group">
            <label for="trip_id" class="col-md-2 col-form-label">Trip Id <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="trip_id" placeholder="Enter your trip id" class="form-control" value="{{old('trip_id')}}" >
                @if($errors->has("trip_id"))
                    <span class="alert alert-danger">{{$errors->first("trip_id")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="customer" class="col-md-2 col-form-label">Customer <span class="star">*</span></label>
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
            <label for="driver" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="driver" id="driver_id" class="form-control">
                   <option value="">Select Driver</option>
                   @foreach($drivers as $driver)
                    <option value="{{$driver->id}}">{{$driver->first_name}}</option>
                    @endforeach
               </select>                
               @if($errors->has("driver"))
                    <span class="alert alert-danger">{{$errors->first("driver")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="category" class="col-md-2 col-form-label">Complaint Category <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="category" id="" class="form-control">
                   <option value="">Select Complaint Category</option>
                   @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->complaint}}</option>
                    @endforeach
               </select>                
               @if($errors->has("category"))
                    <span class="alert alert-danger">{{$errors->first("category")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="subcategory" class="col-md-2 col-form-label">Complaint Sub Category <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="sub_category" id="" class="form-control">
                   <option value="">Select Complaint Sub Category</option>
                   @foreach($sub_categories as $sub_category)
                    <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>
                    @endforeach
               </select>                
               @if($errors->has("sub_category"))
                    <span class="alert alert-danger">{{$errors->first("sub_category")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="description" class="col-md-2 col-form-label">Description <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="description" placeholder="Enter your description" class="form-control" >{{old('description')}}</textarea>
                @if($errors->has("description"))
                    <span class="alert alert-danger">{{$errors->first("description")}}</span>
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
