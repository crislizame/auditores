@extends('vistas.layout.superadmin')
@section('styles')
<style>
    .pds-lista-item:hover {
        background: #e3e3e3;
    }
    .content-wrapper {
    margin-left: 0;}
</style>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><button data-toggle="modal" data-target=".agregarUsuario" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Cuenta de usuario</button></h5>
                    <table class="table" id="list_usuarios">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>Nombre</th>
                                <th>Corre electrónico</th>
                                <th>Tipo de usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="TablaUsuarios">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade agregarUsuario" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Crear Usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCrearUsuario" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">Información</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Correo electrónico</label>
                            <input class="form-control" name="correo" type="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cédula</label>
                            <input class="form-control" name="cedula" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Celular</label>
                            <input class="form-control" name="celular" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Telefono</label>
                            <input class="form-control" name="telefono" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Cuenta Tipo</label>
                            <select class="form-control" name="cuentatipo">
                                <option value="A"> Administrador</option>
                                <option value="M"> Mantenimiento</option>
                                <option value="S"> Soporte</option>
                                <option value="R"> RP3</option>
                                <option value="L"> Lotto Game</option>
                                <option value="P"> Permisos</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="guardarUsuario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade editarUsuario" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Editar Usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario" method="post" autocomplete="off">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">Información</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre_edit" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Correo electrónico</label>
                            <input class="form-control" name="correo_edit" type="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cédula</label>
                            <input class="form-control" name="cedula_edit" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion_edit" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Celular</label>
                            <input class="form-control" name="celular_edit" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Telefono</label>
                            <input class="form-control" name="telefono_edit" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Cuenta Tipo</label>
                            <select class="form-control" name="cuentatipo_edit">
                                <option value="A"> Administrador</option>
                                <option value="M"> Mantenimiento</option>
                                <option value="S"> Soporte</option>
                                <option value="R"> RP3</option>
                                <option value="L"> Lotto Game</option>
                                <option value="P"> Permisos</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="modificarUsuario">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    var TablaUsuarios;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $(document).ready(function() {
        TablaUsuarios = $('#list_usuarios').DataTable({
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ]
        });

        cargar();
    });

    $('#guardarUsuario').click(function() {
        $.ajax({
            url: "{{ url('superadmin/usuarios/ajax/store') }}",
            method: "post",
            data: $('#formCrearUsuario').serialize(),
                    beforeSend: function() {
                        swal({
                            title: "Espere, Guardando Usuario",
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
                $('.agregarUsuario').modal('hide');
                noti = Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            title: "¡Guardado!",
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'fa fa-check-circle',
                            msg: 'Usuario Guardado'
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

    $('#modificarUsuario').click(function() {
        $.ajax({
            url: "{{ url('superadmin/usuarios/ajax/update') }}",
            method: "post",
            data: $('#formEditarUsuario').serialize()
        }).done(function(data) {
            $('.editarUsuario').modal('hide');
            noti = Lobibox.notify('success', {
                pauseDelayOnHover: true,
                title: "¡Modificado!",
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'fa fa-check-circle',
                msg: 'Usuario Modificado'
            });
            cargar();
        });

    });

    function cargar() {
        $.ajax({
            url: "{{url('superadmin/usuarios/ajax/list')}}",
            method: "post",
            dataType: 'text',
            data: {
                '_token': "{{csrf_token()}}"
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Usuarios",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            TablaUsuarios.destroy();
            $('.TablaUsuarios').html(done);
            TablaUsuarios = $('#list_usuarios').DataTable({
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

    function verUsuario(id) {
        $.ajax({
            url: "{{ url('superadmin/usuarios/ajax/show') }}/"+id,
            method: "post",
            data: {
                '_token': "{{csrf_token()}}"
            }
        }).done(function(data) {
$('[name="id"]').val(id);
$('[name="nombre_edit"]').val(data.name);
$('[name="correo_edit"]').val(data.email);
$('[name="cedula_edit"]').val(data.cedula);
$('[name="direccion_edit"]').val(data.direccion);
$('[name="celular_edit"]').val(data.celular);
$('[name="telefono_edit"]').val(data.telefono);
$('[name="cuentatipo_edit"]').val(data.user_type);
$('[name="cuentatipo_edit"]').trigger('change');
            $('.editarUsuario').modal('show');
        });
    }

    function borrarUsuario(id) {
                    swal({
                        title: "¿Estas seguro de ELIMINAR el Usuario?",
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
                                url: "{{url('superadmin/usuarios/ajax/destroy')}}/"+id,
                                method: "post",
                                dataType: 'text',
                                data: {
                                    _token: "{{csrf_token()}}"
                                }
                            }).done(function(data) {
                                swal({
                                    title: "Usuario Eliminado con éxito",
                                    icon: "success",
                                    buttons: false,
                                    timer: 1000,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });

                                cargar();
                            });
                        }
                    });
    }
</script>
@endsection