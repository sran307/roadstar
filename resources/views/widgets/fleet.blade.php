@extends("layouts.layout")
@section("title", "fleets")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Fleet Widgets</h6>
      <!--  <a href="{{route('fleet_models.create')}}"><button>New</button></a>-->
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Fleet Name</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Speed</th>
                    <th>Rating</th>
                    <th>Passengers</th>
                    <th>Amount Per Day</th>
                    <th>Button Name</th>
                    <th>Button Url</th>
                   <!-- <th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fleets as $fleet)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fleet->name}}</td>
                    <td><img src="{{asset('images/fleets/'.$fleet->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$fleet->type}}</td>
                    <td>{{$fleet->speed}}</td>
                    <td>{{$fleet->rating}}</td>
                    <td>{{$fleet->passengers}}</td>
                    <td>{{$fleet->amount_per_day}}</td>
                    <td>{{$fleet->button_name}}</td>
                    <td>{{$fleet->button_url}}</td>
                  <!--  <td>{{$fleet->status}}</td>-->
                    <td class="sr_action">
                        <a href="{{route('fleet_models.edit',[$fleet->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                   <!--     <form action="{{route('fleet_models.destroy',[$fleet->id])}}" method="post" class="d-inline">
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