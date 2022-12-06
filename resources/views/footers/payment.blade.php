@extends("layouts.layout")
@section("title", "footer_logo")
@section("content")
<div class="container">
    <div>
        <h6>Footer Logo settings</h6>
        <a href="{{route('footer_payments.create')}}"><button>New</button></a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset('images/icons/'.$payment->icon)}}" width="50px" height="50px" alt="images"></td>
                    <td>{{$payment->status}}</td>
                    <td>
                        <a href="{{route('footer_payments.edit',[$payment->id])}}"><button>Edit</button></a>
                        <form action="{{route('footer_payments.destroy',[$payment->id])}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                            <button onclick="return confirm('Are You Sure?')" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection