@extends("layouts.layout")
@section("title", "title")
@section("content")
<div class="container">
    <div class="sr_heading">
       <h6>Titles</h6>
        <a href="{{route('heading_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($titles as $title)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$title->main_heading}}</td>
                    <td>{{$title->sub_heading}}</td>
                   <!--  <td>{{$title->status}}</td> -->
                    <td class="sr_action">
                        <a href="{{route('heading_models.edit',[$title->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                       <!-- <form action="{{route('heading_models.destroy',[$title->id])}}" method="post" class="d-inline">
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