@extends("layouts.layout")
@section("title", "status")
@section("content")
<div class="container">
    @foreach($statuses as $status)
<form action="{{route('status_models.update', [$status->id])}}" method="post">
    @csrf
    @method("put")
        <legend class="col-form-label">Edit Driver Trip Status</legend>
        <div class="row form-group">
            <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Status" name="status" class="form-control" value="{{$status->status}}">             
               @if($errors->has("status"))
                    <span class="alert alert-danger">{{$errors->first("status")}}</span>
                @endif
            </div>
        </div>
       <!-- <div class="row form-group">
            <label for="name" class="col-md-2 col-form-label">Customer Status Name <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" placeholder="Customer status name" name="name" class="form-control" value="{{$status->name}}">             
               @if($errors->has("name"))
                    <span class="alert alert-danger">{{$errors->first("name")}}</span>
                @endif
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-10 text-center">
                 <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    @endforeach
</div>

@endsection
