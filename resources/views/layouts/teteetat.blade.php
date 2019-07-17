
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

    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css')}}" media="screen">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{ asset('assets/scss/style.css')}}" media="screen">
    <link href="{{ asset('assets/css/lib/vector-map/jqvmap.min.css')}}" rel="stylesheet" media="screen">


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css' media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/chosen/chosen.min.css')}}" media="screen">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    <link href="{{ asset('css/style.css')}}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/impressionA3.css')}}" rel="stylesheet" media="print">
</head>
<body id="body">


<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel ">
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
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



</body>
</html>
