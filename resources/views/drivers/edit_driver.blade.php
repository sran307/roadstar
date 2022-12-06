@extends("layouts.layout")
@section("title", "edit driver")
@section("content")
<div class="container">
    @foreach($drivers as $driver)
    <form action="{{route('drivers.update',[$driver->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")
        <legend class="col-form-label">Edit Driver</legend>
        <div class="row form-group">
            <label for="daily" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                    <option value="">Select A Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country->country}}" <?php if($country->country==$driver->country){ echo "selected";}?>>{{$country->country}}</option>
                    @endforeach
               </select>                
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">First Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="first_name" placeholder="Enter your first name" class="form-control" value="{{$driver->first_name}}">
                @if($errors->has("first_name"))
                    <span class="alert alert-danger">{{$errors->first("first_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="last_name" class="col-md-2 col-form-label">Last Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="last_name" placeholder="Enter your last name" class="form-control" value="{{$driver->last_name}}">
                @if($errors->has("last_name"))
                    <span class="alert alert-danger">{{$errors->first("last_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="gender" class="col-md-2 col-form-label">Gender <span class="star">*</span></label>
            <div class="col-md-8">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="male" <?php if($driver->gender=="male"){echo "checked";}?>>
                    <label for="male" class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="female" class="form-check-input" <?php if($driver->gender=="female"){echo "checked";}?>>
                    <label for="female" class="form-check-label">Female</label>
                </div>
                @if($errors->has("gender"))
                    <span class="alert alert-danger">{{$errors->first("gender")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="phone_number" class="col-md-2 col-form-label">Phone Number<span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" value="{{$driver->phone_number}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="col-md-2 col-form-label">Email <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="email" placeholder="Enter your email id" class="form-control" value="{{$driver->email}}">
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="password" class="col-md-2 col-form-label">Password <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="password" name="password" placeholder="Enter your password" class="form-control" value="{{$password}}">
                <span class="d-block">Minimum 6 characters needed</span>
                <span class="d-block">Contains atleast one Upper case and one Lowercase letter.</span>
                @if($errors->has("password"))
                    <span class="alert alert-danger">{{$errors->first("password")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="profile_image" class="col-md-2 col-form-label">Profile Image <span class="star">*</span></label>
            <div class="col-md-1 sr_admin_image">
                <img src="{{asset('images/profile_image/'.$driver->image)}}" alt="profile_image" >
            </div>
            <div class="col-md-7">
                <input type="file" name="image" placeholder="upload image" class="form-control" value="{{old('image')}}"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
  <!--    <div class="row form-group">
            <label for="aadhar_image" class="col-md-2 col-form-label">Aadhaar Image <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/aadhar/'.$driver->aadhar_image)}}" alt="profile_image" width="50px" height="50px">
            </div>
            <div class="col-md-6">
                <input type="file" name="adhar_image" placeholder="upload image" class="form-control" value="{{old('adhar_image')}}">
                @if($errors->has("adhar"))
                    <span class="alert alert-danger">{{$errors->first("adhar_image")}}</span>
                @endif
            </div>
        </div> -->
        <div class="row form-group">
            <label for="aadhar_number" class="col-md-2 col-form-label">Aadhar Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="number" placeholder="Enter your aadhar number" class="form-control" value="{{$driver->aadhar}}">
                @if($errors->has("number"))
                    <span class="alert alert-danger">{{$errors->first("number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date of birth" class="col-md-2 col-form-label">Date Of Birth <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="date" name="dob" placeholder="Enter your date of birth" class="form-control" value="{{$driver->dob}}">
                @if($errors->has("dob"))
                    <span class="alert alert-danger">{{$errors->first("dob")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="license_number" class="col-md-2 col-form-label">License Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="license_number" placeholder="Enter your license number" class="form-control" value="{{$driver->license_number}}">
                @if($errors->has("license_number"))
                    <span class="alert alert-danger">{{$errors->first("license_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="Id_proof" class="col-md-2 col-form-label">Id Proof <span class="star">*</span></label>
            <div class="col-md-2">
                <img src="{{asset('images/id/'.$driver->id_image)}}" alt="profile_image" width="50px" height="50px">
            </div>
            <div class="col-md-6">
                <input type="file" name="id_proof" placeholder="upload image" class="form-control" >
                @if($errors->has("id_proof"))
                    <span class="alert alert-danger">{{$errors->first("id_proof")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="address" class="col-md-2 col-form-label">Adress <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="address" placeholder="Enter your address" class="form-control" >{{$driver->address}}</textarea>
                @if($errors->has("address"))
                    <span class="alert alert-danger">{{$errors->first("address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">Currency <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="currency" placeholder="Enter your currency" class="form-control" value="{{$driver->currency}}">
                @if($errors->has("currency"))
                    <span class="alert alert-danger">{{$errors->first("currency")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="daily" class="col-md-2 col-form-label">Daily <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="daily" id="" class="form-control">
                    <option value="yes"<?php if($driver->daily=="yes") echo "selected";?>>Yes</option>
                    <option value="no" <?php if($driver->daily=="no") echo "selected";?>>No</option>
               </select>                
               @if($errors->has("daily"))
                    <span class="alert alert-danger">{{$errors->first("daily")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="rental" class="col-md-2 col-form-label">Rental <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="rental" id="" class="form-control">
                    <option value="yes"<?php if($driver->rental=="yes") echo "selected";?>>Yes</option>
                    <option value="no" <?php if($driver->rental=="no") echo "selected";?>>No</option>
               </select>                
               @if($errors->has("rental"))
                    <span class="alert alert-danger">{{$errors->first("rental")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="outstation" class="col-md-2 col-form-label">Outstation <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="outstation" id="" class="form-control">
                    <option value="yes"<?php if($driver->outstation=="yes") echo "selected";?>>Yes</option>
                    <option value="no" <?php if($driver->outstation=="no") echo "selected";?>>No</option>
               </select>                
               @if($errors->has("outstation"))
                    <span class="alert alert-danger">{{$errors->first("outstation")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="commission" class="col-md-2 col-form-label">Commission <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="commission" placeholder="Enter your commission amount" class="form-control" value="{{$driver->commission}}">
                @if($errors->has("commission"))
                    <span class="alert alert-danger">{{$errors->first("commission")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="outstation" class="col-md-2 col-form-label">Commission Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="commission_type" id="" class="form-control">
                   <option>Select Commission Type</option>
                    <option value="percentage"<?php if($driver->comm_type=="percentage") echo "selected";?>>Percentage</option>
                    <option value="fixed" <?php if($driver->comm_type=="fixed") echo "selected";?>>Fixed</option>
               </select>                
               @if($errors->has("commission_type"))
                    <span class="alert alert-danger">{{$errors->first("commission_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="commission" class="col-md-2 col-form-label">Rating <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="rating" placeholder="Enter your rating" class="form-control" value="{{$driver->rating}}">
                <span class="d-block">Rating must be less than or equal to 5</span>
                @if($errors->has("rating"))
                    <span class="alert alert-danger">{{$errors->first("rating")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="status" id="" class="form-control">
                    <option>Select Status</option>
                    <option value="active"<?php if($driver->status=="active") echo "selected";?>>Active</option>
                    <option value="inactive" <?php if($driver->status=="inactive") echo "selected";?>>Inactive</option>
               </select>                
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
              <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>

@endsection