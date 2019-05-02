<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{config('app.name')}} a modern educational site">
    <meta name="author" content="ZELLAT Abdelkhalek - Adel NAMANI">
    <title> CUFA | E-Learning Platform</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <!-- BASE CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendors.css')}}" rel="stylesheet">
    <link href="{{asset('css/icon_fonts/css/all_icons.min.css')}}" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

</head>

<body id="{{$id}}">
		
	<div id="page">
		
    @yield('content')
	
	</div>
	<!-- page -->
    <!-- COMMON SCRIPTS -->
    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/common_scripts.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('assets/validate.js')}}"></script>
	@yield('js')

</body>
</html>