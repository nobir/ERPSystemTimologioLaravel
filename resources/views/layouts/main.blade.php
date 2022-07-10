<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header class=" {{ Session::has('loggedin') ? 'd-lg-block' : 'd-md-block' }} container bg-success p-3">
        <div class="row">
            <div class="col-12 col-md-3 text-center text-md-start">
                <a href="{{ route('home.index') }}" class="navbar-brand-md h2 text-decoration-none text-white"><i class="bi bi-life-preserver text-white display-5"></i></a>
                @if (Session::has('loggedin') && Session::has('user'))
                    <div>
                        <span class="text-white fs-6">Logged in <a href="{{ route('dashboard.profile') }}" class="badge badge-danger">{{ Session::get('user')->username }}</a> as {{ Session::get('user')->type == 0 ? "System Admin" : (Session::get('user')->type == 1 ? "CEO" : (Session::get('user')->type == 2 ? "Manager" : (Session::get('user')->type == 3 ? "Employee" : (Session::get('user')->type == 4 ? "Receptionist" : "")))) }}</span>
                    </div>
                @endif
            </div>
            <div class="col-12 col-md-9 d-flex justify-content-center align-items-center">
                @include('components.primarymenu')
            </div>
        </div>
    </header>

    <main class="container py-2 my-3 border">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">{{ $page_title }} Page</h1>
            </div>
        </div>
        <hr>

        @if (Session::has('error_message') && Session::get('error_message') != '')
            <div class="col-12">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mr-2"></i>
                    <div>
                        <strong>{{ Session::get('error_message') }}</strong>
                    </div>
                </div>
            </div>
        @endif

        @if (Session::has('success_message') && Session::get('success_message') != '')
            <div class="col-12">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill flex-shrink-0 mr-2"></i>
                    <div>
                        <strong>{{ Session::get('success_message') }}</strong>
                    </div>
                </div>
            </div>
        @endif

        <div class="row d-flex justify-content-center">
            @if (Session::has('loggedin'))
                <div class="col-12 col-md-3">
                    @include('components.sidemenu')
                </div>
            @endif

            <div class="col-12 col-md-{{ Session::has('loggedin') ? '9' : '12' }}">
                @yield('contents')
            </div>
        </div>
    </main>

    <footer class="container bg-success p-3">
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-white mb-0">
                    <span class="text-white">
                        {{ date('Y') }} &copy; Copyright by <strong><a href="{{ route('home.about') }}" class="list-group-item d-inline text-dark rounded p-1">Group 08</a></strong>
                    </span>
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('bootstrap/js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
