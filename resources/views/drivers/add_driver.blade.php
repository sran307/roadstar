@extends("layouts.layout")
@section("title", "add driver")
@section("content")
<div class="container">
<form action="{{route('drivers.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Driver</legend>
        <div class="row form-group">
            <label for="daily" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="country" id="" class="form-control">
                    <option value="">Select A Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country->country}}" <?php if($country->country=="India"){ echo "selected";}?>>{{$country->country}}</option>
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
                <input type="text" name="first_name" placeholder="Enter your first name" class="form-control" value="{{old('first_name')}}">
                @if($errors->has("first_name"))
                    <span class="alert alert-danger">{{$errors->first("first_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="last_name" class="col-md-2 col-form-label">Last Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="last_name" placeholder="Enter your last name" class="form-control" value="{{old('last_name')}}">
                @if($errors->has("last_name"))
                    <span class="alert alert-danger">{{$errors->first("last_name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="gender" class="col-md-2 col-form-label">Gender <span class="star">*</span></label>
            <div class="col-md-8">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="male">
                    <label for="male" class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="female" class="form-check-input">
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
                <input type="text" name="phone_number" placeholder="Enter your phone number" class="form-control" value="{{old('phone_number')}}">
                @if($errors->has("phone_number"))
                    <span class="alert alert-danger">{{$errors->first("phone_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="email" class="col-md-2 col-form-label">Email <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="email" placeholder="Enter your email id" class="form-control" value="{{old('email')}}">
                @if($errors->has("email"))
                    <span class="alert alert-danger">{{$errors->first("email")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="password" class="col-md-2 col-form-label">Password <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="password" name="password" placeholder="Enter your password" class="form-control" value="{{old('password')}}">
                <span class="d-block">Minimum 6 characters needed</span>
                <span class="d-block">Contains atleast one Upper case and one Lowercase letter.</span>
                @if($errors->has("password"))
                    <span class="alert alert-danger">{{$errors->first("password")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="profile_image" class="col-md-2 col-form-label">Profile Image <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="image" placeholder="upload image" class="form-control" value="{{old('image')}}"> 
                @if($errors->has("image"))
                    <span class="alert alert-danger">{{$errors->first("image")}}</span>
                @endif
            </div>
        </div>
    <!--    <div class="row form-group">
            <label for="aadhar_image" class="col-md-2 col-form-label">Aadhaar Image <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="adhar_image" placeholder="upload image" class="form-control" value="{{old('adhar_image')}}">
                @if($errors->has("adhar_image"))
                    <span class="alert alert-danger">{{$errors->first("adhar_image")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row form-group">
            <label for="aadhar_number" class="col-md-2 col-form-label">Aadhar Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="number" placeholder="Enter your aadhar number" class="form-control" value="{{old('number')}}">
                @if($errors->has("number"))
                    <span class="alert alert-danger">{{$errors->first("number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="date of birth" class="col-md-2 col-form-label">Date Of Birth <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="date" name="dob" placeholder="Enter your date of birth" class="form-control" value="{{old('dob')}}">
                @if($errors->has("dob"))
                    <span class="alert alert-danger">{{$errors->first("dob")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="license_number" class="col-md-2 col-form-label">License Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="license_number" placeholder="Enter your license number" class="form-control" value="{{old('license_number')}}">
                @if($errors->has("license_number"))
                    <span class="alert alert-danger">{{$errors->first("license_number")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="Id_proof" class="col-md-2 col-form-label">Id Proof <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="id_proof" placeholder="upload image" class="form-control" value="{{old('id_proof')}}">
                @if($errors->has("id_proof"))
                    <span class="alert alert-danger">{{$errors->first("id_proof")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="address" class="col-md-2 col-form-label">Adress <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="address" placeholder="Enter your address" class="form-control" >{{old('address')}}</textarea>
                @if($errors->has("address"))
                    <span class="alert alert-danger">{{$errors->first("address")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">Currency <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="currency" placeholder="Enter your currency" class="form-control" value="INR">
                @if($errors->has("currency"))
                    <span class="alert alert-danger">{{$errors->first("currency")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="daily" class="col-md-2 col-form-label">Daily <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="daily" id="" class="form-control">
                <option value="yes">Yes</option>
                <option value="no">No</option>
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
                <option value="yes">Yes</option>
                <option value="no">No</option>
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
                <option value="yes">Yes</option>
                <option value="no">No</option>
               </select>                
               @if($errors->has("outstation"))
                    <span class="alert alert-danger">{{$errors->first("outstation")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="commission" class="col-md-2 col-form-label">Commission <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="commission" placeholder="Enter your commission amount" class="form-control" value="{{old('commission')}}">
                @if($errors->has("commission"))
                    <span class="alert alert-danger">{{$errors->first("commission")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="commission_type" class="col-md-2 col-form-label">Commission Type <span class="star">*</span></label>
            <div class="col-md-8">
               <select name="commission_type" class="form-control">
                   <option value="">Select Commission Type</option>
                    <option value="percentage">Percentage</option>
                    <option value="fixed">Fixed</option>
               </select>                
               @if($errors->has("commission_type"))
                    <span class="alert alert-danger">{{$errors->first("commission_type")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="commission" class="col-md-2 col-form-label">Rating <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="rating" placeholder="Enter your rating" class="form-control" value="{{old('rating')}}">
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
              <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>

@endsection