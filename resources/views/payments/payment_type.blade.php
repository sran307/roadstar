@extends("layouts.layout")
@section("title", "payments")
@section("content")
<div class="container">
    <div>
        <h6>Add Payment type </h6>
        <form action="{{route('payment_types.store')}}" method="post">
            @csrf
            <div class="row form-group">
                <label for="payment_type" class="col-md-2 col-form-label">Payment Type <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="Payment Type" name="payment_type" class="form-control" value="{{old('payment_type')}}">             
                @if($errors->has("payment_type"))
                        <span class="alert alert-danger">{{$errors->first("payment_type")}}</span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <label for="status" class="col-md-2 col-form-label">Status <span class="star">*</span></label>
                <div class="col-md-8">
                <select name="status" id="" class="form-control">
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>                
                @if($errors->has("status"))
                        <span class="alert alert-danger">{{$errors->first("status")}}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 text-center">
                <input type="submit" value="save">
                </div>
            </div>
        </form>
    </div>
    <div class="my-4">
        <div>
            <h6>Manage Payment Type</h6>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($payments==null)
                <td colspan="7"><p class="text-center">No results found</p></td>
                @else
                <?php $x=1;?>
                @foreach($payments as $payment)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$payment->payment_type}}</td>
                    <td>{{$payment->status}}</td>
                    <td>
                        <a href="{{route('payment_types.edit',[$payment->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('payment_types.destroy',[$payment->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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