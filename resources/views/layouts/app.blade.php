<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Final Project | {{ $data['page_title'] }}</title>
        <meta name="keywords" content="{{ $data['page_title'] }}" >

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('partials.nav')
            @include('partials.sidebar')

            @yield('nav')
            <div class="content-wrapper">
                @include('partials.breadcrumbs')
                @yield('content')
            </div>

            @include('partials.footer')
        </div>

        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/adminlte.js') }}"></script>
        <script src="{{ asset('js/fontawesome.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>

        @yield('scripts')

    </body>
</html>
