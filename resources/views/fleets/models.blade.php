@extends("layouts.layout")
@section("title", "model_management")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Model Management</h6>
        <a href="{{route('manage_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Model No</th>
                    <th>Model Name</th>
                    <th>Brand</th>
                    <th>Year</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$model->model_number}}</td>
                    <td>{{$model->model_name}}</td>
                    <td><?php 
                            echo(App\Models\ManageBrand::where("id",$model->brand)->value("brand_name"));
                        ?>
                    </td>
                    <td>{{$model->year}}</td>
                    <td><img src="{{asset('images/fleets/'.$model->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$model->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('manage_models.edit',[$model->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('manage_models.destroy',[$model->id])}}" method="post" class="d-inline">
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