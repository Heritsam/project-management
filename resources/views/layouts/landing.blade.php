<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? "$title - " : '' }}{{ config('app.name', 'Zamasco Project Manager') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('argon') }}/css/argon.css?v=1.0.0">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

        <!-- Datatables -->
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">

        <!-- Select -->
        <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">

        @stack('css')
    </head>
    <body class="{{ $class ?? '' }}">
        <nav class="navbar navbar-expand-md {{ Request::is('home') ? 'navbar-light bg-white border-top border-primary' : 'navbar-dark bg-gradient-primary' }} shadow-sm" style="border-width: 5px !important">
            
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="title my-0">
                        <img src="{{ asset('img/logo.png') }}" class="navbar-brand-img" alt="..." width="30">
                        <span class="ml-2">Project Management</span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                        <i class="ni ni-single-02"></i> My Profile
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run"></i>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="main-content">
            @yield('content')
        </div>

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

        <!-- Datatables -->
        <script src="{{ asset('js/datatables.min.js') }}"></script>

        <!-- Select2 -->
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

        <script>
            $('#table').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<i class='ni ni-bold-left'></i>",
                        "next": "<i class='ni ni-bold-right'></i>",
                    }
                }
            });

            $('.my-select').selectpicker();

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
            });
        </script>
    </body>
</html>