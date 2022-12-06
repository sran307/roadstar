@extends("layouts.layout")
@section("title", "contact settings")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Contact Settings</h6>
        <a href="{{route('contact_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Phone Number</th>
                    <th>EMail</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($contacts as $contact)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$contact->phone_number}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->address}}</td>
                    <td class="sr_action">
                        <a href="{{route('contact_models.edit',[$contact->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('contact_models.destroy',[$contact->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection