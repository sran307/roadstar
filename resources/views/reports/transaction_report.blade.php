@extends("layouts.layout")
@section("title", "Transaction Report")
@section("content")
<div class="container sr_trip">
    <div class="sr_trans_head">
        <h5>Transaction Report</h5>
    </div>
    <div class="sr_trans_search">
        <form action="{{route('transaction_detail')}}" method="post" >
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
    <div class="sr_trip_body">
        <div class="row">
            <div class="table-responsive col-md-8">
                <table class="table table-bordered">
                    <tr id="cash_row">
                        <th>Total Earnings:</th>
                        <td> {{App\Models\TripRequest::where("payment_method", "Cash")->sum("subtotal")}}</td>
                    </tr>
                    <tr id="online_row" style="display:none">
                        <th>Total Earnings:</th>
                        <td> {{App\Models\TripRequest::where("payment_method", "Online")->sum("subtotal")}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="row form-group">
                    <label for="payment_method" class="col-md-4 col-form-label">Payment Method <span class="star">*</span></label>
                    <div class="col-md-8">
                        <select name="payment_method" id="payment_selector" class="form-control">
                            <option value="cash" selected>Cash</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Trip Code</th>
                    <th>Trip Date </th>
                    <th>Transaction Code</th>
                    <th>Customer Name</th>
                    <th>Customer No</th>
                    <th>Driver</th>
                    <th>Vehicle No</th>
                    <th>Trip Status</th>
                </tr>
            </thead>
            <tbody>
            @if(count($details)==0)
                <tr>
                    <td colspan="9" class="text-center">No Record Found.</td>
                </tr>
                @else
                @foreach($details as $detail)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$detail->booking_id}}</td>
                    <td>{{$detail->pickup_date}}</td>
                    <td>----</td>
                    <td>{{$detail->passanger_name}}</td>
                    <td>{{$detail->passanger_phone}}</td>
                    <td>{{ App\Models\Driver::where("id", App\Models\NewTrip::where("trip_id", $detail->id)->value("driver_id"))->value("first_name")}}</td>
                    <td>{{App\Models\NewTrip::where("trip_id", $detail->id)->value("vehicle_number")}}</td>
                    <td>{{$detail->status}}</td>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).on("change", "#payment_selector", function () {
        if($(this).val()=="cash"){
            $("#online_row").hide();
            $("#cash_row").show();
        }else{
            $("#online_row").show();
            $("#cash_row").hide();
        }
    });
</script>
@endsection