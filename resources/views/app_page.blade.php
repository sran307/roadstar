@extends("layouts.layout")
@section("title", "app_settings")
@section("content")

<div class="container">
    <div class="sr_heading">
          <h5>App Settings</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>App Name</th>
                    <th>App Version</th>
                    <th>Default Currency</th>
                    <th>Default Currency Symbol</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->version}}</td>
                    <td>{{$value->currency}}</td>
                    <td>{{$value->symbol}}</td>
                    <td class="sr_action"> <a href="edit_app/{{$value->id}}"><button class="btn btn-primary">Edit</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection