@extends("layouts.layout")
@section("title", "customer sos")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Customer SOS Contacts</h6>
        <a href="{{route('sos_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Customer</th>
                    <th> Name</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($customers as $customer)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>
                        <?php
                            echo (App\Models\Customer::where("id", $customer->customer_id)->value("customer_first_name"));
                        ?>
                    </td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->phone_number}}</td>
                    <td>{{$customer->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('sos_models.edit',[$customer->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection