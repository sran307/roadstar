@extends("layouts.layout")
@section("title", "vehicles")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6> Driver Vehicles</h6>
        <a href="{{route('add_vehicles')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Driver</th>
                    <th>Vehicle Type</th>
                    <th>Brand</th>
                    <th>Color</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($vehicles as $vehicle)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$vehicle->country}}</td>
                    <td>
                        <?php
                        $id=$vehicle->driver_id;
                        echo (App\Models\Driver::where("id", $id)->value("first_name"));
                        ?>
                    </td>
                    <td>{{$vehicle->vehicle_type}}</td>
                    <td>{{$vehicle->brand}}</td>
                    <td>{{$vehicle->color}}</td>
                    <td>{{$vehicle->vehicle_name}}</td>
                    <td>{{$vehicle->vehicle_number}}</td>
                    <td>{{$vehicle->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('edit_vehicles',[$vehicle->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection