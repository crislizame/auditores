@extends('vistas.layout.mantenimiento')
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
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav mb-4">
                                <a href="#" onclick="cargar('loteria')">
                                    <li class="nav-item @if($cat == " loteria") active @endif">Loteria</li>
                                </a>
                                <a href="#" onclick="cargar('proveedores')">
                                    <li href="#" class="nav-item @if($cat == " proveedores") active @endif">Proveedores</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <table class="table" id="list_problemas">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>N. de Orden</th>
                                <th>Area</th>
                                <th>Sub Area</th>
                                <th>Problema</th>
                                <th>Cliente</th>
                                <th>Fecha reportado</th>
                                <th>Tiempo para resolver</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody class="TablaProblemas">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-asignar" tabindex="-1" role="dialog" aria-labelledby="modal-asignar" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="col-6">
                    <h4 class="modal-title text-white">Orden de Requerimiento</h4>
                </div>
                <div class="col-4">
                    <h4 class="modal-title text-white">Orden de Trabajo</h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="form-asignarOrden" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    <label>No. de Orden</label>
                                </div>
                                <div class="col-8">
                                    <h3 id="req_num_orden"></h3>
                                    <input type="hidden" name="req_num_orden">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label>WTC</label>
                                </div>
                                <div class="col-4">
                                    <label>Area</label>
                                </div>
                                <div class="col-4">
                                    <label>Sub Area</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <h5 id="req_cliente"></h5>
                                </div>
                                <div class="col-4">
                                    <h5 id="req_area"></h5>
                                </div>
                                <div class="col-4">
                                    <h5 id="req_subarea"></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Problema</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5 id="req_problema"></h5>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-4">
                                    <label>Fecha Inicio</label>
                                </div>
                                <div class="col-4">
                                    <label>Fecha Fin</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <h5 id="req_rfinicio"></h5>
                                </div>
                                <div class="col-4">
                                    <h5 id="req_rffin"></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Comentario</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5 id="req_comentario"></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Imágenes</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!--IMAGENES-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Observación de encargado de mantenimiento</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5 id="req_observacion"></h5>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary btn-crearagenda w-100">Generar Agenda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--
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
                    --}}

@endsection
@section('script')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $(document).ready(function() {
        var tableProblemas = $('#list_problemas').DataTable({
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ]
        });

        cargar('loteria');

        function cargar(cat) {

            $.ajax({
                url: "{{url('problemas/cargar')}}",
                method: "post",
                dataType: 'text',
                data: {
                    '_token': "{{csrf_token()}}",
                    'cat': cat
                },
                beforeSend: function() {
                    swal({
                        title: "Cargando Problemas",
                        icon: "info",
                        buttons: false,
                        timer: 2000,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    });
                }
            }).done(function(done) {
                tableProblemas.destroy();
                $('.TablaProblemas').html(done);
                tableProblemas = $('#list_problemas').DataTable({
                    "order": [
                        [0, 'desc']
                    ],
                    "lengthMenu": [
                        [25, 50, 100, -1],
                        [25, 50, 100, "Todos"]
                    ],
                    "columns": [{
                            "width": "10%"
                        },
                        {
                            "width": "10%"
                        },
                        {
                            "width": "10%"
                        },
                        {
                            "width": "15%"
                        },
                        {
                            "width": "20%"
                        },
                        {
                            "width": "10%"
                        },
                        {
                            "width": "10%"
                        },
                        {
                            "width": "15%"
                        }
                    ]
                });
            });
        }
    });

    function modalAsignarOrdenDeTrabajo(id, visualId) {
        $.ajax({
            url: "{{url('problemas/orden')}}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Datos de la orden",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            done = done[0];
            $('.modal-asignar').modal('show');
            $('#req_num_orden').html(visualId);
            $('[name="req_num_orden"]').val(id);

            $('#req_cliente').html(done.cliente);
            $('#req_area').html(done.area);
            $('#req_subarea').html(done.subarea);

            $('#req_problema').html(done.problema);

            $('#req_rfinicio').html(done.rfinicio);
            $('#req_rffin').html(done.rffin);
            
            $('#req_comentario').html(done.rcomentario);

            // IMAGENES

            $('#req_observacion').html(done.robservacion);

        });

    }
</script>
@endsection