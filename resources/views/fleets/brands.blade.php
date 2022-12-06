@extends("layouts.layout")
@section("title", "manage_brands")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Manage Brands</h6>
        <a href="{{route('manage_brands.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Brand Code</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$brand->code}}</td>
                    <td>{{$brand->brand_name}}</td>
                    <td>{{$brand->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('manage_brands.edit',[$brand->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('manage_brands.destroy',[$brand->id])}}" method="post" class="d-inline">
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