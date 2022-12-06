@extends("layouts.layout")
@section("title", "triprequests")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Trips</h6>
        <a href="{{route('trip_requests.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="row">
        <div class="sr_search">
            <label for="search">Search (By Phone number):</label>
            <input type="number" id="trip_request_search"> 

            <label for="search">Search (By Date):</label>
            <input type="date" id="trip_request_date" value="{{date('Y-m-d')}}"> 
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Distance</th>
                    <th>Vehicle Type</th>
                    <th>From Address</th>
                    <th>To Address</th>
                    <th>Travel Type</th>
                    <th>Payment Method</th>
                    <th>Amount Paid</th>
                    <th>Total</th>
                    <th>Promo</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $x=count($requests);?>
                @foreach($requests as $request)
                <tr>
                    <td><?php echo $x--; ?></td>
                   <td>{{$request->passanger_name}}</td>
                   <td>{{$request->passanger_phone}}</td>
                    <td>{{$request->distance}} KM</td>
                    <td>
                        <?php
                            echo(App\Models\ManageModel::where("id", $request->vehicle_type)->value("model_name"));
                        ?>
                    </td>
                   <td><?php if($request->type=="airport_from"){echo $request->airport;}?>
                        <?php if($request->type=="airport_to"){echo $request->from_address;}?>
                        <?php if($request->type!="airport_from" && $request->type!="airport_to"){echo $request->from_address;}?>
                    </td>
                    <td><?php if($request->type=="airport_from"){echo $request->to_address;}?>
                        <?php if($request->type=="airport_to"){echo $request->airport;}?>
                        <?php if($request->type!="airport_from" && $request->type!="airport_to"){echo $request->to_address;}?>
                    </td>
                    <td>{{$request->type}}</td>
                    <td>{{$request->payment_method}}</td>
                    <td>Rs.{{$request->total}}</td>
                    <td>Rs.{{$request->subtotal}}</td>
                    
                    <td>{{$request->promo}}</td>
                    <td>{{$request->discount}}</td>
                    <td>{{$request->tax}}</td>
                    <td>{{$request->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('trip_requests.edit',[$request->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('trip_requests.destroy',[$request->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="sr_paginator">
    {{ $requests->links() }}
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#trip_request_search").keyup(function (e) { 
            id=$(this).val();
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('trip_request_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                   // console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=15 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=response.status.length;
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td>"+x--+"</td>\
                                <td>"+item.passanger_name+"</td>\
                                <td>"+item.passanger_phone+"</td>\
                                <td>"+item.distance+"</td>\
                                <td>"+item.model_name+"</td>\
                                <td>"+item.from_address+"</td>\
                                <td>"+item.to_address+"</td>\
                                <td>"+item.type+"</td>\
                                <td>"+item.payment_method+"</td>\
                                <td>"+item.total+"</td>\
                                <td>"+item.subtotal+"</td>\
                                <td>"+item.promo+"</td>\
                                <td>"+item.discount+"</td>\
                                <td>"+item.tax+"</td>\
                                <td>"+item.status+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                                <button id='delete' class='btn btn-danger' value='"+item.id+"'><i class='fas fa-trash-alt'></i></button></td>\
                            </tr>");
                        });
                        
                    }
                }
            });
            
        });
      
       $(document).on("change", "#trip_request_date", function () {
            id=$(this).val();
            $.ajax({
                type: "post",
                url: "{{route('trip_request_date')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                   // console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=15 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=response.status.length;
                        $.each(response.status, function (key, item) { 
                        
                            $("tbody").append("<tr>\
                                <td>"+x--+"</td>\
                                <td>"+item.passanger_name+"</td>\
                                <td>"+item.passanger_phone+"</td>\
                                <td>"+item.distance+"</td>\
                                <td>"+item.model_name+"</td>\
                                <td>"+item.from_address+"</td>\
                                <td>"+item.to_address+"</td>\
                                <td>"+item.type+"</td>\
                                <td>"+item.payment_method+"</td>\
                                <td>"+item.total+"</td>\
                                <td>"+item.subtotal+"</td>\
                                <td>"+item.promo+"</td>\
                                <td>"+item.discount+"</td>\
                                <td>"+item.tax+"</td>\
                                <td>"+item.status+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                                <button id='delete' class='btn btn-danger' value='"+item.id+"'><i class='fas fa-trash-alt'></i></button></td>\
                            </tr>");
                        });
                        
                    }
                }
            });
            
        });

        $(document).on("click","#edit", function(){
            var id=$(this).val();
            window.location.href = "trip_request_edit/"+id;
        });

        $(document).on("click", "#delete", function(){
            var id=$(this).val();
            if(confirm("Are you sure?")){
                window.location.href = "trip_request_delete/"+id;
            }
        });

    });
</script>

@endsection