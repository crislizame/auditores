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
                    <h5 class="card-title"><button data-toggle="modal" data-target=".agregarProveedor" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Proveedor</button></h5>
                    <table class="table" id="list_proveedores">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Nombre</th>
                                <th>RUC</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Score</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="TablaProveedores">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade agregarProveedor" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Crear Proveedor</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCrearProveedor" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">Información</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Razón social</label>
                            <input class="form-control" name="nombre" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ruc/Cédula</label>
                            <input class="form-control" name="cedula" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Telefono</label>
                            <input class="form-control" name="telefono" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Correo</label>
                            <input class="form-control" name="correo" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Banco</label>
                            <input class="form-control" name="cuentabanco" type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cuenta Número</label>
                            <input class="form-control" name="cuentanumero" type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cuenta Tipo</label>
                            <select class="form-control" name="cuentatipo">
                                <option value="ahorro"> AHORRO</option>
                                <option value="corriente"> CORRIENTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="guardarProveedor">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade editarProveedor" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Editar Proveedor</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarProveedor" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">Información</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <img style="max-height: 200px" id="img_editar" class="img-fluid p-2" src="https://devtemporal92.grupolizame.com/person.jpg" width="90%" height="200px">
                        </div>
                        <div class="col-6">
                            <div class="form-group col-md-12">
                                <label>Razón social</label>
                                <input class="form-control" name="nombre_edit" type="text">
                                <input type="hidden" name="id_edit">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ruc/Cédula</label>
                                <input class="form-control" name="cedula_edit" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Telefono</label>
                            <input class="form-control" name="telefono_edit" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Correo</label>
                            <input class="form-control" name="correo_edit" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion_edit" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Banco</label>
                            <input class="form-control" name="cuentabanco_edit" type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cuenta Número</label>
                            <input class="form-control" name="cuentanumero_edit" type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cuenta Tipo</label>
                            <select class="form-control" name="cuentatipo_edit">
                                <option value="ahorro"> AHORRO</option>
                                <option value="corriente"> CORRIENTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="modificarProveedor">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    var tablaProveedores;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $(document).ready(function() {
        tablaProveedores = $('#list_proveedores').DataTable({
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ]
        });

        cargar();
    });

    $('#guardarProveedor').click(function() {
        $.ajax({
            url: "{{ url('proveedores/listas/ajax/guardarProveedores') }}",
            method: "post",
            data: $('#formCrearProveedor').serialize(),
                    beforeSend: function() {
                        swal({
                            title: "Espere, Guardando Proveedor",
                            icon: "info",
                            buttons: false,
                            timer: 2000,
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                    }
        }).done(function(data) {
            if(data.exists){
                swal({
                    title: "Los datos ingresados ya existen",
                    icon: "error",
                    buttons: false,
                    timer: 3000
                });
            } else {
                $('.agregarProveedor').modal('hide');
                noti = Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            title: "¡Guardado!",
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'fa fa-check-circle',
                            msg: 'Proveedor Guardado'
                        });
                        swal({
                            title: "Los datos fueron guardados",
                            icon: "success",
                            buttons: false,
                            timer: 3000
                        });
                cargar();
            }
        });

    });

    $('#modificarProveedor').click(function() {
        $.ajax({
            url: "{{ url('proveedores/listas/ajax/editarProveedores') }}",
            method: "post",
            data: $('#formEditarProveedor').serialize()
        }).done(function(data) {
            $('.editarProveedor').modal('hide');
            noti = Lobibox.notify('success', {
                pauseDelayOnHover: true,
                title: "¡Modificado!",
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'fa fa-check-circle',
                msg: 'Proveedor Modificado'
            });
            cargar();
        });

    });

    function cargar() {
        $.ajax({
            url: "{{url('proveedores/listas/ajax/mostrarProveedores')}}",
            method: "post",
            dataType: 'text',
            data: {
                '_token': "{{csrf_token()}}"
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Proveedores",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            tablaProveedores.destroy();
            $('.TablaProveedores').html(done);
            tablaProveedores = $('#list_proveedores').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "lengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "Todos"]
                ]
            });
        });
    }

    function verProveedor(id) {
        $.ajax({
            url: "{{ url('proveedores/listas/ajax/verProveedores') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id
            }
        }).done(function(data) {
            $('[name="id_edit"]').val(id);
            $('[name="nombre_edit"]').val(data.nombre);
            $('[name="cedula_edit"]').val(data.ruc_cedula);
            $('[name="telefono_edit"]').val(data.telefono);
            $('[name="correo_edit"]').val(data.correo);
            $('[name="direccion_edit"]').val(data.direccion);
            $('[name="cuentabanco_edit"]').val(data.banco);
            $('[name="cuentanumero_edit"]').val(data.cuenta);
            $('[name="cuentatipo_edit"]').val(data.tipodecuenta);
            $('.editarProveedor').modal('show');
        });
    }
</script>
@endsection