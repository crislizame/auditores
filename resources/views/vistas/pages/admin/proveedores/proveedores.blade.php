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
    <div class="modal-dialog modal-lg" role="document">
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
                            <div class="text-center">Información Personal</div>
                            <hr class="pt-0 mt-0 text-black" style="color: black!important">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <img style="max-height: 200px" id="img_editar" class="img-fluid p-2" src="https://devtemporal92.grupolizame.com/person.jpg" width="90%" height="200px">
                        </div>
                        <div class="col-6">
                            <div class="form-group col-md-12">
                                <label for="aud_nombre">Razón social</label>
                                <input class="form-control" name="aud_nombre" type="text">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="aud_apellidos">Ruc/Cédula</label>
                                <input class="form-control" name="aud_cedula" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="aud_cedula">Telefono</label>
                            <input class="form-control" name="aud_telefono" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="aud_correo">Correo</label>
                            <input class="form-control" name="aud_correo" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="aud_direccion">Dirección</label>
                            <input class="form-control" name="aud_direccion" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="aud_cuentabanco">Banco</label>
                            <input class="form-control" name="aud_cuentabanco" type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="aud_cuentanumero">Cuenta Número</label>
                            <input class="form-control" name="aud_cuentanumero" type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="aud_cuentatipo">Cuenta Tipo</label>
                            <select class="form-control" id="aud_cuentatipo" name="aud_cuentatipo">
                                <option value="ahorro"> AHORRO</option>
                                <option value="corriente"> CORRIENTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
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

    $('#formCrearProveedor').submit(function() {
        var formdata = $(this).serializeArray();
        $.ajax({
            url: "{{ url('proveedores/listas/ajax/guardarProveedores') }}",
            method: "post",
            //dataType: 'text',
            data: {
                datos: formdata,
                _token: "{{csrf_token()}}"
            }
        }).done(function(data) {
            $('.agregarProveedor').modal('hide');
            noti = Lobibox.notify('success', {
                pauseDelayOnHover: true,
                title: "¡Guardardo!",
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'fa fa-check-circle',
                msg: 'Proveedor Guardado'
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
</script>
@endsection