@extends("layouts.layout")
@section("title", "slider_setting")
@section("content")
<div class="container">
    <div class="sr_heading">
       <h6>Sliders</h6>
       <a href="{{route('slider_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Heading 1</th>
                    <th>Heading 2</th>
                    <th>Images</th>
                    <th>Button Name</th>
                    <th>Button Url</th>
                    <th>Status</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$slider->heading1}}</td>
                    <td>{{$slider->heading2}}</td>
                    <td><img src="{{asset('images/slider_image/'.$slider->images)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$slider->button_name}}</td>
                    <td>{{$slider->button_url}}</td>
                    <td>{{$slider->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('slider_models.edit',[$slider->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                      <form action="{{route('slider_models.destroy',[$slider->id])}}" method="post">
                        @csrf
                        @method("DELETE")
                            <button class="btn btn-danger" onclick="return confirm('Are You Sure?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection