@extends("layouts.layout")
@section("title", "package")
@section("content")
<div class="container">
<form action="{{route('package_models.store')}}" method="post" >
    @csrf
        <legend class="col-form-label">Add Package</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Package Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter your package name" class="form-control" value="{{old('name')}}">
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>       
        <div class="row form-group">
            <label for="hours" class="col-md-2 col-form-label">Hours <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="hours" placeholder="Enter your hours" class="form-control" value="{{old('hours')}}">
                @if($errors->has("hours"))
                    <span class="alert alert-danger">{{$errors->first("hours")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="kilometers" class="col-md-2 col-form-label">Kilometers <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="kilometers" placeholder="Enter kilometer" class="form-control" value="{{old('kilometers')}}">
                @if($errors->has("kilometers"))
                    <span class="alert alert-danger">{{$errors->first("kilometers")}}</span>
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
