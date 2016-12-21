<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/ol.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

</head>
<body>
	<!-- Libraries -->
	<script src="/js/jquery-2.2.0.min.js"></script>

	@yield('content')

	<!-- Scripts -->
	<script src="/js/ol.js"></script>
	<script src="/js/app.js"></script>
	<script src="/js/main.js"></script>
</body>
</html>
