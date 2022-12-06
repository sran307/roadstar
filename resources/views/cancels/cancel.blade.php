@extends("layouts.layout")
@section("title", "cancellations")
@section("content")
<div class="container">
    <div>
        <h6>Add Cancellation Reason </h6>
        <form action="{{route('cancellations.store')}}" method="post">
            @csrf
            <div class="row form-group">
                <label for="reason" class="col-md-2 col-form-label">Cancellation Reason <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="Cancellation Reason" name="reason" class="form-control" value="{{old('reason')}}">             
                @if($errors->has("reason"))
                        <span class="alert alert-danger">{{$errors->first("reason")}}</span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="type" class="col-md-2 col-form-label">Types <span class="star">*</span></label>
                <div class="col-md-8">
                <select name="type" id="" class="form-control">
                    <option value="">Select Types</option>
                    @foreach($types as $type)
                    <option value="{{$type->user}}">{{$type->user}}</option>
                    @endforeach
                </select>                
                @if($errors->has("type"))
                    <span class="alert alert-danger">{{$errors->first("type")}}</span>
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
    <div class="my-4">
        <div class="sr_heading">
            <h6>Manage Cancellation Reason</h6>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl.no</th>
                            <th>Reason</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=1;?>
                        @foreach($cancels as $cancel)
                        <tr>
                            <td><?php echo $x++; ?></td>
                            <td>{{$cancel->reason}}</td>
                            <td>{{$cancel->user_type}}</td>
                            <td class="sr_action">
                                <a href="{{route('cancellations.edit',[$cancel->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                                <form action="{{route('cancellations.destroy',[$cancel->id])}}" method="post" class="d-inline">
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
</div>


@endsection