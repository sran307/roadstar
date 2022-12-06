@extends("layouts.layout")
@section("title", "widget3")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Security widgets</h6>
        <!--<a href="{{route('widget3_models.create')}}"><button>New</button></a>-->
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Heading</th>
                    <th>Details</th>
                    <th>Button Name</th>
                    <th>Button Url</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($widgets as $widget)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$widget->heading}}</td>
                    <td>{{$widget->details}}</td>
                    <td>{{$widget->button_name}}</td>
                    <td>{{$widget->button_url}}</td>
                    <td class="sr_action">
                        <a href="{{route('widget3_models.edit',[$widget->id])}}"><button><i class="fa fa-edit"></i></button></a>
                        <!--<form action="{{route('widget3_models.destroy',[$widget->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit">Delete</button>
                        </form> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection