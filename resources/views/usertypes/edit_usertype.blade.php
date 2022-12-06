@extends("layouts.layout")
@section("title", "usertypes")
@section("content")
<div class="container">
    <div>
        <h6>Edit User Type </h6>
        @foreach($usertypes as $usertype)
        <form action="{{route('user_types.update', [$usertype->id])}}" method="post">
            @csrf
            @method("put")
            <div class="row form-group">
                <label for="user_type" class="col-md-2 col-form-label">User Type <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="User Type" name="user_type" class="form-control" value="{{$usertype->user}}">             
                @if($errors->has("user_type"))
                        <span class="alert alert-danger">{{$errors->first("user_type")}}</span>
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