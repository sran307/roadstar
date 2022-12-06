@extends("layouts.layout")
@section("title", "complaints")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Complaints </h6>
        <a href="{{route('complaints_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="row sr_search_row">
        <div class="col-md-6 sr_search">
            <label for="search">Search (By Category):</label>
            <input type="text" id="complaint_search"> 
        </div>
        <div class="col-md-6 sr_search">
            <label for="search">Search (By date):</label>
            <input type="date" id="complaint_date_search" value="{{date('Y-m-d')}}"> 
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Trip Id</th>
                    <th>Customer Id</th>
                    <th>Driver Id</th>
                    <th>Complaint Category</th>
                    <th>Complaint Sub Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $x=1;?>
                @foreach($complaints as $complaint)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$complaint->trip_id}}</td>
                    <td><?php
                            echo (App\Models\Customer::where("id", $complaint->customer)->value("customer_first_name"));
                        ?></td>
                    <td>
                        <?php
                            echo (App\Models\Driver::where("id", $complaint->driver)->value("first_name"));
                        ?>
                    </td>
                    <td>
                        <?php
                            echo (App\Models\ComplaintCategory::where("id", $complaint->category)->value("complaint"));
                        ?>
                    </td>
                    <td>
                        <?php
                            echo (App\Models\ComplaintSub::where("id", $complaint->sub_category)->value("sub_category"));
                        ?>
                    </td>
                    <td class="sr_action">
                        <a href="{{route('complaints_models.edit',[$complaint->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#complaint_search").keyup(function (e) { 
            id=$(this).val();
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('complaint_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                   // console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=7 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        for(i=0;i<3;i++){
                            
                        }
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td>"+x+++"</td>\
                                <td>"+item.trip_id+"</td>\
                                <td>"+item.customer_first_name+"</td>\
                                <td>"+item.first_name+"</td>\
                                <td>"+item.complaint+"</td>\
                                <td>"+item.sub_category+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button></td>\
                            </tr>");
                        });
                    }
                }
            });
            
        });
       
        $(document).on("change", "#complaint_date_search", function () {
            id=$(this).val();
            $.ajax({
                type: "post",
                url: "{{route('complaint_search_date')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                    //console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=7 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        for(i=0;i<3;i++){
                            
                        }
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td>"+x+++"</td>\
                                <td>"+item.trip_id+"</td>\
                                <td>"+item.customer_first_name+"</td>\
                                <td>"+item.first_name+"</td>\
                                <td>"+item.complaint+"</td>\
                                <td>"+item.sub_category+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                            </tr>");
                        });
                    }
                }
            });
        });

        $(document).on("click","#edit", function(){
            var id=$(this).val();
            window.location.href = "complaints_edit/"+id;
        });
        
    });
</script>

@endsection