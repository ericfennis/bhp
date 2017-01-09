<!DOCTYPE html>
<!-- achterkant -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet"/>
	<link href="/css/ol.css" rel="stylesheet"/>
	<link href="/css/jquery-ui.css" rel="stylesheet"/>
	<link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
	<link href="/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="/css/bootstrap-editable.css" rel="stylesheet"/>

    <!-- Scripts -->
	<script src="/js/jquery-2.2.0.min.js"></script>
	<script src="/js/jquery-ui.js"></script>
	<script src="/js/bootstrap-editable.min.js"></script>
	<script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>


    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

		 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>
    <div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul id="navButtons" class="nav navbar-nav">
                         	<li><a href="{{ url('/walkpath') }}">
								<i class="fa fa-location-arrow" aria-hidden="true"></i>
								Routes</a>
							</li>

							<li><a href="{{ url('/point') }}">
								<i class="fa fa-thumb-tack" aria-hidden="true"></i>
								Punten</a>
							</li>

							<li><a href="{{ url('/point') }}">
								<i class="fa fa-map-o" aria-hidden="true"></i>
								Faciliteiten</a>
							</li>

							<li><a href="{{ url('/company') }}">
								<i class="fa fa-building-o" aria-hidden="true"></i>
								Bedrijven</a>
							</li>

							<li><a href="{{ url('/person') }}">
								<i class="fa fa-users" aria-hidden="true"></i>
								Personen</a>
							</li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
		<div class="content">
        @yield('content')
		</div>
    </div>

    <!-- Scripts -->
	<script src="/js/ol.js"></script>
	<!--<script src="/js/app.js"></script>-->
	<script src="/js/main.js"></script>
</body>
</html>
