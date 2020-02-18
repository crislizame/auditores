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
                                    <h5 id="req_comentario" style="height: 80px;"></h5>
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
                                    <div class="col-8 offset-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="req_imagenes" class="carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                    </ol>
                                                    <div class="carousel-inner">
                                                    </div>
                                                    <a class="carousel-control-prev" href="#req_imagenes" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#req_imagenes" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <textarea class="form-control" name="req_observacion" rows="4"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">

                            <div class="row">
                                <div class="col-6">
                                    <label>Proveedor</label>
                                </div>
                                <div class="col-6">
                                    <label>Estado</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <select name="ot_proveedor">
                                        @forelse ((new \App\Proveedor())->get() as $proveedor)
                                        <option value="{{$proveedor->idproveedores}}">{{$proveedor->nombre}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ot_estado" id="r1" value="U" checked="">
                                                <label class="form-check-label" for="r1">
                                                    Urgente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ot_estado" id="r2" value="S">
                                                <label class="form-check-label" for="r2">
                                                    Seguimiento
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label>Fecha Inicio</label>
                                </div>
                                <div class="col-6">
                                    <label>Fecha Fin</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <h5 id="ot_finicio"></h5>
                                </div>
                                <div class="col-6">
                                    <h5 id="ot_ffin"></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label>Presupuesto</label>
                                </div>
                                <div class="col-6">
                                    <label>Garantía</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="ot_presupuesto" class="form-control">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="ot_garantia" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label>Encargado</label>
                                </div>
                                <div class="col-6">
                                    <label>Tiempo para resolver</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="ot_encargado" class="form-control">
                                </div>
                                <div class="col-6">
                                    <h3 id="ot_tiempo"></h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 offset-6">
                                    <label>Extra</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 offset-6">
                                    <input type="text" name="ot_extra" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label>Comentario</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <textarea class="form-control" name="ot_comentario" rows="4" placeholder="Incluir # de orden de compra"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label>Cotización <i class="fa fa-eye"></i><a href="#"> Ver</a></label>
                                </div>
                                <div class="col-6">
                                    <label>Garantía <i class="fa fa-eye"></i><a href="#"> Ver</a></label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary float-right">Completado</button>
                            <button type="button" class="btn btn-primary float-right mr-3" onclick="asignarOrdenDeTrabajo()">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
        $('select').select2();

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

            $.ajax({
                url: "{{url('problemas/imagenes')}}",
                method: "post",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id
                }
            }).done(function(done) {
                $('#req_imagenes > .carousel-indicators').empty();
                var indicators = '';
                for (var i = 0; i < done.count; i++) {
                    var active = '';
                    if (i == 0) {
                        active = 'active';
                    }
                    indicators += '<li data-target="#req_imagenes" data-slide-to="' + i + '" class="' + active + '"></li>';
                }
                $('#req_imagenes > .carousel-indicators').html(indicators);
                $('#req_imagenes > .carousel-inner').empty();
                $('#req_imagenes > .carousel-inner').html(done.images);
            });
        });

    }

    function asignarOrdenDeTrabajo() {

        $.post("{{url('problemas/orden/asignar')}}", $('#form-asignarOrden').serialize(), function(data, status, xhr) {
            console.log(status);
        });

        /*
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
        */
    }
</script>
@endsection