<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	{{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', config('app.name'))</title>

	<!-- Styles -->
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="{{ URL::asset('js/chooseFileName.js') }}"></script>

	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
</head>

<body>
	<div id="app">

		@include('layouts.nav')

		@yield('main_content')

		@include('layouts.footer')

	</div>
</body>

</html>