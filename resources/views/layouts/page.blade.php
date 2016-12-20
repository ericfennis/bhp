<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Scripts -->
    <!--<script>

    </script>-->
</head>
<body>
<<<<<<< HEAD

   @yield('content')
   <figure id="map" class="map"></figure> 
   <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/clock.js"></script>
=======

   @yield('content') 

   <!-- Scripts -->
    <script src="/js/app.js"></script>
>>>>>>> d6d38ae61e420ffc38bf76cfabb87e4076beda8f
    
</body>
</html>