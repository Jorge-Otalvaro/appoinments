<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- end of bootstrap -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--page level css -->
    <link type="text/css" href="{{ asset('css/themify-icons/css/themify-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!--end page level css-->

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
</head>
<body id="sign-in">

    <div class="preloader">
        <div class="loader_img">
            <img src="{{ asset('img/loader.gif') }}" alt="loading..." height="64" width="64">
        </div>
    </div>

    <div id="app" class="container">
        <div class="row">

            @yield('content')

        </div>
    </div>

    @include('sweetalert::alert')

    <!-- global js -->
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- page level js -->
    <script type="text/javascript" src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js/custom_js/login.js') }}"></script>
    <!-- end of page level js -->
</body>
</html>
