@extends("layouts.layout")
@section("title", "driver_recharge")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Driver Recharges</h6>
        <a href="{{route('driver_recharges.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Driver Name</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recharges as $recharge)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <?php
                            echo(App\Models\Driver::where("id", $recharge->driver)->value("first_name")." ".App\Models\Driver::where("id", $recharge->driver)->value("last_name"));
                        ?>
                    </td>
                    <td>{{$recharge->amount}}</td>
                    <td class="sr_action">
                        <a href="{{route('driver_recharges.edit',[$recharge->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('driver_recharges.destroy',[$recharge->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection