@extends("layouts.layout")
@section("title", "City")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Cities </h6>
        <a href="{{route('city_trips.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>From City</th>
                    <th>Drop City</th>
                    <th>Distance In KM</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($cities as $city)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$city->from_address}}</td>
                    <td>{{$city->to_address}}</td>
                    <td>{{$city->distance}}</td>
                    <td>{{$city->type}}</td>
                    <td>{{$city->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('city_trips.edit',[$city->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('city_trips.destroy',[$city->id])}}" method="post" class="d-inline">
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