@extends("layouts.layout")
@section("title", "socail_icons")
@section("content")
<div class="container">
    <div>
        <h6>Social Media Icons</h6>
        <a href="{{route('social_icons.create')}}"><button>New</button></a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Icon</th>
                    <th>Url</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($icons as $icon)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset('images/icons/'.$icon->icon)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$icon->link}}</td>
                    <td>{{$icon->status}}</td>
                    <td>
                        <a href="{{route('social_icons.edit',[$icon->id])}}"><button>Edit</button></a>
                        <form action="{{route('social_icons.destroy',[$icon->id])}}" method="post" class="d-inline">
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