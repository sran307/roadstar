@extends("layouts.layout")
@section("title", "cancel settings")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Cancel Settings</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Number Of Free Cancellation</th>
                    <th>Cancellation Charge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($details as $detail)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$detail->number}}</td>
                    <td>{{$detail->charge}}</td>
                    <td class="sr_action">
                        <a href="{{route('cancel_edit',[$detail->id])}}"> <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection