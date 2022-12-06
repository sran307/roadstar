@extends("layouts.layout")
@section("title", "Trip Report")
@section("content")
<div class="container sr_trip">
    <div class="sr_trip_head">
        <h5>Trip Report</h5>
    </div>
    <div class="sr_trip_search">
        <form action="{{route('trip_detail')}}" method="post" >
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
                    <tr>
                        <th>Total Trips Completed:</th>
                        <td>{{App\Models\TripRequest::where("status", "Completed")->count()}}</td>
                    </tr>
                    <tr>
                        <th>Total Earnings:</th>
                        <td> {{App\Models\TripRequest::sum("subtotal")}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="row form-group sr_trip_export">
                    <label for="to_date" class="col-md-2 col-form-label">Export</label>
                    <div class="col-md-6">
                        <button class="btn btn-primary" id="trip_csv">CSV</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="trip_table" >
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Trip Code</th>
                    <th>Trip Date </th>
                    <th>From Address</th>
                    <th>To Address</th>
                    <th>Customer Name</th>
                    <th>Customer No</th>
                    <th>Total KM</th>
                    <th>Amount</th>
                    <th>Driver</th>
                    <th>Vehicle No</th>
                    <th>Payment Status</th>
                    <th>Trip Status</th>
                </tr>
            </thead>
            <tbody>
                @if(count($details)==0)
                <tr>
                    <td colspan="13" class="text-center">No Record Found.</td>
                </tr>
                @else
                @foreach($details as $detail)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$detail->booking_id}}</td>
                    <td>{{$detail->pickup_date}}</td>
                    <td><?php if($detail->type=="airport_from"){echo $detail->airport;}?>
                        <?php if($detail->type=="airport_to"){echo $detail->from_address;}?>
                        <?php if($detail->type!="airport_from" && $detail->type!="airport_to"){echo $detail->from_address;}?></td>
                    <td><?php if($detail->type=="airport_from"){echo $detail->to_address;}?>
                        <?php if($detail->type=="airport_to"){echo $detail->airport;}?>
                        <?php if($detail->type!="airport_from" && $detail->type!="airport_to"){echo $detail->to_address;}?></td>
                    <td>{{$detail->passanger_name}}</td>
                    <td>{{$detail->passanger_phone}}</td>
                    <td>{{$detail->distance}}</td>
                    <td>{{$detail->subtotal}}</td>
                    <td>{{ App\Models\Driver::where("id", App\Models\NewTrip::where("trip_id", $detail->id)->value("driver_id"))->value("first_name")}}</td>
                    <td>{{App\Models\NewTrip::where("trip_id", $detail->id)->value("vehicle_number")}}</td>
                    <td>{{$detail->payment_status}}</td>
                    <td>{{$detail->status}}</td>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    $("#trip_csv").click(function (e) { 
        e.preventDefault();
        $("#trip_table").table2csv({
            filename: "trip_record.csv"
        });
    });
</script>
@endsection