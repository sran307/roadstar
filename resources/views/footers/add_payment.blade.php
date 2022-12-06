@extends("layouts.layout")
@section("title", "add_payment_logo")
@section("content")
<div class="container">
<form action="{{route('footer_payments.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Footer Payment Logo</legend>
        <div class="row form-group">
            <label for="logo" class="col-md-2 col-form-label">Logo <span class="star">*</span></label>
            <div class="col-md-8"> 
                <input type="file" name="logo" placeholder="upload logo" class="form-control"> 
                @if($errors->has("logo"))
                    <span class="alert alert-danger">{{$errors->first("logo")}}</span>
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
               <input type="submit" value="save">
            </div>
        </div>
    </form>
</div>
@endsection