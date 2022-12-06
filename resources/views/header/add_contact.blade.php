@extends("layouts.layout")
@section("title", "headerContact")
@section("content")
<div class="container">
<form action="{{route('header_contacts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <legend class="col-form-label">Add Header Contacts</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Contact Name <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Contact name" name="name" class="form-control" value="{{old('name')}}">             
               @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="details" class="col-md-2 col-form-label">Details <span class="star">*</span></label>
            <div class="col-md-8">
                <textarea name="details" placeholder="Details" class="form-control"> {{old('details')}}</textarea> 
                @if($errors->has("details"))
                    <span class="alert alert-danger">{{$errors->first("details")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="icon" class="col-md-2 col-form-label">Icon <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="file" name="icon" placeholder="upload icon" class="form-control" value="{{old('icon')}}"> 
                @if($errors->has("icon"))
                    <span class="alert alert-danger">{{$errors->first("icon")}}</span>
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
