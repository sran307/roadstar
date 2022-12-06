@extends("layouts.layout")
@section("title", "about_page")
@section("content")
<div class="container">
    <div class="sr_heading">
       <!-- <h6>About Page Widget</h6>-->
       <!-- <a href="{{route('about_pages.create')}}"><button>Add</button></a>-->
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Main Heading</th>
                    <th>Sub Heading</th>
                   <!-- <th>Background Image</th>-->
                    <th>Image</th>
                    <th>Description 1</th>
                    <th>Description 2</th>
                   <!-- <th>Url</th>-->
                    <!--<th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abouts as $about)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$about->heading1}}</td>
                    <td>{{$about->heading2}}</td>
                   <!-- <td><img src="{{asset('images/page_images/'.$about->bg_image)}}" width="50px" height="50px" alt="images"></td>-->
                    <td><img src="{{asset('images/page_images/'.$about->image)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$about->details}}</td>
                    <td>{{$about->description2}}</td>
                   <!-- <td>{{$about->url}}</td>
                    <td>{{$about->status}}</td>-->
                    <td class="sr_action">
                        <a href="{{route('about_pages.edit',[$about->id])}}"><button class="btn btn-primary">Edit</button></a>
                       <!-- <form action="{{route('about_pages.destroy',[$about->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit">Delete</button>
                        </form>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection