@extends("layouts.layout")
@section("title", "package")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Package</h6>
        <a href="{{route('package_models.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Package_name</th>
                    <th>Hours</th>
                    <th>Kilometers</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $x=1;?>
                @foreach($packages as $package)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$package->name}}</td>
                    <td>{{$package->hours}}</td>
                    <td>{{$package->kilometers}}</td>
                    <td class="sr_action">
                        <a href="{{route('package_models.edit',[$package->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection