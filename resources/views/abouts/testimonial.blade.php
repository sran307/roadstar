@extends("layouts.layout")
@section("title", "testimonials")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Testimonials</h6>
        <a href="{{route('testimonial_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset('images/profile_image/'.$model->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$model->name}}</td>
                    <td>{{$model->rating}}</td>
                    <td>{{$model->description}}</td>
                    <td>{{$model->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('testimonial_models.edit',[$model->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></i></button></a>
                        <form action="{{route('testimonial_models.destroy',[$model->id])}}" method="post" class="d-inline">
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