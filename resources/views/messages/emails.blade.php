@extends("layouts.layout")
@section("title", "emails")
@section("content")
<div class="container">
    <div class="sr_heading">
        <div>
            <h6>Emails</h6>
           <!-- <a href="{{route('notification_models.create')}}"><button>Add</button></a>-->
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1;?>
                    @foreach($emails as $email)
                    <tr>
                        <td><?php echo $x++; ?></td>
                        <td>{{$email->name}}</td>
                        <td>{{$email->email}}</td>
                        <td>{{$email->subject}}</td>
                        <td>{{$email->message}}</td>
                        <td class="sr_action">
                           <!-- <a href="{{route('email_details.edit',[$email->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>-->
                            <form action="{{route('email_details.destroy',[$email->id])}}" method="post" class="d-inline">
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