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
        <!-- Start Row principal -->
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><button data-toggle="modal" data-target=".addComisionistaModal" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Auditor</button></h5>
                    <table class="table" id="list_auditores">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">ID</th>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Cedula</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="AuditoresTabla">
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
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Agregar Auditores</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formguardarComisionistas" method="post">


                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">Información Personal</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="aud_nombre">Nombres</label>
                            <input class="form-control" id="aud_nombre" name="aud_nombre" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="aud_apellidos">Apellidos</label>
                            <input class="form-control" id="aud_apellidos" name="aud_apellidos" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="aud_cedula">Cédula</label>
                            <input class="form-control" id="aud_cedula" name="aud_cedula" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Contraseña de App</label>
                            <input class="form-control" id="password" name="password" value="1234" type="text">

                        </div>


                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="auditor_tipo">Tipo</label>
                            {{-- <input class="form-control" id="tipo_comisionista" name="tipo_comisionista" type="text" >--}}

                            <select class="form-control" id="auditor_tipo" name="auditor_tipo">
                                <option value="N"> NORMAL</option>
                                <option value="P"> PROCESO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="aud_correo">Correo</label>
                            <input class="form-control" id="aud_correo" name="aud_correo" type="text">

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="aud_direccion">Dirección</label>
                            <input class="form-control" id="aud_direccion" name="aud_direccion" type="text">

                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="aud_cuentabanco">Banco</label>
                            <input class="form-control" id="aud_cuentabanco" name="aud_cuentabanco" type="text">

                        </div>
                        <div class="form-group col-md-4">
                            <label for="aud_cuentanumero">Cuenta Número</label>
                            <input class="form-control" id="aud_cuentanumero" name="aud_cuentanumero" type="text">

                        </div>
                        <div class="form-group col-md-4">
                            <label for="aud_cuentatipo">Cuenta Tipo</label>
                            {{-- <input class="form-control" id="tipo_comisionista" name="tipo_comisionista" type="text" >--}}

                            <select class="form-control" id="aud_cuentatipo" name="aud_cuentatipo">
                                <option value="ahorro"> AHORRO</option>
                                <option value="corriente"> CORRIENTE</option>
                            </select>
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
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Editar Auditores</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formeditComisionistas" method="post">


                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">Información Personal</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="aud_nombre">Nombres</label>
                            <input class="form-control" id="aud_nombre2" name="aud_nombre" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="aud_apellidos">Apellidos</label>
                            <input class="form-control" id="aud_apellidos2" name="aud_apellidos" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="aud_cedula">Cédula</label>
                            <input class="form-control" id="aud_cedula2" name="aud_cedula" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Contraseña de App</label>
                            <input class="form-control" id="password2" name="password" placeholder="Si no desea cambiar la contraseña deje en blanco" type="text">

                        </div>


                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="auditor_tipo">Tipo</label>
                            {{-- <input class="form-control" id="tipo_comisionista" name="tipo_comisionista" type="text" >--}}

                            <select class="form-control" id="auditor_tipo" name="auditor_tipo">
                                <option value="N"> NORMAL</option>
                                <option value="P"> PROCESO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="aud_correo">Correo</label>
                            <input class="form-control" id="aud_correo2" name="aud_correo" type="text">

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="aud_direccion">Dirección</label>
                            <input class="form-control" id="aud_direccion2" name="aud_direccion" type="text">

                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="aud_cuentabanco">Banco</label>
                            <input class="form-control" id="aud_cuentabanco2" name="aud_cuentabanco" type="text">

                        </div>
                        <div class="form-group col-md-4">
                            <label for="aud_cuentanumero">Cuenta Número</label>
                            <input class="form-control" id="aud_cuentanumero2" name="aud_cuentanumero" type="text">

                        </div>
                        <div class="form-group col-md-4">
                            <label for="aud_cuentatipo">Cuenta Tipo</label>
                            {{-- <input class="form-control" id="tipo_comisionista" name="tipo_comisionista" type="text" >--}}

                            <select class="form-control" id="aud_cuentatipo2" name="aud_cuentatipo">
                                <option value="ahorro"> AHORRO</option>
                                <option value="corriente"> CORRIENTE</option>
                            </select>
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

@endsection
@section('script')

<script>
    $(document).ready(function() {
        var tableAuditores = $('#list_auditores').DataTable({
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

        //cargarauditores
        cargarAuditores();

        function cargarAuditores() {

            $.ajax({
                url: "{{route('cargarauditores')}}",
                method: "post",
                dataType: 'text',
                data: {
                    '_token': "{{csrf_token()}}"
                },
                beforeSend: function() {
                    //$('.btnPDSEditar').removeAttr('disabled');
                    swal({
                        title: "Cargando Auditores",
                        icon: "info",
                        buttons: false,
                        timer: 2000,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    });
                }
            }).done(function(done) {
                tableAuditores.destroy();
                //$('.btnPDSEditar').attr('disabled');
                $('.AuditoresTabla').html(done);
                tableAuditores = $('#list_auditores').DataTable({
                    "order": [
                        [0, 'desc']
                    ],
                    "lengthMenu": [
                        [25, 50, 100, -1],
                        [25, 50, 100, "Todos"]
                    ]
                });
                opcionesTabla();
                tableAuditores.on('search.dt draw.dt order.dt', function() {
                    opcionesTabla();
                });
            });
        }

        function opcionesTabla() {
            $('.btnEditarComisionista').click(function() {
                var id = $(this).attr('data-id')

                $('.editComisionistaModal').modal('show');
                $.ajax({
                    url: "{{route('auditor/listas/ajax/mostrarAuditor')}}",
                    method: "post",
                    dataType: 'json',
                    data: {
                        comi_id: id,
                        '_token': "{{csrf_token()}}"
                    },
                    beforeSend: function() {

                        $('#aud_nombre2').val('');
                        $('#aud_apellidos2').val('');
                        $('#aud_cedula2').val('');
                        $('#password2').val('');
                        $('#aud_correo2').val('');
                        $('#aud_direccion2').val('');
                        $('#aud_cuentanumero2').val('');
                        $('#aud_cuentatipo2').val('');
                        $('#aud_cuentabanco2').val('ahorro');
                        $('#auditor_tipo2').val('N');
                    }
                }).done(function(data) {
                    //asdasdasd
                    $('#formeditComisionistas').attr('data-id', id);

                    $('#aud_nombre2').val(data.aud_nombre);
                    $('#aud_apellidos2').val(data.aud_apellidos);
                    $('#aud_cedula2').val(data.aud_cedula);
                    $('#aud_correo2').val(data.aud_correo);
                    $('#aud_direccion2').val(data.aud_direccion);
                    $('#aud_cuentanumero2').val(data.aud_cuentanumero);
                    $('#aud_cuentatipo2').val(data.aud_cuentatipo);
                    $('#aud_cuentabanco2').val(data.aud_cuentabanco);
                    $('#auditor_tipo2').val(data.auditor_tipo);


                });
            });
            $('.btnEliminarComisionista').click(function() {
                var id = $(this).attr('data-id');
                swal({
                    title: "¿Estas seguro de ELIMINAR el Auditor?",
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
                            url: "{{route('auditor/listas/ajax/eliminarAuditor')}}",
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
                                title: "Auditor Eliminado con éxito",
                                icon: "success",
                                buttons: false,
                                timer: 1000,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });

                            cargarAuditores();
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
                url: "{{route('auditor/listas/ajax/editarAuditor')}}",
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
                    title: "¡Guardardo!",
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'fa fa-check-circle',
                    msg: 'Edición Guardado'
                });
                cargarAuditores();

            });
        });
        $('#formguardarComisionistas').submit(function() {
            var formdata = $(this).serializeArray();
            var btncomi = $(this);
            $.ajax({
                url: "{{route('auditor/listas/ajax/guardarAuditor')}}",
                method: "post",
                dataType: 'text',
                data: {
                    datos: formdata,
                    _token: "{{csrf_token()}}"
                },
                beforeSend: function() {

                }
            }).done(function(data) {
                $('.addComisionistaModal').modal('hide');
                noti = Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    title: "¡Guardardo!",
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'fa fa-check-circle',
                    msg: 'Edición Guardado'
                });
                $('#aud_nombre').val('');
                $('#aud_apellidos').val('');
                $('#aud_cedula').val('');
                $('#password').val('1234');
                $('#aud_correo').val('');
                $('#aud_direccion').val('');
                $('#aud_cuentanumero').val('');
                $('#aud_cuentatipo').val('');
                $('#aud_cuentabanco').val('ahorro');
                $('#auditor_tipo').val('N');
                cargarAuditores();
            });

        });
    });
</script>
@endsection
