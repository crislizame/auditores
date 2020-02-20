
@extends('vistas.layout.dash')
@section('styles')
    <style>
        .pds-lista-item:hover{
            background: #e3e3e3;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid h-100 ">
        <div class="row h-100"> <!-- Start Row principal -->
        @php
            $activar = array("activar"=>array("","active",""));
        @endphp
        @include("vistas.submenu.agenda.submenu",$activar)
        <!--Start Dashboard Content-->
            <div class="row h-100 col-lg-10">
                <div class="col-lg-12 h-50 m-0 p-3" style="padding-bottom: 0!important"><!-- Start PDS -->

                    <div class="card h-100 m-0 p-0">
                        <div class="card-body p-0">
                            <div class="col-lg-12 pt-0 m-0 text-center" style="height: 90%;">  <button class="btn btn-sm btn-secondary btn-delagenda hidden float-right" data-id="0"><i class="fa fa-trash fa-lg"></i></button>
                                <div id="calendar" class="col-centered w-75">
                                </div>

                            </div>

                        </div>
                        <span class="titulos text-info bold txt_fechsel ml-4 mb-2"></span>
                    </div>


                </div><!-- End PDS -->
                <div class="col-lg-12 h-50 p-3 pt-1 " style="padding-top: 0!important;"><!-- Start PDS -->
                    <div class="titulos-grandes">
                        <span class="ml-3 text-white bold ">PDS - Auditores</span>
                    </div>
                    <div class="card m-0 h-75 p-0" style="overflow-x: scroll;">

                        <div class="card-body p-0">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>PDS</th>
                                    <th>Auditores</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody class="tablatodos">

                                </tbody>
                            </table>

                        </div>
                    </div>


                </div><!-- End PDS -->

            </div>
            <!--End Dashboard Content-->
        </div><!-- End Row principal -->
    </div><!-- End container-fluid-->

    <div class="modal fade modal-editpds"  role="dialog" aria-labelledby="modal-editpds" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="modal-crear">Cambiar PDS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="titulos text-center">Cambiar PDS de:</h5>

                    <div class="row p-1">
                        <div class="col-lg-12">
                            <h6 class="text-center font-weight-bold pdsedit_actual"></h6>
                        </div>
                    </div>
                    <h5 class="titulos text-center">A: </h5>

                    <div class="row p-1 pb-3">
                        <div class="col-lg-12">
                            <select class="pds_edit" name="pds_edit">
                                @forelse ((new \App\Pdsperfile())->get() as $pds)
                                    <option value="{{$pds->id}}">{{$pds->pds_name}}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-editarelpds w-100">Editar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-editaudit"  role="dialog" aria-labelledby="modal-editaudit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="modal-crear">Cambiar Auditor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="titulos text-center">Cambiar Auditor de:</h5>

                    <div class="row p-1">
                        <div class="col-lg-12">
                            <h6 class="text-center font-weight-bold auditedit_actual"></h6>
                        </div>
                    </div>
                    <h5 class="titulos text-center">A: </h5>

                    <div class="row p-1 pb-3">
                        <div class="col-lg-12">
                            <select class="audit_edit" name="audit_edit">
                                @forelse ((new \App\Auditore())->get() as $pds)
                                    <option value="{{$pds->id}}">{{$pds->aud_nombre}} {{$pds->aud_apellidos}}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-editarauditor w-100">Editar</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

    <script>
        $(document).ready(function () {
            $('.pds_edit').select2();
            $('.audit_edit').select2();

            $('.btn-editarelpds').click(function () {
                var idd = $(this).attr('data-id');
                var idagenda = $(this).attr('data-agenda');
                var nid = $('.pds_edit').val();
                var noti;
                $.ajax({
                    url: "{{route('agenda/ver/ajax/editarpdsdeagenda')}}",
                    method:"post",
                    dataType:'text',
                    data: {'id':idd,idagenda:idagenda,nid:nid,'_token':"{{csrf_token()}}"},
                    beforeSend: function( ) {
                        noti = Lobibox.notify('info', {
                            pauseDelayOnHover: true,
                            title:"¡Editando!",
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'fa fa-check-circle',
                            msg: 'Por Favor Espere'
                        });
                    }
                }).done(function (done) {
                    noti.remove();
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        title:"¡Editado!",
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'fa fa-check-circle',
                        msg: 'PDS Editado'
                    });
                    cargarpdsaudit(idagenda);
                    $('.modal-editpds').modal("hide");
                });
            });
            $('.btn-editarauditor').click(function () {
                var idd = $(this).attr('data-id');
                var idagenda = $(this).attr('data-agenda');
                var nid = $('.audit_edit').val();
                var noti;
                $.ajax({
                    url: "{{route('agenda/ver/ajax/editarauditdeagenda')}}",
                    method:"post",
                    dataType:'text',
                    data: {'id':idd,idagenda:idagenda,nid:nid,'_token':"{{csrf_token()}}"},
                    beforeSend: function( ) {
                        noti = Lobibox.notify('info', {
                            pauseDelayOnHover: true,
                            title:"¡Editando!",
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'fa fa-check-circle',
                            msg: 'Por Favor Espere'
                        });
                    }
                }).done(function (done) {
                    noti.remove();
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        title:"¡Editado!",
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'fa fa-check-circle',
                        msg: 'Auditor Editado'
                    });
                    cargarpdsaudit(idagenda);
                    $('.modal-editaudit').modal("hide");
                });
            });
            $('.btn-delagenda').click(function () {
                var dataid = $(this).attr('data-id');
                var agendadel = $(this);
                var noti;
                if(dataid !== 0){
                    //[reguintar si desea elminar
                    swal({
                        title: "¿Estas seguro de ELIMINAR la agenda?",
                        icon: "warning",
                        buttons: {
                            cancel: {
                                text:"NO",
                                className:"btn-danger shadow-danger",
                                visible: true,
                                closeModal: true,
                            },
                            willsuccess: "Eliminar"


                        },
                        dangerMode: false,
                    }).then((willsuccess) => {
                        if (willsuccess) {

                            $.ajax({
                                url: "{{route('agenda/ver/ajax/eliminaragenda')}}",
                                method:"post",
                                dataType:'text',
                                data: {'id':dataid,'_token':"{{csrf_token()}}"},
                                beforeSend: function( ) {
                                    noti =  Lobibox.notify('info', {
                                        pauseDelayOnHover: true,
                                        title:"¡Eliminando!",
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        icon: 'fa fa-check-circle',
                                        msg: 'Por Favor Espere'
                                    });
                                }
                            }).done(function (done) {
                                noti.remove();
                                Lobibox.notify('success', {
                                    pauseDelayOnHover: true,
                                    title:"¡Eliminado!",
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    icon: 'fa fa-check-circle',
                                    msg: 'Agenda Eliminada'
                                });
                                agendadel.attr('data-id',0);
                                agendadel.addClass('hidden');
                                cargarpdsaudit(0);
                                $('.txt_fechsel').html("");
                                $("td[data-date="+$('#calendar').attr('data-date')+"]").removeClass("bg-a200 text-dark seleccionador");
                            });
                        }
                    });
                }
            });
            cargarcalendario();
            function eliminaralll(idagenda){

                $('.btn-eliminarall').click(function() {
                    var idd = $(this).attr('data-id');
                    $.ajax({
                        url: "{{route('agenda/ver/ajax/eliminarpdsdeagenda')}}",
                        method: "post",
                        dataType: 'text',
                        data: {'id': idd, '_token': "{{csrf_token()}}"},
                        beforeSend: function () {
                            noti = Lobibox.notify('info', {
                                pauseDelayOnHover: true,
                                title: "¡Eliminando!",
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'fa fa-check-circle',
                                msg: 'Por Favor Espere'
                            });
                        }
                    }).done(function (done) {
                        noti.remove();
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            title: "¡Eliminado!",
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'fa fa-check-circle',
                            msg: ' Eliminado'
                        });
                        cargarpdsaudit(idagenda);
                        $('.modal-editpds').modal("hide");
                    });
                });
            }

            function cargarpdsaudit(dataid){

                {{--                $.ajax({--}}
                {{--                    url: "{{route('agenda/ver/ajax/cargarpdsxfecha')}}",--}}
                {{--                    method:"post",--}}
                {{--                    dataType:'text',--}}
                {{--                    data: {'id':dataid,'_token':"{{csrf_token()}}"},--}}
                {{--                    beforeSend: function( ) {--}}
                {{--                        $('.pdslistarajax').html(" <li class=\"nav-item active audititem\">\n" +--}}
                {{--                            "                                        <span class=\"nav-link \" href=\"#\">Cargando ... <span class=\"check-or-not\"><i class=\"fa fa-check-circle text-white float-right p-1 \"></i></span></span>\n" +--}}
                {{--                            "                                    </li>");--}}
                {{--                    }--}}
                {{--                }).done(function (done) {--}}
                {{--                    $('.pdslistarajax').html(done);--}}
                {{--                    $('.btn-editarpds').click(function () {--}}
                {{--                        var idd = $(this).attr('data-id');--}}
                {{--                        var idagenda = $(this).attr('data-agenda');--}}
                {{--                        var nombrespds = $(this).attr('data-nombre');--}}
                {{--                        $('.modal-editpds').modal("show");--}}
                {{--                        $('.pdsedit_actual').html(nombrespds);--}}
                {{--                        $('.btn-editarelpds').attr('data-agenda',idagenda);--}}
                {{--                        $('.btn-editarelpds').attr('data-id',idd);--}}
                {{--                    });--}}
                {{--                    $('.btn-delpds').click(function () {--}}
                {{--                        var idd = $(this).attr('data-id');--}}
                {{--                        var idagenda = $(this).attr('data-agenda');--}}
                {{--                        var noti;--}}
                {{--                        swal({--}}
                {{--                            title: "¿Estas seguro de ELIMINAR el PDS?",--}}
                {{--                            icon: "warning",--}}
                {{--                            buttons: {--}}
                {{--                                cancel: {--}}
                {{--                                    text:"NO",--}}
                {{--                                    className:"btn-danger shadow-danger",--}}
                {{--                                    visible: true,--}}
                {{--                                    closeModal: true,--}}
                {{--                                },--}}
                {{--                                willsuccess: "Eliminar"--}}


                {{--                            },--}}
                {{--                            dangerMode: false,--}}
                {{--                        }).then((willsuccess) => {--}}
                {{--                            if (willsuccess) {--}}

                {{--                            }--}}
                {{--                        });--}}
                {{--                    });--}}
                {{--                });--}}
                $.ajax({
                    url: "{{route('agenda/ver/ajax/cargarauditxfecha')}}",
                    method:"post",
                    dataType:'text',
                    data: {'id':dataid,'_token':"{{csrf_token()}}"},
                    beforeSend: function( ) {
                        $('.tablatodos').html("");

                    }
                }).done(function (done) {
                    $('.tablatodos').html(done);
                    eliminaralll(dataid);

                });
            }
            function cargarcalendario(){
                $('#calendar').fullCalendar({
                    header: {
                        left: '',
                        center: 'prev, title, next',
                        right:''
                    },
                    locale: 'es',
                    //height: 250,
                    height: "parent",
                    navLinks: false,
                    selectable: false,
                    selectHelper: false,
                    dayClick: function(date, jsEvent, view, resource) {
                        if($("td[data-date="+date.format('YYYY-MM-DD')+"]").hasClass("seleccionador")){
                            $("#calendar").attr("data-date",date.format());
                            cargarpdsaudit($("td[data-date="+date.format('YYYY-MM-DD')+"]").attr('data-id'));
                            $('.txt_fechsel').html($("td[data-date="+date.format('YYYY-MM-DD')+"]").attr('data-textfecha'));
                            $('.btn-delagenda').attr('data-id',$("td[data-date="+date.format('YYYY-MM-DD')+"]").attr('data-id'))
                                .removeClass('hidden');
                            Lobibox.notify('info', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                title:"¡Cargando!",
                                continueDelayOnInactiveTab: false,
                                position: {
                                    top:60,left: 1000
                                },
                                sound:false,
                                delay:500,
                                icon: 'fa fa-check-circle',
                                msg: 'Cargando Datos'
                            });
                            $("#calendar .bg-danger").removeClass("bg-danger text-white");

                        }else{
                            $("#calendar .bg-danger").removeClass("bg-danger text-white");

                            $("td[data-date="+date.format('YYYY-MM-DD')+"]").addClass("bg-danger text-white");
                        }


                    },
                    select: function(start, end, jsEvent, view, resource) {

                        $("#calendar").attr("data-date",start.format());
                    },
                    editable: false,
                    eventLimit: true,
                    eventSources: [

                        {
                            url: '{{route('agenda/ver/ajax/cargarfechas')}}?_token={{csrf_token()}}',
                            method: 'POST',
                            extraParams: {
                            },
                            failure: function() {
                                alert('there was an error while fetching events!');
                            },
                            color: 'yellow',   // a non-ajax option
                            textColor: 'black', // a non-ajax option
                            className: 'bg-warning', // a non-ajax option
                            eventDataTransform:function (eventdata) {
                                $("td[data-date="+eventdata.start+"]").addClass("bg-a200 text-dark seleccionador");
                                $("td[data-date="+eventdata.start+"]").attr("data-id",eventdata.id);
                                $("td[data-date="+eventdata.start+"]").attr("data-textfecha",eventdata.textfecha);

                                return eventdata.start;
                            }
                        }

                        // any other sources...

                    ]
                });

            }

        });
    </script>
@endsection
