@extends("layouts.layout")
@section("title", "trip type")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Trip Types</h6>
        <a href="{{route('trip_types.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="row sr_search_row">
        <div class="sr_search">
            <label for="search">Search (By Date):</label>
            <input type="date" id="trip_type_date_search" value="<?php echo date('Y-m-d');?>"> 
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Active Icon</th>
                    <th>Inactive Icon</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($trips as $trip)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td><img src="{{asset('images/icons/'.$trip->active)}}" width="50px" height="50px" alt="active_icon"> </td>
                    <td><img src="{{asset('images/icons/'.$trip->inactive)}}" width="50px" height="50px" alt="inactive_icon"> </td>
                    <td>{{$trip->name}}</td>
                    <td>{{$trip->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('trip_types.edit',[$trip->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('trip_types.destroy',[$trip->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
       
        //search by date
        $("#trip_type_date_search").change(function (e) { 
            var id=$(this).val();
            $.ajax({
                type: "post",
                url: "{{route('trip_type_date_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                    console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=6 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        $.each(response.status, function (key, item) { 
                            var active="{{asset('images/icons/')}}"+"/"+item.active;
                            var inactive="{{asset('images/icons/')}}"+"/"+item.inactive;
                            $("tbody").append('<tr>\
                                <td>'+x+++'</td>\
                                <td><img src="'+active+'" width="50px" height="50px" alt="images"></td>\
                                <td><img src="'+inactive+'" width="50px" height="50px" alt="images"></td>\
                                <td>'+item.name+'</td>\
                                <td>'+item.status+'</td>\
                                <td><button id="edit" class="btn btn-primary" value="'+item.id+'"><i class="fa fa-edit"></i></button>\
                                <button id="delete" class="btn btn-danger" value="'+item.id+'"><i class="fas fa-trash-alt"></i></button></td>\
                            </tr>');
                        });
                    }
                }
            });
        });
    });

    //edit 
    $(document).on("click", "#edit", function () {
        id=$(this).val();
        window.location.href = "trip_type_edit/"+id;
        
    });

    //delete
    $(document).on("click", "#delete", function () {
        id=$(this).val();
        if(confirm("Are you sure?")){
            window.location.href = "trip_type_delete/"+id;
        }
    });
</script>

@endsection