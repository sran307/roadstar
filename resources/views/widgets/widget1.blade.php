@extends("layouts.layout")
@section("title", "widget1")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Feature widget</h6>
       <!-- <a href="{{route('widget1_models.create')}}"><button class="btn btn-success" <?php if(count($widgets)>=4){echo ("disabled");}?>>New</button></a>-->
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Heading</th>
                    <th>Icon</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($widgets as $widget)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$widget->heading}}</td>
                    <td><img src="{{asset('images/icons/'.$widget->icon)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$widget->details}}</td>
                    <td>{{$widget->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('widget1_models.edit',[$widget->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                   <!--     <form action="{{route('widget1_models.destroy',[$widget->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger">Delete</button>
                        </form>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection