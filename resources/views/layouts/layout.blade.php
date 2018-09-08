<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manifa Laundry</title>
    <meta name="description" content="Manifa Laundry">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('template/assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/cs-skin-elastic.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{ asset('template/assets/scss/style.css')}}">
    <link href="{{ asset('template/assets/css/lib/vector-map/jqvmap.min.css')}}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- <link href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' rel='stylesheet' type='text/css'> -->
    <!-- <link href="{{asset('template/DataTables/DataTables-1.10.16/css/jquery.dataTables.css')}}" rel="stylesheet"> -->
    <link href="{{asset('template/toastr-master/build/toastr.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('template/datepicker/datepicker3.css')}}" rel="stylesheet">
    @yield('css')
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="{{asset('template/images/manifa.jpg')}}" alt="Logo" style="width:200%; height:150%"></a>
                <!-- <a class="navbar-brand" href="./">Manifa Laundry</a> -->
                <a class="navbar-brand hidden" href="./"><img src="{{asset('template/images/logo2.png')}}" alt="Logo"></a>
            </div>

            @include('layouts.sidebar')
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">


        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, {{ ucwords(Auth::user()->name) }} <span class="fa fa-caret-down"></span>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <!--<a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>-->
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">

        </div>

        <div class="content mt-3">
          @yield('content')
      </div>
  </div>

  <!--<Right Panel -->

    <script src="{{ asset('template/assets/js/vendor/jquery-2.1.4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="{{ asset('template/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugins.js')}}"></script>
    <script src="{{ asset('template/assets/js/main.js')}}"></script>
    <script src="{{ asset('js/axios.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="{{ asset('template/assets/js/lib/chart-js/Chart.bundle.js')}}"></script>
    <script src="{{ asset('template/assets/js/dashboard.js')}}"></script>
    <script src="{{ asset('template/assets/js/widgets.js')}}"></script>
    <script src="{{ asset('template/assets/js/lib/vector-map/jquery.vmap.js')}}"></script>
    <script src="{{ asset('template/assets/js/lib/vector-map/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('template/assets/js/lib/vector-map/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{ asset('template/assets/js/lib/vector-map/country/jquery.vmap.world.js')}}"></script>
    <!-- <script src="{{asset('template/DataTables/DataTables-1.10.16/js/jquery.dataTables.js')}}"></script> -->
    <script src="{{asset('template/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('template/toastr-master/build/toastr.min.js')}}"></script>
    <script src="{{asset('js/medivh.js')}}"></script>
    <script type="text/javascript">
        @if(session()->has('toastr'))
        (function ( $ ){
        toastr.success('New {{session("toastr")}} successfully saved..', 'An {{session("toastr")}} has been created.');
        })( jQuery );
        @endif
        @if(Session::get('update'))
        (function ( $ ){
            toastr.success('Edit {{Session::get('update')}} successfully saved..', 'An {{Session::get('update')}} has been edited.');
        })( jQuery );
        @endif
        @if(Session::get('dlt'))
        (function ( $ ){
            toastr.success('Successful {{Session::get('dlt')}} deleted..', 'An {{Session::get('dlt')}} has been deleted.');
        })( jQuery );
        @endif
        @if(Session::get('danger'))
        (function ( $ ){
        //tambahan untk throw exeption gagal simpan n update
        toastr.error('New {{Session::get('danger')}} failed to save', 'An error has occured');
    })( jQuery );
    @endif
    @if(Session::get('danger-del'))
    (function ( $ ){
        //tmbhn untuk throw exception gagal hapus
        toastr.error('Data {{Session::get('danger')}} failed to delete', 'An error has occured');
    })( jQuery );
    @endif
    @if(Session::get('error'))
    (function ( $ ){
        //tambahan untk throw exeption selesai produksi
        toastr.error('{{Session::get('error')}} hanya dapat diselesaikan oleh petugas yang berkaitan', 'An error has occured');
    })( jQuery );
    @endif
</script>
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
@yield('js')
</body>
</html>
