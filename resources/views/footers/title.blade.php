@extends("layouts.layout")
@section("title", "title")
@section("content")
<div class="container">
    <div>
        <h6>Footer Titles</h6>
    <!--    <a href="{{route('footer_titles.create')}}"><button>New</button></a>-->
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Title</th>
                   <!-- <th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($titles as $title)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$title->title}}</td>
                 <!--   <td>{{$title->status}}</td>-->
                    <td>
                        <a href="{{route('footer_titles.edit',[$title->id])}}"><button>Edit</button></a>
                     <!--   <form action="{{route('footer_titles.destroy',[$title->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit">Delete</button>
                        </form>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection