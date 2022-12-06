@extends("layouts.layout")
@section("title", "tax")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Tax Lists </h6>
        <a href="{{route('tax_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Tax Name</th>
                    <th>Percent</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($taxes as $tax)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>
                        <?php
                            echo (App\Models\country::where("id", $tax->country)->value("country"));
                        ?>
                    </td>
                    <td>{{$tax->name}}</td>
                    <td>{{$tax->percent}}</td>
                    <td>{{$tax->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('tax_models.edit',[$tax->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('tax_models.destroy',[$tax->id])}}" method="post" class="d-inline">
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


@endsection