@extends("layouts.layout")
@section("title", "status")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Driver Trip Status </h6>
        <a href="{{route('status_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Status</th>
                  <!--  <th>Customer Status Name</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($statuses==null)
                <td colspan="5"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($statuses as $status)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$status->status}}</td>
                  
                    <td class="sr_action">
                        <a href="{{route('status_models.edit',[$status->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection