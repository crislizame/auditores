@extends('vistas.layout.dash')
@section('styles')
@endsection

@section('content')

    <div class="container-fluid h-100 ">
        <div class="row h-100">
            <!-- Start Row principal -->
        @php
            $activar = array("activar"=>array("active","",""));
        @endphp
        @include("vistas.submenu.agenda.submenu",$activar)
        <!--Start Dashboard Content-->
            <div class="row col-lg-10 pt-2" style="max-height: 77vh;">
                <div class="col-lg-4">
                    <!-- Start PDS -->
                    <span class="titulos text-info bold">PDS</span>
                    <div class="card pdsgenciudades">
                        <div class="card-body my-auto">
                            <div class="row align-content-center">
                                <span class="pr-2"><i class="fa fa-sliders pointer"></i> Filtrar</span>
                                <span class="pr-2 ">&nbsp;<i class="fa fa-dot-circle-o filtrosel pointer" data-id="az"></i> A - Z </span>
                                <span><i class="fa fa-circle-o filtrosel pointer" data-id="ciudad"></i>&nbsp;</span>
                                <span class="pointer w-25">
                                <select name="ciudadpds" class="form-control form-control-sm p-0" id="ciudadpds" style="height: 23px;">
                                    <option selected value="ciudad">Ciudad</option>
                                    @php
                                        $ciudades = (new \App\Pdsperfile())->groupBy('pds_ciudad')->orderBy('pds_ciudad','asc')->get();
                                    @endphp
                                    @foreach($ciudades as $ciudad)
                                        <option value="{{$ciudad->pds_ciudad}}">{{$ciudad->pds_ciudad}}</option>
                                    @endforeach
                                </select>
                            </span>
                                &nbsp;&nbsp;<span class="text-primary npds"> ...</span><!-- sfa-circle-o -->
                            </div>
                            <div class="row">
                                <form class="search-bar mt-1 ml-0 w-100">
                                    <input type="text" class="form-control w-100  buscar-pds typeahead" placeholder="Buscar">
                                    {{-- <span><i class="icon-magnifier"></i></span>--}}
                                </form>
                            </div>
                            <div class="row mt-2">
                                <div class="pdsmenuflow h-100">
                                    <ul class="nav pdscargarajax pdsmenu w-100 h-100 flex-column">
                                        {{-- Carga de los PDS Dinamica--}}
                                        <li class="nav-item ">
                                            <span class="nav-link bold  titulos-grandes text-center">Cargando ... <span class="check-or-not"><i class="fa fa-check-circle text-white float-right p-1 "></i></span></span></span>
                                            <hr class="p-0 m-0">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End PDS -->
                <div class="col-lg-8" style="max-height: 77vh;">
                    <span class="titulos text-info bold">Auditores</span>
                    <div class="card pdsgencards">
                        <div class="card-body pt-1 ">
                            <div class="auditmenuflow">
                                <ul class="nav auditmenu  flex-column">
                                    <li class="nav-item active audititem">
                                        <span class="nav-link " href="#">Cargando ... <span class="check-or-not"><i class="fa fa-check-circle text-white float-right p-1 "></i></span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- End PDS -->
                    <span class="titulos text-info bold">Asignar Fecha</span>
                    <div class="card pdsgencards">
                        <div class="card-body p-1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="calendar" data-date="0" class="col-centered">
                                    </div>
                                    <button class="btn-modalcrear btn btn-primary w-100">Generar Agenda</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- End PDS -->
                </div>
            </div>
            <!--End Dashboard Content-->
        </div><!-- End Row principal -->
    </div><!-- End container-fluid-->
    <div class="modal fade modal-crear" tabindex="-1" role="dialog" aria-labelledby="modal-crear" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-crear">Revisar Datos Seleccionados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h5 class="titulos-grandes text-center">PDS</h5>
                            <div class="pdsmenuflow">
                                <ul class="cargarpds pdslistarajax">
                                    <li class="nav-item">
                                        <span class="nav-link titulos "> Cargando ...</span>
                                        <hr class="p-0 m-0">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="titulos-grandes text-center">Auditores</h5>
                            <div class="pdsmenuflow">
                                <ul class=" cargarpds auditlistarajax">
                                    <li class="nav-item">
                                        <span class="nav-link titulos "> Cargando ...</span>
                                        <hr class="p-0 m-0">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="titulos-grandes text-center">Fecha Seleccionada</h5>
                            <h6 class="cargardate text-center">Cargando ...</h6>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary btn-crearagenda w-100">Generar Agenda</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset("assets/plugins/fullcalendar/js/fullcalendar-custom-script.js")}}"></script>

    <script>
        $(document).ready(function() {
            var seleccionador = [];
            var seleccauditor = [];

            $('.btn-modalcrear').click(function() {
                if (seleccauditor.length > 0 && seleccauditor.length > 0 && $("#calendar").attr('data-date') !== "0") {
                    $('.cargardate').html($('#calendar').attr('data-date'));
                    cargarpdsaudit();
                    $('.modal-crear').modal('show');
                } else {
                    Lobibox.notify('error', {
                        pauseDelayOnHover: true,
                        title: "¡Error!",
                        continueDelayOnInactiveTab: false,
                        position: 'top center',
                        icon: 'fa fa-check-circle',
                        msg: 'Debe seleccionar datos antes de guardar.'
                    });
                }
            });
            $('.buscar-pds').autocomplete({
                serviceUrl: 'crear/ajax/cargarpdsnombres?_token={{csrf_token()}}',
                onSelect: function(suggestion) {
                    var is_has = $('.filtrosel[data-id="az"]').hasClass("fa-dot-circle-o");
                    if (!is_has) {
                        $('.filtrosel[data-id="ciudad"]').removeClass("fa-dot-circle-o");
                        $('.filtrosel[data-id="ciudad"]').removeClass("fa-circle-o");
                        $('.filtrosel[data-id="ciudad"]').addClass("fa-circle-o");
                        $('.filtrosel[data-id="az"]').removeClass("fa-circle-o");
                        $('.filtrosel[data-id="az"]').addClass("fa-dot-circle-o");
                    }
                    cargarpds("az", suggestion.value);
                }
            })
            $('.buscar-pds').keyup(function() {
                if ($(this).val().length == 0) {
                    var is_has = $('.filtrosel[data-id="az"]').hasClass("fa-dot-circle-o");
                    if (!is_has) {
                        $('.filtrosel[data-id="ciudad"]').removeClass("fa-dot-circle-o");
                        $('.filtrosel[data-id="ciudad"]').removeClass("fa-circle-o");
                        $('.filtrosel[data-id="ciudad"]').addClass("fa-circle-o");
                        $('.filtrosel[data-id="az"]').removeClass("fa-circle-o");
                        $('.filtrosel[data-id="az"]').addClass("fa-dot-circle-o");
                    }
                    cargarpds("az", "");
                }
            });
            $('#ciudadpds').change(function() {
                var ciudad = $(this).val();
                if (ciudad !== "ciudad") {
                    var is_has = $('.filtrosel[data-id="az"]').hasClass("fa-dot-circle-o");
                    if (is_has) {
                        $('.filtrosel[data-id="az"]').removeClass("fa-dot-circle-o");
                        $('.filtrosel[data-id="az"]').removeClass("fa-circle-o");
                        $('.filtrosel[data-id="az"]').addClass("fa-circle-o");
                        $('.filtrosel[data-id="ciudad"]').removeClass("fa-circle-o");
                        $('.filtrosel[data-id="ciudad"]').addClass("fa-dot-circle-o");
                    }
                }
                cargarpds(ciudad, "");
            });
            $('.filtrosel').click(function() {
                var dataid = $(this).attr('data-id');
                var is_has = $(this).hasClass("fa-dot-circle-o");
                if (dataid === "az") {
                    $(this).removeClass("fa-circle-o");
                    $(this).removeClass("fa-dot-circle-o");
                    $('.filtrosel[data-id="ciudad"]').removeClass("fa-dot-circle-o");
                    $('.filtrosel[data-id="ciudad"]').removeClass("fa-circle-o");
                    $('.filtrosel[data-id="ciudad"]').addClass("fa-circle-o");
                    $(this).addClass("fa-dot-circle-o");

                    //obtener seleccionados

                } else {
                    $(this).removeClass("fa-circle-o");
                    $(this).removeClass("fa-dot-circle-o");
                    $('.filtrosel[data-id="az"]').removeClass("fa-dot-circle-o");
                    $('.filtrosel[data-id="az"]').removeClass("fa-circle-o");
                    $('.filtrosel[data-id="az"]').addClass("fa-circle-o");
                    $(this).addClass("fa-dot-circle-o");

                }
                if (!is_has) {
                    cargarpds(dataid, "");
                    $("#ciudadpds").val("ciudad");
                } else if ($("#ciudadpds").val() !== "ciudad") {
                    cargarpds(dataid, "");
                    $("#ciudadpds").val("ciudad");
                }
            });
            $.ajax({
                url: "{{route('agenda/crear/ajax/cargarpds')}}",
                method: "post",
                dataType: 'text',
                data: {
                    'selecc': "[]",
                    filtro: "az",
                    buscar: "",
                    '_token': "{{csrf_token()}}"
                },
                beforeSend: function() {

                }
            })
                .done(function(data) {
                    $('.pdscargarajax').html(data);
                    $.ajax({
                        url: "{{route('agenda/crear/ajax/npds')}}",
                        method: "post",
                        dataType: 'text',
                        data: {
                            'selecc': "[]",
                            filtro: "az",
                            buscar: "",
                            '_token': "{{csrf_token()}}"
                        },
                        beforeSend: function() {
                            $('.npds').html(" ...");
                        }
                    }).done(function(data) {

                        $('.npds').html(data);
                    });
                    addsel();
                });
            $('.btn-crearagenda').click(function() {

                $.ajax({
                    url: "{{route('agenda/crear/ajax/saveagenda')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        'pdslist': "[" + seleccionador + "]",
                        auditlist: "[" + seleccauditor + "]",
                        datecalendar: $("#calendar").attr('data-date'),
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        swal({
                            title: "Estamos Guardando los datos seleccionados",
                            icon: "info",
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                    }
                })
                    .done(function(data) {
                        if (data === "2") {
                            swal({
                                title: "No se pudo guardar los datos, por favor pregunta a tu administrador.",
                                icon: "error",
                                buttons: false,
                                timer: 300,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                title: "¡Error!",
                                continueDelayOnInactiveTab: false,
                                position: 'top center',
                                icon: 'fa fa-check-circle',
                                msg: 'No se pudo guardar los datos, por favor pregunta a tu administrador.'
                            });
                        } else {
                            swal({
                                title: "Datos guardados con éxito",
                                icon: "success",
                                buttons: false,
                                timer: 300,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });
                            Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                title: "¡Listo!",
                                continueDelayOnInactiveTab: false,
                                position: 'top center',
                                icon: 'fa fa-check-circle',
                                msg: 'Guardado correcto'
                            });
                        }
                        seleccauditor = [];
                        seleccionador = [];

                        var is_has = $('.filtrosel[data-id="az"]').hasClass("fa-dot-circle-o");
                        if (!is_has) {
                            $('.filtrosel[data-id="ciudad"]').removeClass("fa-dot-circle-o");
                            $('.filtrosel[data-id="ciudad"]').removeClass("fa-circle-o");
                            $('.filtrosel[data-id="ciudad"]').addClass("fa-circle-o");
                            $('.filtrosel[data-id="az"]').removeClass("fa-circle-o");
                            $('.filtrosel[data-id="az"]').addClass("fa-dot-circle-o");
                        }
                        cargarpds("az", "");
                        cargarauditores();
                        $(".fc-state-highlight").removeClass("fc-state-highlight");
                        $("#calendar").attr("data-date", "0");
                        $('.modal-crear').modal('hide');
                    });


            });
            cargarauditores();

            function cargarauditores() {
                $.ajax({
                    url: "{{route('agenda/crear/ajax/cargarauditores')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {

                    }
                })
                    .done(function(data) {
                        $('.auditmenu').html(data);
                        $('.audititem').click(function() {
                            var is_select = $(this).hasClass('active');
                            var idpds = $(this).attr('data-id');
                            if (is_select) {
                                var indexx = seleccauditor.indexOf(idpds);
                                // $(this).find('i').removeClass("fa-check text-white");
                                $(this).removeClass('active');
                                $(this).find('span').find('i').removeClass("fa-check-circle text-white");

                                seleccauditor.splice(indexx, 1);
                            } else {
                                $(this).addClass('active');
                                $(this).find('span').find('i').addClass("fa-check-circle text-white");


                                // $(this).find('i').addClass("fa-check text-white");

                                seleccauditor.push(idpds);

                            }
                            // console.log(seleccionador);

                        });
                    });
            }

            function cargarpdsaudit() {

                $.ajax({
                    url: "{{route('agenda/crear/ajax/cargarpdslista')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        'pdslist': "[" + seleccionador + "]",
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        $('.pdslistarajax').html(" <li class=\"nav-item active audititem\">\n" +
                            "                                        <span class=\"nav-link \" href=\"#\">Cargando ... <span class=\"check-or-not\"><i class=\"fa fa-check-circle text-white float-right p-1 \"></i></span></span>\n" +
                            "                                    </li>");
                    }
                }).done(function(done) {
                    $('.pdslistarajax').html(done);

                });

                $.ajax({
                    url: "{{route('agenda/crear/ajax/cargarauditlista')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        auditlist: "[" + seleccauditor + "]",
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        $('.auditlistarajax').html(" <li class=\"nav-item active audititem\">\n" +
                            "                                        <span class=\"nav-link \" href=\"#\">Cargando ... <span class=\"check-or-not\"><i class=\"fa fa-check-circle text-white float-right p-1 \"></i></span></span>\n" +
                            "                                    </li>");
                    }
                }).done(function(done) {
                    $('.auditlistarajax').html(done);

                });

            }

            function addsel() {
                $('.pdsitem').click(function() {
                    var is_select = $(this).hasClass('active');
                    var idpds = $(this).parent().attr('data-id');
                    if (is_select) {
                        var indexx = seleccionador.indexOf(idpds);
                        $(this).find('i').removeClass("fa-check text-white");
                        $(this).find('i').addClass("fa-circle-o text-secondary");
                        $(this).removeClass('active');

                        seleccionador.splice(indexx, 1);
                    } else {
                        $(this).addClass('active');
                        $(this).find('i').removeClass("fa-circle-o text-secondary");

                        $(this).find('i').addClass("fa-check text-white");

                        seleccionador.push(idpds);

                    }
                    // console.log(seleccionador);

                });
            }

            function cargarpds(filtro, buscar) {

                $.ajax({
                    url: "{{route('agenda/crear/ajax/cargarpds')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        'selecc': "[" + seleccionador.toString() + "]",
                        filtro: filtro,
                        buscar: buscar,
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        $('.pdscargarajax').html("<li class=\"nav-item \">\n" +
                            "                                        <span class=\"nav-link bold  titulos-grandes text-center\">Cargando ... <span class=\"check-or-not\"><i class=\"fa fa-check-circle text-white float-right p-1 \"></i></span></span></span>\n" +
                            "                                        <hr class=\"p-0 m-0\">\n" +
                            "                                        </li>");
                    }
                })
                    .done(function(data) {

                        $('.pdscargarajax').html(data);
                        $.ajax({
                            url: "{{route('agenda/crear/ajax/npds')}}",
                            method: "post",
                            dataType: 'text',
                            data: {
                                'selecc': "[" + seleccionador.toString() + "]",
                                filtro: filtro,
                                buscar: buscar,
                                '_token': "{{csrf_token()}}"
                            },
                            beforeSend: function() {
                                $('.npds').html(" ...");
                            }
                        }).done(function(data) {

                            $('.npds').html(data);
                        });
                        addsel();
                    });
            }

            $('[href="{{route('agenda/crear-agenda')}}"]').parent().addClass('active');
        });
    </script>
    {{--    asd--}}
@endsection
