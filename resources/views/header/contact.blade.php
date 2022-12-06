@extends("layouts.layout")
@section("title", "headerContact")
@section("content")
<div class="container">
    <div class="my-4">
        <div class="sr_heading">
            <h6>Header Contacts</h6>
            <a href="{{route('header_contacts.create')}}"><button>Add</button></a>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl.no</th>
                            <th>Contact Name</th>
                            <th>Details</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=1;?>
                        @foreach($contacts as $contact)
                        <tr>
                            <td><?php echo $x++; ?></td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->details}}</td>
                            <td> <img src="{{asset('images/icons/'.$contact->icon)}}" width="50px" height="50px" alt="icon"></td>
                            <td>{{$contact->status}}</td>
                            <td class="sr_action">
                                <a href="{{route('header_contacts.edit',[$contact->id])}}"><button>Edit</button></a>
                                <form action="{{route('header_contacts.destroy',[$contact->id])}}" method="post" class="d-inline">
                                @csrf
                                @method("DELETE")
                                    <button onclick="return confirm('Are You Sure?')" type="submit"><i class="fas fa-trash-alt"></i></button>
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