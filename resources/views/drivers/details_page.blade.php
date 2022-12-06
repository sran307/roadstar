@extends("layouts.layout")
@section("title", "bank-details-page")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Driver Bank & Kyc Verfication Details</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Driver Name</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>Aadhar Number</th>
                    <th>Pan Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($data==null)
                <td colspan="9"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($data as $value)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$value->driver}}</td>
                    <td>{{$value->bank}}</td>
                    <td>{{$value->account_number}}</td>
                    <td>{{$value->ifsc_code}}</td>
                    <td>{{$value->adhar_number}}</td>
                    <td>{{$value->pan_number}}</td>
                    <td>{{$value->status}}</td>
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