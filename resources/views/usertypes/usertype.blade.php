@extends("layouts.layout")
@section("title", "usertypes")
@section("content")
<div class="container">
    <div>
        <h6>Add User Type </h6>
        <form action="{{route('user_types.store')}}" method="post">
            @csrf
            <div class="row form-group">
                <label for="user_type" class="col-md-2 col-form-label">User Type <span class="star">*</span></label>
                <div class="col-md-8">
                <input type="text" placeholder="User Type" name="user_type" class="form-control" value="{{old('user_type')}}">             
                @if($errors->has("user_type"))
                        <span class="alert alert-danger">{{$errors->first("user_type")}}</span>
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
        <div>
            <h6>Manage User Type</h6>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($usertypes as $usertype)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$usertype->user}}</td>
                    <td>
                        <a href="{{route('user_types.edit',[$usertype->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('user_types.destroy',[$usertype->id])}}" method="post" class="d-inline">
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