<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=1920,height=1080,user-scalable=no, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="public">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->

    <link href="/css/app.css" rel="stylesheet">

</head>
<body>
   @yield('content')
   <figure id="map" class="map"></figure>
   <div id="popups">
        
   </div>
   <!-- Scripts -->
	<script src="/js/app.js"></script>
</body>
</html>
