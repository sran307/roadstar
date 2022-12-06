@extends("layouts.layout")
@section("title", "trip_request_status")
@section("content")
<div class="container">
    <div>
        <h6>Trip Request Status </h6>
    </div>
    <div>
        <h6>Add Trip Request Status</h6>
        <form action="{{route('status_models.store')}}" method="post">
            @csrf
            <div class="row form-group">
                <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="status" placeholder="Enter status name" class="form-control" value="{{old('status')}}">
                    @if($errors->has("status"))
                        <span class="alert alert-danger">{{$errors->first("status")}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 text-center">
                 <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </form>
        
    </div>
    <div class="container my-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($statuses==null)
                <td colspan="9"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($statuses as $status)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$status->status}}</td>
                    <td>
                        <a href="{{route('status_models.edit',[$status->id])}}"><button class="btn btn-primary">Edit</button></a>
                        <form action="{{route('status_models.destroy',[$status->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


@endsection