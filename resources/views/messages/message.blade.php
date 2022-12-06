@extends("layouts.layout")
@section("title", "messages")
@section("content")
<div class="container">
    <div>
        <h6>Add Messages </h6>
        <form action="{{route('message_models.store')}}" method="post">
            @csrf
            <div class="row form-group">
                <label for="code" class="col-md-2 col-form-label">Code <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="code" name="code" class="form-control" value="{{old('code')}}">             
                @if($errors->has("code"))
                        <span class="alert alert-danger">{{$errors->first("code")}}</span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="message" class="col-md-2 col-form-label">Message <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="message" name="message" class="form-control" value="{{old('message')}}">             
                @if($errors->has("message"))
                    <span class="alert alert-danger">{{$errors->first("message")}}</span>
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
    <div class="my-4">
        <div>
            <h6>Manage Messages</h6>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Code</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($messages as $message)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$message->code}}</td>
                    <td>{{$message->message}}</td>
                    <td>
                        <a href="{{route('message_models.edit',[$message->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('message_models.destroy',[$message->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection