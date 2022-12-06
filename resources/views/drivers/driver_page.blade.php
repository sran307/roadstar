@extends("layouts.layout")
@section("title", "drivers")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6> Drivers</h6>
       <!-- <button class="btn btn-primary"><i class="fa fa-filter"></i>Filter</button>-->
        <a href="{{route('drivers.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="row sr_search_row">
        <div class="col-md-6 sr_search">
            <label for="search">Search (By name / phone number):</label>
            <input type="text" id="driver_search"> 
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input id="master_checkbox" type="checkbox"></th>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number With Code</th>
                    <th>License Number</th>
                    <th>Currency</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drivers as $driver)
                <tr>
                    <td><input type="checkbox" class='check_boxes' name="driver" value="{{$driver->id}}"></td>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <?php 
                        $currency=$driver->currency; 
                        $country=App\Models\country::where("currency",$currency)->value("country");
                        echo $country;
                        ?>
                    </td>
                    <td>{{$driver->first_name}}</td>
                    <td>{{$driver->last_name}}</td>
                    <td><?php echo(App\Models\country::where("country",$driver->country)->value("phone_code")." ".$driver->phone_number);?></td>
                    <td>{{$driver->license_number}}</td>
                    <td>{{$driver->currency}}</td>
                    <td>{{$driver->rating}}</td>
                    <td>{{$driver->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('drivers.edit',[$driver->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a> 
                        <form action="{{route('drivers.destroy',[$driver->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form> 
                    <!--    <button class="btn btn-secondary">Bookings</button>
                        <button class="btn btn-dark">Scheduler</button>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#driver_search").keyup(function (e) { 
            id=$(this).val();
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('driver_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=11 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td><input type='checkbox'class='check_boxes' name='driver' value='"+item.id+"'></td>\
                                <td>"+x+++"</td>\
                                <td>"+item.country+"</td>\
                                <td>"+item.first_name+"</td>\
                                <td>"+item.last_name+"</td>\
                                <td><?php echo(App\Models\country::where("country",$driver->country)->value("phone_code")." ".$driver->phone_number);?></td>\
                                <td>"+item.license_number+"</td>\
                                <td>"+item.currency+"</td>\
                                <td>"+item.rating+"</td>\
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
            window.location.href = "driver_edit/"+id;
        });

        $(document).on("click", "#delete", function(){
            var id=$(this).val();
            if(confirm("Are you sure?")){
                window.location.href = "driver_delete/"+id;
            }
        });

        $("#master_checkbox").click(function () {
            $(".check_boxes").prop('checked', $(this).prop('checked'));
        });
        
    });
</script>


@endsection