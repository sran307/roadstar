@extends("layouts.layout")
@section("title", "complaints")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Complaint Sub Categories</h6>
        <a href="{{route('complaint_subs.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Complaint Category</th>
                    <th>Complaint Sub Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $x=1;?>
                @foreach($complaints as $complaint)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>
                        <?php
                            echo (App\Models\country::where("id", $complaint->country)->value("country"));
                        ?>
                    </td>
                    <td><?php
                            echo (App\Models\ComplaintCategory::where("id", $complaint->category)->value("complaint"));
                        ?></td>
                    <td>{{$complaint->sub_category}}</td>
                    <td>{{$complaint->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('complaint_subs.edit',[$complaint->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('complaint_subs.destroy',[$complaint->id])}}" method="post" class="d-inline">
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