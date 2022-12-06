@extends("layouts.frontend")
@section("title", "login")
@section("content")

<div class="container">
        @if(session()->has("message"))
        <p class="alert {{session()->get('alert-class')}} text-center">{{session()->get("message")}}</p>
        @endif
    <div class="text-center">
        <img src="{{asset('images/logos/'.$image)}}" alt="logo" class="adminforlog">
    </div>
    <form action="{{route('login_form')}}" method="post" class="chochomriz">
        @csrf
        <input type="email" class="form-control my-4" name="email" placeholder="Enter your email">
        @if($errors->has("email"))
        <span class="alert alert-danger">{{$errors->first("email")}}</span>
        @endif
        <input type="password" class="form-control my-4" name="password" placeholder="Enter your password">
        @if($errors->has("password"))
            <span class="alert alert-danger">{{$errors->first("password")}}</span>
        @endif
        <div class="text-center">
             <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

</div>


@endsection
