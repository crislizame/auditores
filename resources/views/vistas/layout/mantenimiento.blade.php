<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--favicon-->
    <link rel="icon" href="https://via.placeholder.com/50x50" type="image/x-icon">
    <!--Lightbox Css-->
    <link href="{{asset("assets/plugins/fancybox/css/jquery.fancybox.min.css")}}" rel="stylesheet" type="text/css" />

    <!-- Vector CSS -->
    <link href="{{asset("assets/plugins/vectormap/jquery-jvectormap-2.0.2.css")}}" rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="{{asset("assets/plugins/simplebar/css/simplebar.css")}}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{asset("")}}assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{asset("assets/css/animate.css")}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{asset("assets/css/icons.css")}}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{asset("assets/css/sidebar-menu.css")}}" rel="stylesheet" />
    <!-- Custom Style-->
    {{--<link href="{{asset("assets/css/app-style.css")}}" rel="stylesheet" />--}}
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet">
    <!--Full Calendar Css-->
    <link href="{{ asset('assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet') }}" type="text/css">

    <link href="{{asset("assets/plugins/fullcalendar/css/fullcalendar.css")}}" rel='stylesheet' />
    <link rel="stylesheet" href="{{asset("assets/plugins/notifications/css/lobibox.min.css")}}">
    <script src="{{asset("assets/js/jquery.min.js")}}"></script>

    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.extend(true, $.fn.dataTable.defaults, {
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
        });
    </script>

    @yield('css')
    @yield('styles')
</head>

<body>

    <!-- Start wrapper-->
    <div id="wrapper">
        {{--<div class="wrapper sidebar_minimize">--}}

        @switch(Auth::user()->user_type)
        @case('M')
        @include('vistas.include.mantenimiento.menu')
        @break
        @case('S')
        @include('vistas.include.soporte_rp3_lottogame.menu')
        @break
        @case('R')
        @include('vistas.include.soporte_rp3_lottogame.menu')
        @break
        @case('L')
        @include('vistas.include.soporte_rp3_lottogame.menu')
        @break
        @case('P')
        @include('vistas.include.permisos.menu')
        @break
        @endswitch

        <div class="content-wrapper pl-0">
            @yield('content')

        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

    </div>

    <link href="{{asset("assets/css/app-style.css")}}" rel="stylesheet" />
    <!--End wrapper-->
    <!-- Bootstrap core JavaScript-->
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
    <!-- Index js -->
    <!-- Full Calendar -->

    <script src='{{asset("assets/plugins/fullcalendar/js/moment.min.js")}}'></script>
    <script src='{{asset("assets/plugins/fullcalendar/js/spanish.js")}}'></script>
    <script src='{{asset("assets/plugins/fullcalendar/js/fullcalendar.js")}}'></script>
    <script src='{{asset("assets/plugins/fullcalendar/locales-all.js")}}'></script>
    <script src="{{asset("assets/plugins/select2/js/select2.min.js")}}"></script>
    <script src="{{asset("assets/js/jquery.autocomplete.js")}}"></script>
    <!--Sweet Alerts -->
    <script src="{{ asset('assets/plugins/alerts-boxes/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/alerts-boxes/js/sweet-alert-script.js') }}"></script>
    <script src="{{asset("assets/plugins/notifications/js/lobibox.js")}}"></script>
    <script src="{{asset("assets/plugins/notifications/js/notifications.js")}}"></script>
    <!--Lightbox-->
    <script src="{{asset("assets/plugins/fancybox/js/jquery.fancybox.min.js")}}"></script>

    <script>
        $(document).ready(function() {
            $('.iconodelmenu').click(function() {
                var pos = $('.iconodelmenu2').attr('data-id');
                if (pos == "1") {
                    $('.iconodelmenu2').removeClass('fa-chevron-left');
                    $('.iconodelmenu2').addClass('fa-chevron-right');
                    $('.iconodelmenu2').attr('data-id', '0');
                } else {
                    $('.iconodelmenu2').addClass('fa-chevron-left');
                    $('.iconodelmenu2').removeClass('fa-chevron-right');
                    $('.iconodelmenu2').attr('data-id', '1');
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>