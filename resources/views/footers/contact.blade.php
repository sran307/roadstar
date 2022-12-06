@extends("layouts.layout")
@section("title", "footer_contact")
@section("content")
<div class="container">
    <div>
        <h6>Footer Contact Settings</h6>
        <a href="{{route('footer_contacts.create')}}"><button>New</button></a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Url Name</th>
                    <th>Icon</th>
                    <th>Url Link</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$contact->name}}</td>
                    <td><img src="{{asset('images/icons/'.$contact->icon)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$contact->link}}</td>
                    <td>{{$contact->status}}</td>
                    <td>
                        <a href="{{route('footer_contacts.edit',[$contact->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('footer_contacts.destroy',[$contact->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger" onclick="return confirm('Are You Sure?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection