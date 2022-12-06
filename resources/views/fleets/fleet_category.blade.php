@extends("layouts.layout")
@section("title", "fleet_category")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Fleet Category</h6>
        <a href="{{route('fleet_categories.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Category Code</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$category->code}}</td>
                    <td>{{$category->name}}</td>
                    <td><img src="{{asset('images/fleets/'.$category->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$category->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('fleet_categories.edit',[$category->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('fleet_categories.destroy',[$category->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection