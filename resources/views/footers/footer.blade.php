@extends("layouts.layout")
@section("title", "footer_logo")
@section("content")
<div class="container">
    <div>
        <h6>Footer Logo settings</h6>
       <!-- <a href="{{route('footer_logos.create')}}"><button>New</button></a>-->
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Logo</th>
                    <th>Details</th>
                   <!-- <th>Status</th>-->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logos as $logo)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset('images/logos/'.$logo->logo)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$logo->details}}</td>
                <!--    <td>{{$logo->status}}</td>-->
                    <td>
                        <a href="{{route('footer_logos.edit',[$logo->id])}}"><button>Edit</button></a>
                     <!--   <form action="{{route('footer_logos.destroy',[$logo->id])}}" method="post" class="d-inline">
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