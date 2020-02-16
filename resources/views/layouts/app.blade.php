<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{ asset('assets/scss/style.css')}}">
    <link href="{{ asset('assets/css/lib/vector-map/jqvmap.min.css')}}" rel="stylesheet">


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('assets/css/lib/chosen/chosen.min.css')}}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <style>
        div#resizableDiv:after {
            content: "";
            resize: horizontal;
            bottom: 0;
            right: 0;
            cursor: e-resize;
            position: absolute;
            z-index: 9;
            width: 20px;
            height: 20px;
        }

        .resizeUI {
            position: absolute;
            bottom: 0;
            right: 0;
            background: inherit;
            padding: 0px 3px;
            pointer-events: none;
            cursor: e-resize;
        }
    </style>
    <style>
        #mydiv {
            position: fixed;
            z-index: 9;
            left:0;
            top:500px;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #d3d3d3;
            overflow: hidden;
        }

        #mydivheader {
            padding: 10px;
            cursor: move;
            z-index: 10;
            background-color: #2196F3;
            color: #fff;
        }
        .gros {
            width: 1000px;
            height: 700px;
        }

        .grosImage {
            width: 1000px;
            height: 650px;
        }
        .petit {
            width: 10%;
            height: 300px;
        }
        .petitImage {
            width: 187px;
            height:200px;
        }
        .risk {
            background-color: #f50017d4 !important;
            color:black !important;
        }
        .riskfait {
            background-color: #dc354580 !important;
            color:black !important;
        }
        .riskferme {
            background-color: #f7f7f7 !important;
            color:black !important;
        }
        .opportunite {
            background-color: #00ff00!important;
        }
        .opportunitefaite {
            background-color: #00ff7f29!important;
        }
        .opportuniteferme {
            background-color: white!important;
        }
    </style>
    <link href="{{ asset('css/impression.css')}}" rel="stylesheet" media="print">
</head>
<body >


<!-- Left Panel -->

<aside id="left-panel" class="left-panel ne_pas_afficher">
    @include('layouts.nav')
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel ">

    <!-- Header-->
    <header id="header" class="header ne_pas_afficher">

        <div class="header-menu ne_pas_afficher">


            <div class="col-sm-12 pull-right">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img class="user-avatar rounded-circle" src="{{ asset('images/user.png')}}" alt="User Avatar"> {{ Auth::user()->prenoms.' '.Auth::user()->nom }}
                    </a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power -off"></i>Se déconnecter
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form></a>
                    </div>
                </div>




            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="main-content">
        <div class="section__content section__content--p30">
            <img src="{{ asset("images/Eiffage_2400_01_colour_RGB.jpg") }}" class="logo_eiffage" style="display: none">
            <div class="container-fluid" id="page">
                <div class="agile-grid"  style="background-color: #FFFFFF;@yield('pour_register') margin: 5px">

                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif()
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif()
                    @yield('content')
                </div>
                @yield('page')
            </div>
        </div>
    </div>

    </div> <!-- .content -->

</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="{{ asset('assets/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins.js')}}"></script>
<script src="{{ asset('assets/js/main.js')}}"></script>



<script src="{{ asset('assets/js/dashboard.js')}}"></script>
<script src="{{ asset('assets/js/widgets.js')}}"></script>
<script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.js')}}"></script>
<script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.sampledata.js')}}"></script>
<script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.world.js')}}"></script>
<script src="{{ asset("assets/js/lib/chosen/chosen.jquery.min.js")}}"></script>





<script>
    ( function ( $ ) {
        "use strict";

        jQuery( '#vmap' ).vectorMap( {
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: [ '#1de9b6', '#03a9f5' ],
            normalizeFunction: 'polynomial'
        } );
    } )( jQuery );
</script>


</body>
</html>
