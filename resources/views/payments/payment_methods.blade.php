@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Payment Methods </h6>
        <a href="{{route('payment_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Payment</th>
                    <th>Payment Type</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($payments==null)
                <td colspan="7"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($payments as $payment)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>
                        <?php
                            echo (App\Models\country::where("id", $payment->country)->value("country"));
                        ?>
                    </td>
                    <td>{{$payment->payment}}</td>
                    <td>{{$payment->payment_type}}</td>
                    <td><img src="{{asset('images/icons/'.$payment->icon)}}" width="50px" height="50px" alt=""></td>
                    <td>{{$payment->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('payment_models.edit',[$payment->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('payment_models.destroy',[$payment->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection