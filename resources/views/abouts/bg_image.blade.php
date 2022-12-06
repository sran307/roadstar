@extends("layouts.layout")
@section("title", "background_image")
@section("content")
<div class="container">
    <div>
        <h6>Background Image Settings</h6>
        <a href="{{route('background_images.create')}}"><button>New</button></a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Background Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $image)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset('images/bg_images/'.$image->bg_image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$image->status}}</td>
                    <td>
                        <a href="{{route('background_images.edit',[$image->id])}}"><button>Edit</button></a>
                        <form action="{{route('background_images.destroy',[$image->id])}}" method="post" class="d-inline">
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