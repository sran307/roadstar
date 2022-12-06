@extends("layouts.layout")
@section("title", "footer_service")
@section("content")
<div class="container">
    <div>
        <h6>Footer Service settings</h6>
        <a href="{{route('footer_services.create')}}"><button>New</button></a>
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
                @foreach($services as $service)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$service->name}}</td>
                    <td><img src="{{asset('images/icons/'.$service->icon)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$service->link}}</td>
                    <td>{{$service->status}}</td>
                    <td>
                        <a href="{{route('footer_services.edit',[$service->id])}}"><button>Edit</button></a>
                        <form action="{{route('footer_services.destroy',[$service->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection