@extends("layouts.layout")
@section("title", "additional-fares")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Additional Fare Kilometers</h6>
        <a href="{{route('fare_models.create')}}"><button class="btn btn-success">New</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Vehicle_type</th>
                    <th>Fare Per KM</th>
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
                            echo (App\Models\VehicleManagement::where("id", $fare->vehicle_type)->value("vehicle_type"));
                        ?>
                    </td>
                    <td>{{$fare->fare_per_km}}</td>
                    <td class="sr_action">
                        <a href="{{route('fare_models.edit',[$fare->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('fare_models.destroy',[$fare->id])}}" method="post" class="d-inline">
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