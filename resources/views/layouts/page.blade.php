<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <!--<script>

    </script>-->
</head>
<body>
   @yield('content') 
   <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>