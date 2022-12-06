@extends("layouts.layout")
@section("title", "services")
@section("content")
<div class="container">
    <div class='sr_heading'>
      <h6>Service Widget</h6>
        <a href="{{route('service_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Heading</th>
                    <th>Icon</th>
                    <th>Details</th>
                  <!--  <th>Button Icon</th>
                    <th>Button Url</th>
                    <th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$service->heading}}</td>
                    <td><img src="{{asset('images/icons/'.$service->images)}}" width="50px" height="50px" alt="images"></td>
                    <td><?php echo $service->details; ?></td>
               <!--     <td><img src="{{asset('images/icons/'.$service->button_icon)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$service->button_url}}</td>
                    <td>{{$service->status}}</td>-->
                    <td class="sr_action">
                        <a href="{{route('service_models.edit',[$service->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                       <form action="{{route('service_models.destroy',[$service->id])}}" method="post" class="d-inline">
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