@extends("layouts.layout")
@section("title", "country")
@section("content")
<div class="container">
    <div class="sr_heading">
        <h6>Countries </h6>
        <a href="{{route('countries.create')}}"><button class="btn btn-success">Add</button></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Country</th>
                    <th>Currency</th>
                    <th>Phone Code</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1;?>
                @foreach($countries as $country)
                <tr>
                    <td><?php echo $x++; ?></td>
                    <td>{{$country->country}}</td>
                    <td>{{$country->currency}}</td>
                    <td>{{$country->phone_code}}</td>
                    <td>{{$country->status}}</td>
                    <td class="sr_action">
                        <a href="{{route('countries.edit',[$country->id])}}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                        <form action="{{route('countries.destroy',[$country->id])}}" method="post" class="d-inline">
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