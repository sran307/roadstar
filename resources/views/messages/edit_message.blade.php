@extends("layouts.layout")
@section("title", "messages")
@section("content")
<div class="container">
    <div>
        <h6>Edit Messages </h6>
        @foreach($messages as $message)
        <form action="{{route('message_models.update', [$message->id])}}" method="post">
            @csrf
            @method("put")
            <div class="row form-group">
                <label for="code" class="col-md-2 col-form-label">Code <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="code" name="code" class="form-control" value="{{$message->code}}">             
                @if($errors->has("code"))
                        <span class="alert alert-danger">{{$errors->first("code")}}</span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="message" class="col-md-2 col-form-label">Message <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="message" name="message" class="form-control" value="{{$message->message}}">             
                @if($errors->has("message"))
                    <span class="alert alert-danger">{{$errors->first("message")}}</span>
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