@extends("layouts.layout")
@section("title", "wallet_settings")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Customer Wallet Histories</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>Amount</th>
                    <th>Transaction Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($data==null)
                <td colspan="8"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($data as $value)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$value->country}}</td>
                    <td>{{$value->customer}}</td>
                    <td>{{$value->type}}</td>
                    <td>{{$value->message}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->transaction}}</td>
                    <td class="sr_action">
                        <a href="{{route('feature_settings.edit',[$feature->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('feature_settings.destroy',[$feature->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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