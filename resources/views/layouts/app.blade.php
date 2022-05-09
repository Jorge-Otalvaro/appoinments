<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- end of global css -->
    <!--page level css -->
    <link rel="stylesheet" href="{{ asset('vendors/swiper/css/swiper.min.css') }}">
    <link href="{{ asset('vendors/nvd3/css/nv.d3.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/lc_switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link href="{{ asset('css/custom_css/dashboard1.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/custom_css/dashboard1_timeline.css') }}" rel="stylesheet"/>
</head>
<body class="skin-default">

    <div class="preloader">
        <div class="loader_img">
            <img src="{{ asset('img/loader.gif') }}" alt="loading..." height="64" width="64">
        </div>
    </div>

    <header class="header" id="app">
        <nav class="navbar navbar-static-top" role="navigation">

            <a class="logo" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="mr-auto">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> 
                    <i class="fa fa-fw ti-menu"></i>
                </a>
            </div>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                   
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle padding-user d-block" data-toggle="dropdown">
                            <!-- <img src="img/authors/avatar1.jpg" width="35" class="rounded-circle img-fluid float-left"
                                 height="35" alt="User Image"> -->
                            <div class="riot">
                                <div>
                                    {{ Auth::user()->name }}
                                   <span><i class="fa fa-sort-down"></i></span>
                                </div>
                            </div>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <!-- <img src="img/authors/avatar1.jpg" class="rounded-circle" alt="User Image"> -->
                                <p>{{ Auth::user()->name }}</p>
                            </li>

                            <li class="p-t-3">
                                <a href="/" class="dropdown-item">
                                    <i class="fa fa-fw ti-user"></i> My Profile 
                                </a>
                            </li>

                            <li role="presentation"></li>

                            <li>
                                <a href="/" class="dropdown-item">
                                <i class="fa fa-fw ti-settings"></i> Account Settings </a>
                            </li>

                            <li role="presentation" class="dropdown-divider"></li>

                            <li class="user-footer">
                                <div class="float-left">
                                    <a href="/">
                                        <i class="fa fa-fw ti-lock"></i>
                                        Lock
                                    </a>
                                </div>

                                <div class="float-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-fw ti-shift-right"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>                                    
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar">
                <div id="menu" role="navigation">
                    <div class="nav_profile">
                        <div class="media profile-left">

                        </div>
                    </div>

                    <ul class="navigation">

                        @if (auth()->user()->role == 'admin')

                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="menu-icon ti-desktop"></i>
                                    <span class="mm-text ">{{ __('Dashboard') }}</span>
                                </a>
                            </li>

                            <li class="menu-dropdown">
                                <a href="#">
                                    <i class="menu-icon ti-desktop"></i>
                                    <span>{{ __('Especialidades') }}</span>
                                    <span class="fa arrow"></span>
                                </a>

                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('specialities.index') }}">
                                            <i class=" menu-icon fa fa-fw ti-widgetized"></i>
                                            {{ __('Lista de especialidades') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('specialities.create') }}">
                                            <i class=" menu-icon fa fa-fw ti-widget-alt"></i>
                                            {{ __('Crear especialidad') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-dropdown">
                                <a href="#">
                                    <i class="menu-icon ti-user"></i>
                                    <span>{{ __('Doctores') }}</span>
                                    <span class="fa arrow"></span>
                                </a>

                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('doctors.index') }}">
                                            <i class=" menu-icon fa fa-fw ti-widgetized"></i>
                                            {{ __('Lista de doctores') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctors.create') }}">
                                            <i class=" menu-icon fa fa-fw ti-widget-alt"></i>
                                            {{ __('Crear doctor') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-dropdown">
                                <a href="#">
                                    <i class="menu-icon ti-user"></i>
                                    <span>{{ __('Pacientes') }}</span>
                                    <span class="fa arrow"></span>
                                </a>

                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('patients.index') }}">
                                            <i class=" menu-icon fa fa-fw ti-widgetized"></i>
                                            {{ __('Lista de pacientes') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('patients.create') }}">
                                            <i class=" menu-icon fa fa-fw ti-widget-alt"></i>
                                            {{ __('Crear paciente') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-dropdown">
                                <a href="#">
                                    <i class="menu-icon ti-files"></i>
                                    <span>{{ __('Reportes') }}</span>
                                    <span class="fa arrow"></span>
                                </a>

                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('patients.index') }}">
                                            <i class=" menu-icon fa fa-fw ti-calendar"></i>
                                            {{ __('Frecuencia de citas') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('patients.create') }}">
                                            <i class=" menu-icon ti-bar-chart"></i>
                                            {{ __('Medicos mas activos') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @elseif(auth()->user()->role == 'doctor') {{-- Medicos --}}

                            <li>
                                <a href="{{ route('schedules.index') }}">
                                    <i class="menu-icon ti-calendar"></i>
                                    <span class="mm-text ">{{ __('Gestión de horario') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="menu-icon ti-layout-grid3"></i>
                                    <span class="mm-text ">{{ __('Gestión de citas') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="menu-icon ti-user"></i>
                                    <span class="mm-text ">{{ __('Gestión de pacientes') }}</span>
                                </a>
                            </li>

                        @else {{-- Pacientes --}}

                            <li>
                                <a href="{{ route('appointments.index') }}">
                                    <i class="menu-icon ti-calendar"></i>
                                    <span class="mm-text ">{{ __('Mis citas') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('appointments.create') }}">
                                    <i class="menu-icon ti-calendar"></i>
                                    <span class="mm-text ">{{ __('Reserva de cita') }}</span>
                                </a>
                            </li>
                            
                        @endif
                    </ul>
                </div>        
            </section>
        </aside>

        <aside class="right-side">
            @yield('content')           
        </aside>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- <!-- begining of page level js -->
    <!--Sparkline Chart-->
    <script type="text/javascript" src="{{ asset('js/custom_js/sparkline/jquery.flot.spline.js') }}"></script>
    <!-- flip --->
    <script type="text/javascript" src="{{ asset('js/flip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lc_switch.min.js') }}"></script>
    <!--flot chart-->
    <script type="text/javascript" src="{{ asset('js/flot/js/jquery.flot.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/flot/js/jquery.flot.resize.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/flot/js/jquery.flot.stack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/flotspline/js/jquery.flot.spline.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/flottooltip/js/jquery.flot.tooltip.js') }}"></script>
    <!--swiper-->
    <script type="text/javascript" src="{{ asset('vendors/swiper/js/swiper.min.js') }}"></script>
    <!--chartjs-->
    <script src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
    <!--nvd3 chart-->
    <script type="text/javascript" src="{{ asset('js/nvd3/d3.v3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/nvd3/js/nv.d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/newsTicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard1.js') }}"></script> --}}
    <!-- end of page level js -->

    @stack('scripts')

    @include('sweetalert::alert')
</body>
</html>
