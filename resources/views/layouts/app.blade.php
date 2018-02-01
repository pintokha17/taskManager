<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name', 'TaskManager') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/favicon.ico">

    <title>Medialoot Bootstrap 4 Dashboard Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid" id="wrapper">
    <div class="row">
        <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
            <h1 class="site-title"><a href="{{ route('home') }}"><em class="fa fa-rocket"></em> TaskManager</a></h1>

            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>

            <ul class="nav nav-pills flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><em class="fa fa-calendar-o"></em> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('task') }}"><em class="fa fa-bar-chart"></em> Tasks</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('report') }}"><em class="fa fa-bar-chart"></em> Reports</a></li>
            </ul>

            <a href="#" class="logout-button">Template by Medialoot</a>
        </nav>

        <main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
            <header class="page-header row justify-center">
                <div class="col-md-6 col-lg-8" >
                    <h1 class="float-left text-center text-md-left">@yield('title', 'TaskManager v1.0')</h1>
                </div>

                <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right">
                    <a class="btn btn-stripped dropdown-toggle" href="#!" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @auth
                            <img src="{{ Auth::user()->getAvatar() }}" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
                            <div class="username mt-1">
                                <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                                <h6 class="text-muted">{{ Auth::user()->email }}</h6>
                            </div>
                        @endauth
                        @guest
                            <img src="//placehold.it/50x50" class="circle float-left profile-photo" width="50">
                            <div class="username mt-1">
                                <h4 class="mb-1">Guest</h4>
                            </div>
                        @endauth
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
                        @auth
                            <a class="dropdown-item" href="{{ route('profile.view') }}"><em class="fa fa-user mr-1"></em> View Profile</a>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><em class="fa fa-edit mr-1"></em> Edit Profile</a>
                            <a class="dropdown-item" href="{{ route('profile.changePassword') }}"><em class="fa fa-cog mr-1"></em> Change Password</a>
                        @endauth
                        @guest
                            <a class="dropdown-item" href="{{ route('login') }}"><em class="fa fa-sign-in mr-1"></em> Login</a>
                            <a class="dropdown-item" href="{{ route('register') }}"><em class="fa fa-user-plus mr-1"></em> Register</a>
                        @endguest
                    </div>
                </div>

                <div class="clear"></div>
            </header>

            <section class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </section>
        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/chart.min.js') }}"></script>
<script src="{{ asset('js/chart-data.js') }}"></script>
<script src="{{ asset('js/easypiechart.js') }}"></script>
<script src="{{ asset('js/easypiechart-data.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

</body>
</html>
