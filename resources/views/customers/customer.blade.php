@extends("layouts.layout")
@section("title", "customers")
@section("content")
<div class="container">
    <div class="sr_heading">
        <p id="success"></p>
        <h6>Customers</h6>
        <a href="{{route('customers.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="sr_download">
        <div>
            <a href="{{route('export_csv')}}"><button class="btn btn-info">csv</button></a>
            <a href="{{route('export_pdf')}}"><button class="btn btn-info">pdf</button></a>
            <a href="{{route('export_xlsx')}}"><button class="btn btn-info">excel</button></a>
        </div>
        <div class="sr_search">
            <label for="search">Search(By name / Phone number):</label>
            <input type="text" id="search"> 
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Country Code</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php $x=1;?>
                @foreach($customers as $customer)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$customer->customer_first_name}}</td>
                    <td>{{$customer->customer_last_name}}</td>
                    <td>{{$customer->phone_number}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->code}}</td>
                    <td>{{$customer->currency}}</td>
                    <td>{{$customer->status}}</td>
                    <td id="buttons" class="sr_action">
                        <a href="{{route('customers.edit',[$customer->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('customers.destroy',[$customer->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>    
                        <a href="{{route('sos_edit', [$customer->id])}}"><button class="btn btn-dark">SOS</button></a>
                        <a href="{{route('wallet')}}"><button class="btn btn-secondary">wallet</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <span>{{$customers->links()}}</span>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#search").keyup(function (e) { 
            var id=$(this).val();
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('search')}}",
                data: {id: id, "_token": "{{ csrf_token() }}"}, 
                dataType: "json",
                success: function (response) {
                    if((response.status.length)==0){
                        $("tbody").html("");
                        $("tbody").append("<tr>\
                        <td colspan=9 >No result found</td>\
                        </tr>");
                    }else{
                        $("tbody").html("");
                        var x=1;
                        $.each(response.status, function (key, item) { 
                            $("tbody").append("<tr>\
                                <td>"+x+++"</td>\
                                <td>"+item.customer_first_name+"</td>\
                                <td>"+item.customer_last_name+"</td>\
                                <td>"+item.phone_number+"</td>\
                                <td>"+item.email+"</td>\
                                <td>"+item.code+"</td>\
                                <td>"+item.currency+"</td>\
                                <td>"+item.status+"</td>\
                                <td><button id='edit' class='btn btn-primary' value='"+item.id+"'><i class='fa fa-edit'></i></button>\
                                <button id='delete' class='btn btn-danger' value='"+item.id+"'><i class='fas fa-trash-alt'></i></button>\
                                <button id='sos' class='btn btn-dark' value='"+item.id+"'>SOS</button>\
                                <button id='wallet' class='btn btn-secondary' value='"+item.id+"'>wallet</button></td>\
                            </tr>");
                        });
                        
                    }
                }
            });
            
        });
       
        $(document).on("click","#sos", function(){
            var id=$(this).val();
            window.location.href = "sos_edit/"+id;
        });

        $(document).on("click","#edit", function(){
            var id=$(this).val();
            window.location.href = "customer_edit/"+id;
        });

        $(document).on("click", "#delete", function(){
            var id=$(this).val();
            if(confirm("Are you sure?")){
                window.location.href = "customer_delete/"+id;
            }
        });

        $(document).on("click","#wallet", function(){
            var id=$(this).val();
            window.location.href = "wallet"
        });
        
    });
</script>

@endsection