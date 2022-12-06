@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Payment Histories </h6>
        <a href="{{route('payment_histories.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Trip</th>
                    <th>Mode</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($payments==null)
                <td colspan="5"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($payments as $payment)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$payment->trip_id}}</td>
                    <td>{{$payment->mode}}</td>
                    <td>{{$payment->amount}}</td>
                    <td class="sr_action">
                        <a href="{{route('payment_histories.edit',[$payment->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('payment_histories.destroy',[$payment->id])}}" method="post" class="d-inline">
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