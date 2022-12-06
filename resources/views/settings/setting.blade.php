@extends("layouts.layout")
@section("title", "general_setting")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>General Settings</h6>
        <a href="{{route('general_settings.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Site Name</th>
                    <th>Meta Title</th>
                    <th>Meta Keywords</th>
                    <th>Meta Description</th>
                    <th>Website Url</th>
                    <th>Logo</th>
                    <th>Favicon</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$setting->site_name}}</td>
                    <td>{{$setting->meta_title}}</td>
                    <td>{{$setting->meta_keyword}}</td>
                    <td>{{$setting->meta_description}}</td>
                    <td>{{$setting->website_url}}</td>
                    <td><img src="{{asset('images/logos/'.$setting->website_logo)}}" width="50px" height="50px" alt=""></td>
                    <td><img src="{{asset('images/logos/'.$setting->favicon)}}" width="50px" height="50px" alt=""></td>
                    <td>{{$setting->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('general_settings.edit',[$setting->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('general_settings.destroy',[$setting->id])}}" method="post" class="d-inline">
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