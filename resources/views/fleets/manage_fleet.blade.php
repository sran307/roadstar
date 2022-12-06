@extends("layouts.layout")
@section("title", "manage_fleet")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Fleet Management</h6>
        <a href="{{route('manage_fleets.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="row sr_search_row">
        <div class="sr_search">
            <label for="search">Search (By Model Name):</label>
            <input type="text" id="fleet_search"> 
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Vehicle No</th>
                    <th>Bags</th>
                    <th>AC/Non Ac</th>
                    <th>Features</th>
                    <th>Image</th>
                    <th>Travel Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fleets as $fleet)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$fleet->title}}</td>
                    <td><?php 
                            echo(App\Models\FleetCategory::where("id", $fleet->category)->value("name"));
                        ?>
                    </td>
                    <td><?php 
                            echo(App\Models\ManageBrand::where("id", $fleet->brand)->value("brand_name"));
                        ?>
                    </td>
                    <td><?php 
                            echo(App\Models\ManageModel::where("id", $fleet->model)->value("model_name"));
                        ?>
                    </td>
                    <td>{{$fleet->vehicle_number}}</td>
                    <td>{{$fleet->bags}}</td>
                    <td>{{$fleet->ac}}</td>
                    <td><?php echo $fleet->features; ?></td>
                    <td><img src="{{asset('images/fleets/'.$fleet->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$fleet->travel_type}}</td>
                    <td>{{$fleet->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('manage_fleets.edit',[$fleet->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('manage_fleets.destroy',[$fleet->id])}}" method="post" class="d-inline">
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
</div>
<script>
    $(document).ready(function () {
        $("#fleet_search").keyup(function () { 
            id=$(this).val();
            $.ajax({
                type: "post",
                url: "{{route('fleet_search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                    console.log(response.status);
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=11 class='text-center' >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        $.each(response.status, function (key, item) { 
                            var img="{{asset('images/fleets/')}}"+"/"+item.image;
                            var sl=key+1;
                            $("tbody").append("<tr>\
                                <td>"+sl+"</td>\
                                <td>"+item.title+"</td>\
                                <td>"+item.name+"</td>\
                                <td>"+item.brand_name+"</td>\
                                <td>"+item.model_name+"</td>\
                                <td>"+item.vehicle_number+"</td>\
                                <td>"+item.bags+"</td>\
                                <td>"+item.ac+"</td>\
                                <td>"+item.features+"</td>\
                                <td><img src='"+img+"' width='50px' height='50px' alt='images'></td>\
                                <td>"+item.travel_type+"</td>\
                                <td>"+item.status+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                                <button id='delete' class='btn btn-danger' value='"+item.id+"'><i class='fas fa-trash-alt'></i></button><td>\
                                </td>\
                            </tr>");
                        });
                    }
                }
            });
            
        });

        $(document).on("click","#edit", function(){
            var id=$(this).val();
            window.location.href = "fleet_edit/"+id;
        });

        $(document).on("click", "#delete", function(){
            var id=$(this).val();
            if (confirm('Are you sure?')) {
              $.ajax({
                  type: "post",
                  url: window.location.href = "fleet_delete/"+id,
                  data: {id: id, "_token": "{{ csrf_token() }}"}, 
                  dataType: "json",
                  success: function (response) {
                      console.log(response);
                  }
              });
            }
        });

        $("#master_checkbox").click(function () {
            $(".check_boxes").prop('checked', $(this).prop('checked'));
        });
        
    });
</script>


@endsection
