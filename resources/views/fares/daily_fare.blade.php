@extends("layouts.layout")
@section("title", "daily-fares")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Daily Fare</h6>
        <a href="{{route('daily_fares.create')}}"><button class="btn btn-success">New</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>country</th>
                    <th>Vehicle type</th>
                    <th>Base Fare</th>
                    <th>Extra KM Price</th>
                    <th>Extra Hr Price</th>
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
                    <td>{{$fare->price_per_km}}</td>
                    <td>{{$fare->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('daily_fares.edit',[$fare->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('daily_fares.destroy',[$fare->id])}}" method="post" class="d-inline">
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