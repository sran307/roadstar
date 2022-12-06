@extends("layouts.layout")
@section("title", "country")
@section("content")
<div class="container">
<form action="{{route('countries.store')}}" method="post">
    @csrf
        <legend class="col-form-label">Add Country</legend>
        <div class="row form-group">
            <label for="country" class="col-md-2 col-form-label">Country <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Country" name="country" class="form-control" value="{{old('country')}}">             
               @if($errors->has("country"))
                    <span class="alert alert-danger">{{$errors->first("country")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="currency" class="col-md-2 col-form-label">Currency <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Currency" name="currency" class="form-control" value="{{old('currency')}}">             
               @if($errors->has("currency"))
                    <span class="alert alert-danger">{{$errors->first("currency")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="code" class="col-md-2 col-form-label">Phone Code <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Phone Code" name="phone_code" class="form-control" value="{{old('phone_code')}}">             
               @if($errors->has("phone_code"))
                    <span class="alert alert-danger">{{$errors->first("phone_code")}}</span>
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
