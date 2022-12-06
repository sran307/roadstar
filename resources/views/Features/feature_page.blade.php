@extends("layouts.layout")
@section("title", "feature settings")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Feature Settings</h6>
        <a href="{{route('feature_settings.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Enable SMS</th>
                    <th>Enable Mail</th>
                    <th>Enable Refferal Module</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($features as $feature)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$feature->enable_sms}}</td>
                    <td>{{$feature->enable_mail}}</td>
                    <td>{{$feature->enable_module}}</td>
                    <td class="sr_action">
                        <a href="{{route('feature_settings.edit',[$feature->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('feature_settings.destroy',[$feature->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection