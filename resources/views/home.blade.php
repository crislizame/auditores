<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--favicon-->
    <link rel="icon" href="{{asset("assets/images/favicon.ico")}}" type="image/x-icon">
    <!-- Vector CSS -->
    <link href="{{asset("assets/plugins/vectormap/jquery-jvectormap-2.0.2.css")}}" rel="stylesheet"/>
    <!-- simplebar CSS-->
    <link href="{{asset("assets/plugins/simplebar/css/simplebar.css")}}" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="{{asset("")}}assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="{{asset("assets/css/animate.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{asset("assets/css/icons.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="{{asset("assets/css/sidebar-menu.css")}}" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="{{asset("assets/css/app-style.css")}}" rel="stylesheet"/>
    <!--Full Calendar Css-->
    <link href="{{asset("assets/plugins/fullcalendar/css/fullcalendar.css")}}" rel='stylesheet'/>
    @yield('css')
    @yield('styles')
</head>

<body>

<!-- Start wrapper-->
<div id="wrapper">
{{--<div class="wrapper sidebar_minimize">--}}
    @include('vistas.include.menu')
    <div class="content-wrapper pl-0">
        @yield('content')

    </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

</div ><!--End wrapper-->
<!-- Bootstrap core JavaScript-->
    <script src="{{asset("assets/js/jquery.min.js")}}"></script>
    <script src="{{asset("assets/js/popper.min.js")}}"></script>
    <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>

    <!-- simplebar js -->
    <script src="{{asset("assets/plugins/simplebar/js/simplebar.js")}}"></script>
    <!-- waves effect js -->
    <script src="{{asset("assets/js/waves.js")}}"></script>
    <!-- sidebar-menu js -->
    <script src="{{asset("assets/js/sidebar-menu.js")}}"></script>
    <!-- Custom scripts -->
    <script src="{{asset("assets/js/app-script.js")}}"></script>

    <!-- Vector map JavaScript -->
    <script src="{{asset("assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js")}}"></script>
    <script src="{{asset("assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js")}}"></script>
    <!-- Sparkline JS -->
    <script src="{{asset("assets/plugins/sparkline-charts/jquery.sparkline.min.js")}}"></script>
    <!-- Chart js -->
    <script src="{{asset("assets/plugins/Chart.js/Chart.min.js")}}"></script>
    <!--Morris JavaScript -->
    <script src="{{asset("assets/plugins/raphael/raphael-min.js")}}"></script>
    <script src="{{asset("assets/plugins/morris/js/morris.js")}}"></script>
    <!-- Index js -->	  <!-- Full Calendar -->

    <script src='{{asset("assets/plugins/fullcalendar/js/moment.min.js")}}'></script>
    <script src='{{asset("assets/plugins/fullcalendar/js/spanish.js")}}'></script>
    <script src='{{asset("assets/plugins/fullcalendar/js/fullcalendar.js")}}'></script>
    <script src='{{asset("assets/plugins/fullcalendar/locales-all.js")}}'></script>
    <script src="{{asset("assets/plugins/fullcalendar/js/fullcalendar-custom-script.js")}}"></script>
    <script>
        $(document).ready(function(){
            $('#calendar').fullCalendar({
                locale: 'es'
            });
        });
    </script>
@yield('script')
</body>
</html>
