@extends("layouts.layout")
@section("title", "Driver Report")
@section("content")
<div class="container sr_trip">
    <div class="sr_driver_head">
        <h5>Driver Report</h5>
    </div>
    <div class="sr_driver_search">
        <form action="{{route('driver_detail')}}" method="post" >
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="row form-group">
                        <label for="from_date" class="col-md-4 col-form-label">From Date <span class="star">*</span></label>
                        <div class="col-md-8">
                            <input type="date" name="from_date" class="form-control" value="<?php if($from_date==null){echo date('Y-m-d');}else{echo $from_date;}?>">             
                            @if($errors->has("from_date"))
                                <span class="alert alert-danger">{{$errors->first("from_date")}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row form-group">
                        <label for="to_date" class="col-md-4 col-form-label">To Date <span class="star">*</span></label>
                        <div class="col-md-8">
                            <input type="date" name="to_date" class="form-control" value="<?php if($to_date==null){echo date('Y-m-d');}else{echo $to_date;}?>">             
                            @if($errors->has("to_date"))
                                <span class="alert alert-danger">{{$errors->first("to_date")}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 sr_trip_button">
                    <div class="row">
                        <div class="col-md-10 text-center">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="sr_driver_select">
        <div class="row form-group">
            <label for="to_date" class="col-md-3 col-form-label">Select A Driver <span class="star">*</span></label>
            <div class="col-md-4">
                <select name="" id="driver_selector" class="form-control">
                    <option value="">Select a driver</option>
                    @foreach($drivers as $driver)
                    <option value="{{$driver->id}}">{{$driver->first_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="sr_trip_body">
        <div class="row">
            <div class="table-responsive col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th>Driver Name:</th>
                        <td id="name">Not Selected</td>
                    </tr>
                    <tr>
                        <th>Contact No:</th>
                        <td id="number">Not Selected</td>
                    </tr>
                    <tr>
                        <th>Vehicle No:</th>
                        <td id="vehicle">Not Selected </td>
                    </tr>
                    <tr>
                        <th>Vehicle Type:</th>
                        <td id="type">Not selected </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="row form-group sr_trip_export">
                    <label for="to_date" class="col-md-2 col-form-label">Export</label>
                    <div class="col-md-6">
                        <button class="btn btn-primary" id="driver_csv">CSV</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="driver_table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Trip Code</th>
                    <th>From Address</th>
                    <th>To Address</th>
                    <th>Amount</th>
                    <th>Trip Status</th>
                    <th>Payment Status</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                @if(count($details)==0)
                <tr>
                    <td colspan="8" class="text-center">No Record Found.</td>
                </tr>
                @else
                @foreach($details as $detail)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{App\Models\TripRequest::where("id", $detail->trip_id)->value("booking_id")}}</td>
                    <td>{{$detail->pickup_address}}</td>
                    <td>{{$detail->drop_address}}</td>
                    <td>{{$detail->subtotal}}</td>
                   <td>{{$detail->status}}</td>
                    <td>{{App\Models\TripRequest::where("id", $detail->trip_id)->value("payment_status")}}</td>
                    <td><?php $star=App\Models\ReviewModel::where("trip_id", $detail->trip_id)->value("star");
                        for($i=0; $i<=$star; $i++){
                            echo ("<i class='fas fa-star'></i>");
                        }
                    ?></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).on("change","#driver_selector", function () {
    var id=$(this).val();
    $.ajax({
        type: "post",
        url: "{{route('driver_select')}}",
        data: {id: id, "_token": "{{ csrf_token() }}"},
        dataType: "json",
        success: function (response) {
            if(response.status.length>0){
                $.each(response.status, function (key, value) { 
                    $("#name").text(value.first_name);
                    $("#number").text(value.phone_number);
                    $("#vehicle").text(value.vehicle_number);
                    $("#type").text(value.vehicle_type);
                });
            }else{
                $("#name").text("Not Assigned");
                    $("#number").text("Not Assigned");
                    $("#vehicle").text("Not Assigned");
                    $("#type").text("Not Assigned");
            }
        }
    });
});
</script>
<script>
    $("#driver_csv").click(function (e) { 
        e.preventDefault();
        $("#driver_table").table2csv({
            filename: "driver_record.csv"
        });
    });
</script>
@endsection