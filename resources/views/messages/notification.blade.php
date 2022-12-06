@extends("layouts.layout")
@section("title", "messages")
@section("content")
<div class="container">
    <div class="my-4">
        <div class="sr_heading">
            <h6>Notification Messages</h6>
            <a href="{{route('notification_models.create')}}"><button class="btn btn-success">Add</button></a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Country</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1;?>
                    @foreach($messages as $message)
                    <tr>
                        <td><?php echo $x++; ?></td>
                        <td>
                            <?php
                                echo (App\Models\country::where("id", $message->country)->value("country"));
                            ?>
                        </td>
                        <td>
                            <?php
                                echo (App\Models\UserType::where("id", $message->type)->value("user"));
                            ?>
                        </td>
                        <td>{{$message->title}}</td>
                        <td>{{$message->message}}</td>
                        <td>{{$message->status}}</td>
                        <td class="sr_action">
                            <a href="{{route('notification_models.edit',[$message->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                            <form action="{{route('notification_models.destroy',[$message->id])}}" method="post" class="d-inline">
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
</div>


@endsection