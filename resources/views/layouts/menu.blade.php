<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
    <h1 class="site-title"><a href="index.html"><em class="fa fa-rocket"></em> TaskManager</a></h1>

    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>

    <ul class="nav nav-pills flex-column sidebar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><em class="fa fa-calendar-o"></em> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('task') }}"><em class="fa fa-bar-chart"></em> Tasks</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('report') }}"><em class="fa fa-bar-chart"></em> Reports</a></li>
    </ul>

    <a href="#" class="logout-button">Template by Medialoot</a>
</nav>