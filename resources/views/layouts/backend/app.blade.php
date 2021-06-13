<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
    @stack('css')



</head>
<body>
    <div id="app" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

   @include('layouts.backend.partials.header')

        <div class="app-main">
        @include('layouts.backend.partials.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">

                @yield('content')

                </div>
                @include('layouts.backend.partials.footer')
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>

    </div>

    <!-- Scripts -->

   <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>--->




   <script src="{{ asset('assets/scripts/main.js') }}" defer></script>
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('js/iziToast.js') }}"></script>
   {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
   @include('vendor.lara-izitoast.toast')
   @stack('js')



</body>
</html>
