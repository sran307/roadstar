@extends("layouts.layout")
@section("title", "package")
@section("content")
<div class="container">
    @foreach($packages as $package)
    <form action="{{route('package_models.update', [$package->id])}}" method="post" >
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Package</legend>
        <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Package Name <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="name" placeholder="Enter your package name" class="form-control" value="{{$package->name}}">
                @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>       
        <div class="row form-group">
            <label for="hours" class="col-md-2 col-form-label">Hours <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="hours" placeholder="Enter your hours" class="form-control" value="{{$package->hours}}">
                @if($errors->has("hours"))
                    <span class="alert alert-danger">{{$errors->first("hours")}}</span>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <label for="kilometers" class="col-md-2 col-form-label">Kilometers <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="kilometers" placeholder="Enter kilometer" class="form-control" value="{{$package->kilometers}}">
                @if($errors->has("kilometers"))
                    <span class="alert alert-danger">{{$errors->first("kilometers")}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 text-center">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>

@endsection
