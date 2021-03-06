@extends('vistas.layout.dash')
@section('styles')
    <style>
        .pds-lista-item:hover {
            background: #e3e3e3;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><button data-toggle="modal" data-target=".addComisionistaModal" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Comisionistas</button></h5>
                        <table class="table" id="list_comisionistas">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th width="30%">Punto de Suerte</th>
                                <th>Ciudad</th>
                                <th width="15%">Opciones</th>
                            </tr>
                            </thead>
                            <tbody class="comisionistaTabla">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade addComisionistaModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Agregar Comisionistas</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formguardarComisionistas" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información PDS</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_name">PDS</label>
                                <select class="form-control pds_name" id="pds_name" name="pds_id">
                                    <option value="0">Seleccione un PDS</option>
                                    @php
                                        $pdss = (new \App\Pdsperfile())->orderBy('id','desc')->get()
                                    @endphp
                                    @forelse($pdss as $pds)
                                        <option value="{{$pds->id}}">{{$pds->pds_name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_ciudad">Ciudad</label>
                                <select disabled class="form-control pds_ciudad" id="pds_ciudad" name="pds_ciudad">
                                    <option value="0">Ciudad</option>
                                    @php
                                        $provinciasx = public_path('provincias.json');
                                        $abierto = file_get_contents($provinciasx);
                                        $provincias = json_decode($abierto);
                                    @endphp
                                    @forelse($provincias as $provincia)
                                        @forelse($provincia->cantones as $canton)
                                            <option value="{{$canton->canton}}">{{$canton->canton}}</option>
                                        @empty
                                        @endforelse
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información Personal</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombres">Nombres</label>
                                <input class="form-control" id="nombres" name="nombres" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidos">Apellidos</label>
                                <input class="form-control" id="apellidos" name="apellidos" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cedula">Cédula</label>
                                <input class="form-control" id="cedula" name="cedula" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="edad">Edad</label>
                                <input class="form-control" id="edad" name="edad" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="estudios">Estudios</label>
                                <input class="form-control" id="estudios" name="estudios" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion">Direccion</label>
                                <input class="form-control" id="direccion" name="direccion" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="tipo_comisionista">Tipo</label>
                                <select class="form-control" id="tipo_comisionista" name="tipo_comisionista" disabled>
                                    <option value="COMISIONISTA">COMISIONISTA</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="fecha_apertura">Fecha Ingreso</label>
                                <input class="form-control" value="<?php echo date('Y-m-d'); ?>" id="fecha_apertura" name="fecha_apertura" type="date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_celular">Telef. Celular</label>
                                <input class="form-control" id="celular" name="celular" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_domicilio">Telefono Fijo</label>
                                <input class="form-control" id="telef_domicilio" name="telef_domicilio" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Recursos de Supervisión</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rs_ventas">Ventas</label>
                                <input class="form-control" id="rs_ventas" name="rs_ventas" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rs_cartera">Cartera</label>
                                <input class="form-control" id="rs_cartera" name="rs_cartera" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Horario de Lunes a Viernes y Sabados a Domingos</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="tipo_comisionista">Hora de Entrada L-V</label>
                                <input class="form-control" id="h_ingreso" name="h_ingreso" type="time">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="direccion">Hora de Salida L-V</label>
                                <input class="form-control" id="h_salida" name="h_salida" type="time">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_celular">Hora de Entrada S-D</label>
                                <input class="form-control" id="hfds_ingreso" name="hfds_ingreso" type="time">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_fijo">Hora de Salida S-D</label>
                                <input class="form-control" id="hfds_salida" name="hfds_salida" type="time">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btnGuardarComisionistas">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade editComisionistaModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Editar Comisionistas</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formeditComisionistas" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información PDS</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <img width="90%" height="200px" style="max-height: 200px" id="img_editar" class="img-fluid p-2">
                            </div>
                            <div class="col-6">
                                <div class="form-group col-md-12">
                                    <label for="pds_name">Nombre de PDS</label>
                                    <select class="form-control pds_name" id="pds_name2" name="pds_id">
                                        <option value="0">Seleccione un PDS</option>
                                        @php
                                            $pdss = (new \App\Pdsperfile())->orderBy('id','desc')->get()

                                        @endphp
                                        @forelse($pdss as $pds)
                                            <option value="{{$pds->id}}">{{$pds->pds_name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="pds_ciudad2">Ciudad</label>
                                    <select disabled class="form-control pds_ciudad" id="pds_ciudad2" name="pds_ciudad">
                                        <option value="0">Ciudad</option>
                                        @php
                                            $provinciasx = public_path('provincias.json');
                                            $abierto = file_get_contents($provinciasx);
                                            $provincias = json_decode($abierto);

                                        @endphp
                                        @forelse($provincias as $provincia)
                                            @forelse($provincia->cantones as $canton)
                                                <option value="{{$canton->canton}}">{{$canton->canton}}</option>
                                            @empty
                                            @endforelse
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información Personal</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombres">Nombres</label>
                                <input class="form-control" id="nombres2" name="nombres" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidos">Apellidos</label>
                                <input class="form-control" id="apellidos2" name="apellidos" type="text">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cedula">Cédula</label>
                                <input class="form-control" id="cedula2" name="cedula" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input class="form-control" id="email2" name="email" type="text">

                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="edad">Edad</label>
                                <input class="form-control" id="edad2" name="edad" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="estudios">Estudios</label>
                                <input class="form-control" id="estudios2" name="estudios" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion">Dirección</label>
                                <input class="form-control" id="direccion2" name="direccion" type="text">

                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="tipo_comisionista">Tipo</label>
                                <select class="form-control" id="tipo_comisionista2" name="tipo_comisionista" disabled>
                                    <option value="COMISIONISTA">COMISIONISTA</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="fecha_apertura">Fecha Ingreso</label>
                                <input class="form-control" id="fecha_apertura2" value="" name="fecha_apertura" type="date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_celular">Número Celular</label>
                                <input class="form-control" id="celular2" value="0" name="celular" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_domicilio">Teléfono Fijo</label>
                                <input class="form-control" id="telef_domicilio2" name="telef_domicilio" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Recursos de Supervisión</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rs_ventas">Ventas</label>
                                <input class="form-control" id="rs_ventas2" name="rs_ventas" type="text">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="rs_cartera">Cartera</label>
                                <input class="form-control" id="rs_cartera2" name="rs_cartera" type="text">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Horario de Lunes a Viernes y Sabados a Domingos</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="tipo_comisionista">Hora de Entrada L-V (22:10)</label>
                                <input class="form-control" id="h_ingreso2" name="h_ingreso" type="time">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="direccion">Hora de Salida L-V (22:10)</label>
                                <input class="form-control" id="h_salida2" name="h_salida" type="time">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_celular">Hora de Entrada S-D (22:10)</label>
                                <input class="form-control" id="hfds_ingreso2" name="hfds_ingreso" type="time">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="telef_fijo">Hora de Salida S-D (22:10)</label>
                                <input class="form-control" id="hfds_salida2" name="hfds_salida" type="time">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group offset-md-4 col-md-2 text-md-right">
                                <h4>Score</h4>
                            </div>
                            <div class="form-group col-md-2">
                                <h4 id="score"></h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" disabled class="btn btn-primary btnComisionistasEditar">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $(document).ready(function() {
            var tableCom = $('#list_comisionistas').DataTable({
                "lengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "Todos"]
                ]
            });
            $('form').on('submit', function() {
                return false;
            });
            $('#pds_name').select2();
            $('#pds_ciudad').select2();
            $('#pds_name').on('select2:select', function(e) {
                var data = e.params.data;
                $.ajax({
                    url: "{{route('comisionista/listas/ajax/ciudadpds')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        'pds_id': data.id,
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        // noti =  Lobibox.notify('info', {
                        //     pauseDelayOnHover: true,
                        //     title: "¡Eliminando!",
                        //     continueDelayOnInactiveTab: false,
                        //     position: 'top right',
                        //     icon: 'fa fa-check-circle',
                        //     msg: 'Por Favor Espere'
                        // });
                    }
                }).done(function(done) {
                    console.log(done);
                    $('#pds_ciudad').val(done).trigger('change');
                });
            });
            $('#pds_ciudad2').select2();
            $('#pds_name2').select2();
            $('#pds_name2').on('select2:select', function(e) {
                var data = e.params.data;
                $.ajax({
                    url: "{{route('comisionista/listas/ajax/ciudadpds')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        'pds_id': data.id,
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        // noti =  Lobibox.notify('info', {
                        //     pauseDelayOnHover: true,
                        //     title: "¡Eliminando!",
                        //     continueDelayOnInactiveTab: false,
                        //     position: 'top right',
                        //     icon: 'fa fa-check-circle',
                        //     msg: 'Por Favor Espere'
                        // });
                    }
                }).done(function(done) {
                    console.log(done);
                    $('#pds_ciudad2').val(done).trigger('change');
                });
            });

            //comisionista/listas/ajax/cargarcomisionistas
            cargarComisionistas();

            function cargarComisionistas() {

                $.ajax({
                    url: "{{route('comisionista/listas/ajax/cargarcomisionistas')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        $('.btnComisionistasEditar').removeAttr('disabled');
                        swal({
                            title: "Cargando Comisionistas",
                            icon: "info",
                            buttons: false,
                            timer: 2000,
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                        // noti =  Lobibox.notify('info', {
                        //     pauseDelayOnHover: true,
                        //     title: "¡Cargando!",
                        //     continueDelayOnInactiveTab: false,
                        //     position: 'top right',
                        //     icon: 'fa fa-check-circle',
                        //     msg: 'Por Favor Espere'
                        // });
                    }
                }).done(function(done) {
                    tableCom.destroy();
                    $('.btnComisionistasEditar').attr('disabled');
                    $('.comisionistaTabla').html(done);
                    tableCom = $('#list_comisionistas').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        "lengthMenu": [
                            [25, 50, 100, -1],
                            [25, 50, 100, "Todos"]
                        ]
                    });
                    opcionesTabla();
                    tableCom.on('search.dt draw.dt order.dt', function() {
                        opcionesTabla();
                    });
                });
            }

            function opcionesTabla() {
                $('.btnEditarComisionista').click(function() {
                    var id = $(this).attr('data-id');
                    $('.editComisionistaModal').modal('show');
                    $.ajax({
                        url: "{{route('comisionista/listas/ajax/mostrarComisionistas')}}",
                        method: "post",
                        dataType: 'json',
                        data: {
                            comi_id: id,
                            '_token': "{{csrf_token()}}"
                        },
                        beforeSend: function() {
                            $('#pds_name2').val(0)
                                .trigger('change');
                            $('#pds_ciudad2').val(0)
                                .trigger('change');
                            $('#nombres2').val('');
                            $('#apellidos2').val('');
                            $('#estudios2').val('');
                            $('#direccion2').val('');
                            $('#h_ingreso2').val('');
                            $('#h_salida2').val('');
                            $('#email2').val('');
                            $('#edad2').val('');
                            $('#img_editar').attr('src',"");

                            $('#hfds_ingreso2').val('');
                            $('#hfds_salida2').val('');
                            $('#celular2').val('');
                            $('#telef_domicilio2').val('');
                            $('#cedula2').val('');
                            $('#rs_cartera2').val('');
                            $('#rs_ventas2').val('');
                            $('#fecha_apertura2').val('');
                            $('#tipo_comisionista2').val('');

                            // noti =  Lobibox.notify('info', {
                            //     pauseDelayOnHover: true,
                            //     title: "¡Cargando!",
                            //     continueDelayOnInactiveTab: false,
                            //     position: 'top right',
                            //     icon: 'fa fa-check-circle',
                            //     msg: 'Por Favor Espere'
                            // });
                        }
                    }).done(function(data) {
                        //asdasdasd
                        $('#formeditComisionistas').attr('data-id', id);
                        $('#pds_name2').val(data.comisionista.pds_id)
.trigger('change');
var date = $('#pds_name2').select2('data');
$('#pds_name2').trigger({
type: 'select2:select',
params: {
    data: date[0]

}
});
if(data.comisionista.attach == null || data.comisionista.attach == "null" ){
$('#img_editar').attr('src',"{{asset('person.jpg')}}");
}else{
$('#img_editar').attr('src',"{{url('imagen')}}/"+data.comisionista.attach);
}
$('#nombres2').val(data.comisionista.nombres);
$('#apellidos2').val(data.comisionista.apellidos);
$('#estudios2').val(data.comisionista.estudios);
$('#direccion2').val(data.comisionista.direccion);
$('#h_ingreso2').val(data.comisionista.h_ingreso);
$('#email2').val(data.comisionista.email);

$('#h_salida2').val(data.comisionista.h_salida);
$('#rs_ventas2').val(data.comisionista.rs_ventas);
$('#hfds_ingreso2').val(data.comisionista.hfds_ingreso);
$('#hfds_salida2').val(data.comisionista.hfds_salida);
$('#celular2').val(data.comisionista.celular);
$('#fecha_apertura2').val(data.comisionista.fecha_apertura);
$('#rs_cartera2').val(data.comisionista.rs_cartera);
$('#telef_domicilio2').val(data.comisionista.telef_domicilio);
$('#cedula2').val(data.comisionista.cedula);
$('#edad2').val(data.comisionista.edad);

$('#score').html(data.score+"%");

                    });
                });
                $('.btnEliminarComisionista').click(function() {
                    var id = $(this).attr('data-id');
                    swal({
                        title: "¿Estas seguro de ELIMINAR el Comisionista?",
                        icon: "warning",
                        buttons: {
                            cancel: {
                                text: "NO",
                                className: "btn-danger shadow-danger",
                                visible: true,
                                closeModal: true,
                            },
                            willsuccess: "Eliminar"


                        },
                        dangerMode: false,
                    }).then((willsuccess) => {
                        if (willsuccess) {
                            $.ajax({
                                url: "{{route('comisionista/listas/ajax/eliminarComisionistas')}}",
                                method: "post",
                                dataType: 'text',
                                data: {
                                    comi_id: id,
                                    _token: "{{csrf_token()}}"
                                },
                                beforeSend: function() {

                                }
                            }).done(function(data) {
                                swal({
                                    title: "Comisionista Eliminado con éxito",
                                    icon: "success",
                                    buttons: false,
                                    timer: 1000,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });

                                cargarComisionistas();
                            });
                        }
                    });

                });
            }
            $('#formeditComisionistas').submit(function() {
                var formdata = $(this).serializeArray();
                var btncomi = $(this);
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('comisionista/listas/ajax/editarComisionistas')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        datos: formdata,
                        comi_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: function() {

                    }
                }).done(function(data) {
                    $('.editComisionistaModal').modal('hide');
                    noti = Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        title: "¡Guardado!",
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'fa fa-check-circle',
                        msg: 'Edición Guardado'
                    });
                });

            });
            $('#formguardarComisionistas').submit(function() {
                var formdata = $(this).serializeArray();
                var btncomi = $(this);
                $.ajax({
                    url: "{{route('comisionista/listas/ajax/guardarComisionistas')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        datos: formdata,
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        swal({
                            title: "Espere, Guardando Comisionista",
                            icon: "info",
                            buttons: false,
                            timer: 2000,
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                    }
                }).done(function(data) {
                    if(JSON.parse(data).exists){
                        swal({
                            title: "Los datos ingresados ya existen",
                            icon: "error",
                            buttons: false,
                            timer: 3000
                        });
                    } else{
                        $('.addComisionistaModal').modal('hide');
                        noti = Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            title: "¡Guardado!",
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'fa fa-check-circle',
                            msg: 'Comisionista Guardado'
                        });
                        swal({
                            title: "Los datos fueron guardados",
                            icon: "success",
                            buttons: false,
                            timer: 3000
                        });
                        $('#pds_name').val(0)
                            .trigger('change');
                        $('#pds_ciudad').val(0)
                            .trigger('change');
                        $('#nombres').val('');
                        $('#apellidos').val('');
                        $('#estudios').val('');
                        $('#direccion').val('');
                        $('#h_ingreso').val('');
                        $('#h_salida').val('');
                        $('#edad').val('');
                        $('#hfds_ingreso').val('');
                        $('#hfds_salida').val('');
                        $('#celular').val('');
                        $('#telef_domicilio').val('');
                        $('#cedula').val('');
                        $('#rs_cartera').val('');
                        $('#rs_ventas').val('');
                        $('#fecha_apertura').val('');
                        $('#tipo_comisionista').val('');
                        cargarComisionistas();
                    }
                });

            });
        });
    </script>
@endsection
