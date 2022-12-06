@extends("layouts.layout")
@section("title", "footer_logo")
@section("content")
<div class="container">
    <div>
        <h6>Footer Logo settings</h6>
        <a href="{{route('footer_links.create')}}"><button>New</button></a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Url Name</th>
                 <!--   <th>Icon</th>-->
                    <th>Url Link</th>
                  <!--  <th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($links as $link)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$link->name}}</td>
                  <!--  <td><img src="{{asset('images/icons/'.$link->icon)}}" width="50px" height="50px" alt="images"></td>-->
                    <td>{{$link->link}}</td>
                    <td>{{$link->status}}</td>
                    <td>
                        <a href="{{route('footer_links.edit',[$link->id])}}"><button>Edit</button></a>
                        <form action="{{route('footer_links.destroy',[$link->id])}}" method="post" class="d-inline">
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