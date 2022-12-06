<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{asset('public/css/coreui.min.css')}}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('public/css/perfect-scrollbar.css')}}" integrity="sha512-2xznCEl5y5T5huJ2hCmwhvVtIGVF1j/aNUEJwi/BzpWPKEzsZPGpwnP1JrIMmjPpQaVicWOYVu8QvAIg9hwv9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{asset('public/js/perfect-scrollbar.min.js')}}" integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>@yield('title')</title>
     <link href="{{asset('css-admin/style.css')}}" rel="stylesheet">
    </head>
    <body class="sr_admin_login">        
        <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card-group d-block d-md-flex row">
                            <div class="card col-md-7 p-4 mb-0">
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('public/js/jquery-3.5.1.min.js')}}" crossorigin="anonymous"></script>
        <script>
            $("p.alert").delay(3000).slideUp(300);
        </script>
    </body>
</html>
