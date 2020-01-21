<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{env('APP_NAME')}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--favicon-->
    <link rel="icon" href="https://via.placeholder.com/50x50" type="image/x-icon">
    <script src="{{asset("assets/js/jquery.min.js")}}"></script>
    <!-- Vector CSS -->
    <link href="{{asset("assets/plugins/vectormap/jquery-jvectormap-2.0.2.css")}}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{asset("")}}assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Icons CSS-->
    <link href="{{asset("assets/css/icons.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
    @yield('css')
    @yield('styles')
</head>

<body>

    <!-- Start wrapper-->
    <div id="wrapper">
        @yield('content')
    </div>

    <link href="{{asset("assets/css/app-style.css")}}" rel="stylesheet" />
    <!--End wrapper-->
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset("assets/js/popper.min.js")}}"></script>
    <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>

    <script src="{{asset("assets/js/jquery.autocomplete.js")}}"></script>
    <script type='text/javascript'>
        $(document).ready(function {
            window.onload = detectarCarga;
        });

        function detectarCarga() {
            window.print();
        }
    </script>
</body>

</html>