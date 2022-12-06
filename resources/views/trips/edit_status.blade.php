@extends("layouts.layout")
@section("title", "edit_trip_request_status")
@section("content")
<div class="container">
    <div>
        <h6>Trip Request Status </h6>
    </div>
    <div>
        <h6>Edit Trip Request Status</h6>
        @foreach($statuses as $status)
        <form action="{{route('status_models.update', [$status->id])}}" method="post">
            @csrf
            @method("PUT")
            <div class="row form-group">
                <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="status" placeholder="Enter status name" class="form-control" value="{{$status->status}}">
                    @if($errors->has("status"))
                        <span class="alert alert-danger">{{$errors->first("status")}}</span>
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
</div>


@endsection