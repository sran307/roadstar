@extends("layouts.layout")
@section("title", "aboutwidget")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>About widget settings</h6>
        <!--<a href="{{route('about_widgets.create')}}"><button>New</button></a>-->
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Heading</th>
                    <th>Icon</th>
                    <th>Description 1</th>
                    <th>Description 2</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($widgets as $widget)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$widget->title}}</td>
                    <td><img src="{{asset('images/icons/'.$widget->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$widget->details}}</td>
                    <td>{{$widget->detail2}}</td>
                    <td class="sr_action">
                        <a href="{{route('about_widgets.edit',[$widget->id])}}"><button>Edit</button></a>
                        <!--<form action="{{route('about_widgets.destroy',[$widget->id])}}" method="post" class="d-inline">
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