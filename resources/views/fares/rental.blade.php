@extends("layouts.layout")
@section("title", "rentalfares")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Rental Fare Management</h6>
        <a href="{{route('rental_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>country</th>
                    <th>Vehicle type</th>
                    <th>Package Id</th>
                    <th>Price Per KM</th>
                    <th>Price Per Hour</th>
                    <th>Package Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $x=1;?>
                @foreach($fares as $fare)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>
                        <?php
                            echo (App\Models\country::where("id", $fare->country)->value("country"));
                        ?>
                    </td>
                    <td>
                        <?php
                            echo (App\Models\VehicleManagement::where("id", $fare->vehicle_type)->value("vehicle_type"));
                        ?>
                    </td>
                    <td>
                        <?php 
                            echo(App\Models\PackageModel::where("id", $fare->package_id)->value("name"));
                        ?>
                    </td>
                    <td>{{$fare->price_per_km}}</td>
                    <td>{{$fare->price_per_hour}}</td>
                    <td>{{$fare->package_price}}</td>
                    <td>{{$fare->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('rental_models.edit',[$fare->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection