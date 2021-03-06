<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name'))</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/_reset.css') }} " />
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Google map -->
  {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNiSnmDS-OsDEqtw13VAnfHG6Cn4Lxihw">
  </script> --}}
</head>

<body>
  <div id="app">
    @include('layouts.nav')

    @yield('main_content')

    @include('layouts.footer')

  </div>
</body>

</html>