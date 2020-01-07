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
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            
            @yield('content')

            @auth
                <div class="container-fluid py-4">
                    @include('layouts.footers.nav')
                </div>
            @endauth
        </div>

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

        <!-- Chart JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

        <!-- Datatables -->
        <script src="{{ asset('js/datatables.min.js') }}"></script>

        <!-- Select2 -->
        <script src="{{ asset('js/selectize.min.js') }}"></script>

        <script>
            $('#table').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<i class='ni ni-bold-left'></i>",
                        "next": "<i class='ni ni-bold-right'></i>",
                    }
                }
            });

            $('#select').selectize();

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
            });
        </script>
    </body>
</html>