@extends("layouts.layout")
@section("title", "vehicles")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6> Vehicle Categories</h6>
        <a href="{{route('vehicle_managements.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Vehicle Type</th>
                    <th>Base Fare</th>
                    <th>Price Per KM</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($vehicles as $vehicle)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>
                        <?php
                            echo(App\Models\country::where("id", $vehicle->id)->value("country"));
                        ?>
                    </td>
                    <td>{{$vehicle->vehicle_type}}</td>
                    <td>{{$vehicle->fare}}</td>
                    <td>{{$vehicle->price_km}}</td>
                    <td>{{$vehicle->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('vehicle_managements.edit',[$vehicle->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection