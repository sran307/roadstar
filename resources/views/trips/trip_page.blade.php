@extends("layouts.layout")
@section("title", "trip settings")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Trip Settings</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Admin Commission</th>
                    <th>Maximum searching Time</th>
                    <th>Booking Searching Radius</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($trips as $trip)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$trip->commision}}</td>
                    <td>{{$trip->time}}</td>
                    <td>{{$trip->radius}}</td>
                    <td class="sr_action">
                        <a href="{{route('trip_edit',[$trip->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection