<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>CORK Admin - Multipurpose Bootstrap Dashboard Template </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('assets/en/img/favicon.ico') }}"/>
        <link href="{{ asset('assets/en/css/loader.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ asset('assets/en/js/loader.js') }}"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="{{ asset('assets/en/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/en/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/en/plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/en/plugins/table/datatable/dt-global_style.css') }}">
        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href="{{ asset('assets/en/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/en/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/en/css/apps/contacts.css') }}" rel="stylesheet" type="text/css"/>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    @else
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>CORK Admin - Multipurpose Bootstrap Dashboard Template </title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
        <link href="{{ asset('assets/ar/css/loader.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/ar/js/loader.js') }}"></script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href="{{ asset('assets/ar/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/ar/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href="{{ asset('assets/ar/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/ar/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/ar/plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/ar/plugins/table/datatable/dt-global_style.css') }}">
        <!-- END PAGE LEVEL STYLES -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    @endif


    @yield('header')
    <style>
        .material-icons {
            font-size: 20px;
            margin-left: 5px;
        }

        /*ion-icon {*/
            /*font-size: 20px;*/
            /*margin-right:1px;*/
            /*margin-left:1px;*/
            /*margin-top:1px;*/
        /*}*/
    </style>
</head>

<body class="alt-menu sidebar-noneoverflow">
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>

<!--  END LOADER -->

@include('layouts.partial.topbar')

<!--  BEGIN MAIN CONTAINER  -->
{{-- <div class="main-container" id="container"> --}}
<div class="main-container sidebar-closed sbar-open" id="container">

    <div class="overlay"></div>
    <div class="cs-overlay"></div>
    <div class="search-overlay"></div>

    <div class="sidebar-wrapper sidebar-theme">

        @include('layouts.partial.sidebar')

    </div>

        @yield('content')


</div>


@include('layouts.partial.footer')


@yield('scripts')
</body>

</html>
