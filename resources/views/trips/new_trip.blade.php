@extends("layouts.layout")
@section("title", "trips")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Trips</h6>
        <a href="{{route('new_trips.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="row sr_search_row">
        <div class="sr_search">
            <label for="search">Search (By Phone Nmber):</label>
            <input type="number" id="trip_phone_search"> 
            <label for="search">Search (By Date):</label>
            <input type="date" id="trip_date_search" value="<?php echo date('Y-m-d');?>"> 
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Trip Id</th>
                    <th>Customer Name</th>
                    <th>Driver Name</th>
                    <th>Phone Number</th>
                    <th>Vehicle_number</th>
                    <th>Payment Method</th>
                    <th>Subtotal</th>
                    <th>Discount</th>
                    <th>Total Fare</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $x=1;?>
                @foreach($trips as $trip)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$trip->trip_id}}</td>
                    <td>{{$trip->con_pass_name}}</td>
                    <td>
                        <?php
                            echo (App\Models\Driver::where("id", $trip->driver_id)->value("first_name"));
                        ?>
                    </td>
                    <td>{{$trip->phone_number}}</td>
                    <td>
                        <?php
                            echo(App\Models\DriverVehicle::where("driver_id", $trip->driver_id)->value("vehicle_number"));
                        ?>
                    </td>
                    <td>{{$trip->payment_method}}</td>
                    <td>{{$trip->subtotal}}</td>
                    <td>{{$trip->discount}}</td>
                    <td>{{$trip->fare}}</td>
                     <td><?php
                            echo (App\Models\Driver::where("id", $trip->driver_id)->value("rating"));
                        ?>
                    </td>
                    <td>{{$trip->status}}</td>
                    <td class="sr_action">
                        <button class="btn btn-primary" id="assign_driver_button" value="{{$trip->id}}" data-placement="left" title="Assign Driver" data-toggle="modal" data-target="#driver_modal"><i class="fas fa-users"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="sr_paginator">
    {{ $trips->links() }}
    </div>
</div>
<!------------------------------------Modal for driver assigning-------------------------------->
<!-- Modal -->
<div class="modal fade" id="driver_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign A Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Driver <span class="star">*</span></label>
            <div class="col-md-8">
               <select id="driver_selector" class="form-control">
                   <option value="">Select a driver</option>
                   @foreach($drivers as $driver)
                    <option value="{{$driver->id}}">{{$driver->first_name}}</option>
                    @endforeach
               </select>                
            </div>
        </div>
        <form action="{{route('assign_driver')}}" method="post" id="driver_modal">
            @csrf
            <input type="hidden" name="id" id="trip_id_field">
            <input type="hidden" name="driver" id="driver_id">
           
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Driver Name <span class="star">*</span></label>
            <div class="col-md-8">
               <input type="text" id="driver_name" class="form-control" readonly>           
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Contact No <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" id="driver_phone" class="form-control" readonly>                   
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Vehicle Number <span class="star">*</span></label>
            <div class="col-md-8">
                <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" readonly>                       
            </div>
        </div>
      <!--  <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Vehicle Type <span class="star">*</span></label>
            <div class="col-md-8">
            <input type="text" id="vehicle_type" class="form-control" readonly>                      
            </div>
        </div>
        <div class="row form-group">
            <label for="type" class="col-md-2 col-form-label">Driver Image<span class="star">*</span></label>
            <div class="col-md-8">
                <img src="" alt="">                     
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-10 text-center">
               <button class="btn btn-primary" type="submit">Assign Driver</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!---------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function () {
        //search by phone number
        $("#trip_phone_search").keyup(function (e) { 
            var id=$(this).val();
            $.ajax({
                type: "post",
                url: "{{route('trip_phone_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                   // console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=13 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td>"+x+++"</td>\
                                <td>"+item.trip_id+"</td>\
                                <td>"+item.customer_first_name+"</td>\
                                <td>"+item.first_name+"</td>\
                                <td>"+item.phone_number+"</td>\
                                <td>"+item.vehicle_number+"</td>\
                                <td>"+item.payment_method+"</td>\
                                <td>"+item.subtotal+"</td>\
                                <td>"+item.discount+"</td>\
                                <td>"+item.fare+"</td>\
                                <td>"+item.rating+"</td>\
                                <td>"+item.status+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                            </tr>");
                        });
                    }
                }
            });
        });

        //search by date
        $("#trip_date_search").change(function (e) { 
            var id=$(this).val();
            $.ajax({
                type: "post",
                url: "{{route('trip_date_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                  //  console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=13 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td>"+x+++"</td>\
                                <td>"+item.trip_id+"</td>\
                                <td>"+item.customer_first_name+"</td>\
                                <td>"+item.first_name+"</td>\
                                <td>"+item.phone_number+"</td>\
                                <td>"+item.vehicle_number+"</td>\
                                <td>"+item.payment_method+"</td>\
                                <td>"+item.subtotal+"</td>\
                                <td>"+item.discount+"</td>\
                                <td>"+item.fare+"</td>\
                                <td>"+item.rating+"</td>\
                                <td>"+item.status+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                            </tr>");
                        });
                    }
                }
            });
        });
    });

$(document).on("click", "#assign_driver_button", function () {
    $("#trip_id_field").val($(this).val());
});
//select a driver
$(document).on("change", "#driver_selector", function () {
    var value=$(this).val();

    $.ajax({
        type: "post",
        url: "{{route('choose_driver')}}",
        data: {value: value, "_token": "{{ csrf_token() }}"},
        dataType: "json",
        success: function (response) {
            $("#driver_name").val(response.name);
            $("#driver_phone").val(response.phone);
            $("#vehicle_number").val(response.vehicle_number);
            $("#vehicle_type").val(response.vehicle_type);
            $("#driver_id").val(response.driver_id);
        }
    });
});
</script>

@endsection