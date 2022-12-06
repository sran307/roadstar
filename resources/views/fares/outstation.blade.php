@extends("layouts.layout")
@section("title", "outstationfares")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Outstation Fare Management</h6>
        <a href="{{route('outstation_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>country</th>
                    <th>Vehicle type</th>
                    <th>Base Fare</th>
                    <th>Base Fare Cover KM</th>
                    <th>Price Per KM</th>
                    <th>Driver Allowance</th>
                    <th>Toll & Nighthalt</th>
                    <th>Trip Type</th>
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
                            echo (App\Models\ManageModel::where("id", $fare->vehicle_type)->value("model_name"));
                        ?>
                    </td>
                    <td>{{$fare->base_fare}}</td>
                    <td>{{$fare->base_fare_km}}</td>
                    <td>{{round($fare->base_fare / $fare->base_fare_km)}}</td>
                    <td>{{$fare->allowance!=""?$fare->allowance : "Not Set"}}</td>
                    <td>{{$fare->extra_charge!=''? $fare->extra_charge : "Not Set"}}</td>
                    <td>{{$fare->type}}</td>
                    <td>{{$fare->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('outstation_models.edit',[$fare->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('outstation_models.destroy',[$fare->id])}}" method="post" class="d-inline">
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