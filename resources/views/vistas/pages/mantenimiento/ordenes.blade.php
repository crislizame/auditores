@extends('vistas.layout.mantenimiento')

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <ul class="nav lmhorizontal mb-4" style="grid-template-columns: repeat(2, 1fr);">
                                <a href="{{url('mantenimiento/ordenes')}}?cat=loteria">
                                    <li class="nav-item @if($cat == 'loteria') active @endif">Loteria</li>
                                </a>
                                <a href="{{url('mantenimiento/ordenes')}}?cat=proveedores">
                                    <li href="#" class="nav-item @if($cat == 'proveedores') active @endif">Proveedores</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    @if($cat == "loteria")
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
                    @elseif($cat == "proveedores")
                    <table class="table" id="list_problemas">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>N. de Orden</th>
                                <th>Entidad</th>
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
                    @endif
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
                <form id="form-asignarOrden" method="POST" autocomplate="off" action="{{url('mantenimiento/problemas/orden/asignar')}}" enctype="multipart/form-data">
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
                                <div class="col-6" id="sel-pro" style="display: none;">
                                    <select name="ot_proveedor">
                                        @foreach ($proveedores as $proveedor)
                                        <option value="{{$proveedor->idproveedores}}">{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6" id="tex-ent" style="display: none;">
                                    <h5 id="ot_entidad"></h5>
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
                                    <h5 id="ot_tiempo"></h5>
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
                                <div class="col-6" id="cc">
                                    <label>Cotización <i class="fa fa-upload"></i> Cargar imagen</label>
                                    <input type="file" class="form-control-file border" name="ot_ccotizacion">
                                </div>
                                <div class="col-6" id="cv" style="display: none;">
                                    <label>Cotización <i class="fa fa-eye"></i><a href="#" id="cvl"> Ver</a></label>
                                </div>
                                <div class="col-6" id="gc">
                                    <label>Garantía <i class="fa fa-upload"></i> Cargar imagen</label>
                                    <input type="file" class="form-control-file border" name="ot_cgarantia">
                                </div>
                                <div class="col-6" id="gv" style="display: none;">
                                    <label>Garantía <i class="fa fa-eye"></i><a href="#" id="gvl"> Ver</a></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="display: none;" id="gb-g">
                            <a onclick="finalizar()" class="btn btn-primary float-right text-white">Finalizar</a>
                            <button type="submit" class="btn btn-primary float-right mr-3" id="benviar">Procesar</button>
                        </div>
                        <div class="col-12" style="display: none;" id="gb-c">
                            <button type="button" class="btn btn-default float-right" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-va" tabindex="-1" role="dialog" aria-labelledby="modal-va" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="vat"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-2">
                <img class="img-responsive" id="vai">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    var tableProblemas;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $(document).ready(function() {
        tableProblemas = $('#list_problemas').DataTable({
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ]
        });

        cargar('{{$cat}}');
        $('select').select2();

        $('.modal-asignar').on('hidden.bs.modal', function(e) {
            document.getElementById("form-asignarOrden").reset();
        });

        function cargar(cat) {

            $.ajax({
                url: "{{url('mantenimiento/ordenes/cargar')}}",
                method: "post",
                dataType: 'text',
                data: {
                    '_token': "{{csrf_token()}}",
                    'cat': cat
                },
                beforeSend: function() {
                    swal({
                        title: "Cargando Ordenes",
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

    function modalAsignarOrdenDeTrabajo(id, visualId, entidad) {
        $.ajax({
            url: "{{url('mantenimiento/problemas/orden')}}",
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
        }).done(function(data) {
            var done = data[0];

            $('.modal-asignar').modal('show');
            $('#req_num_orden').html(visualId);
            $('[name="req_num_orden"]').val(id);

            $('#req_cliente').html(done.cliente);
            $('#req_area').html(done.area);
            $('#req_subarea').html(done.subarea);

            $('#req_problema').html(done.problema);

            $('#req_rfinicio').html(done.solicitado);
            $('#ot_finicio').html(done.solicitado);

            $('#req_comentario').html(done.rcomentario);

            $('[name="req_observacion"]').html(done.robservacion);

            $.ajax({
                url: "{{url('mantenimiento/problemas/imagenes')}}",
                method: "post",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id
                }
            }).done(function(ok) {
                $('#req_imagenes > .carousel-indicators').empty();
                var indicators = '';
                for (var i = 0; i < ok.count; i++) {
                    var active = '';
                    if (i == 0) {
                        active = 'active';
                    }
                    indicators += '<li data-target="#req_imagenes" data-slide-to="' + i + '" class="' + active + '"></li>';
                }
                $('#req_imagenes > .carousel-indicators').html(indicators);
                $('#req_imagenes > .carousel-inner').empty();
                $('#req_imagenes > .carousel-inner').html(ok.images);
            });

            $('#ot_tiempo').html(zfill(done.tiempo, 2) + ":00");

            if (done.enproceso != null) {
                $('[name="ot_proveedor"]').val(done.proveedor_id);
                $('[name="ot_proveedor"]').select2().trigger('change');

                switch (done.estado) {
                    case 'U':
                        $('#r1').click();
                        break;
                    case 'S':
                        $('#r2').click();
                        break;
                }

                $('#ot_ffin').html(done.finalizado);

                $('[name="ot_presupuesto"]').val(done.presupuesto);
                $('[name="ot_garantia"]').val(done.garantia);

                $('[name="ot_encargado"]').val(done.encargado);
                $('[name="ot_extra"]').val(done.extra);

                $('[name="ot_comentario"]').val(done.comentario);

                $('#benviar').prop('disabled', true);
                $('#benviar').removeClass('btn-primary');
                $('#benviar').addClass('btn-default');

                var otrabajo = done.idorden_trabajos;
                $.ajax({
                    url: "{{url('mantenimiento/problemas/trabajo/ver')}}",
                    method: "post",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': otrabajo,
                        'tipo': 'C'
                    }
                }).done(function(ok) {
                    if (ok.attachment_id > 0) {
                        $('#cc').hide();
                        $('#cv').show();
                        $('#cvl').attr('onclick', 'modalImagenTrabajo("{{url("/imagen")}}/' + ok.attachment_id + '", "Cotización")');
                    } else {
                        $('#cc').show();
                        $('#cv').hide();
                        $('#cvl').removeAttr('onclick');
                    }
                });

                $.ajax({
                    url: "{{url('mantenimiento/problemas/trabajo/ver')}}",
                    method: "post",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id': otrabajo,
                        'tipo': 'G'
                    }
                }).done(function(ok) {
                    if (ok.attachment_id > 0) {
                        $('#gc').hide();
                        $('#gv').show();
                        $('#gvl').attr('onclick', 'modalImagenTrabajo("{{url("/imagen")}}/' + ok.attachment_id + '", "Garantía")');
                    } else {
                        $('#gc').show();
                        $('#gv').hide();
                        $('#gvl').removeAttr('onclick');
                    }
                });
            }

            if (entidad == "{{(new App\Entidad())->where('identidad',Auth::user()->entidad_id)->value('nombre')}}") {
                $('#sel-pro').show();

                if(done.finalizado!=null){
                    $('#gb-c').show();
                }else{
                    $('#gb-g').show();
                }
            } else {
                $('#tex-ent').show();
                $('#ot_entidad').html(done.entidad);

                $('[name="ot_presupuesto"]').attr('readonly', 'true');
                $('[name="ot_garantia"]').attr('readonly', 'true');
                $('[name="ot_encargado"]').attr('readonly', 'true');
                $('[name="ot_extra"]').attr('readonly', 'true');
                $('[name="ot_comentario"]').attr('readonly', 'true');

                $('#cc').hide();
                $('#gc').hide();

                $('#gb-c').show();
            }
        });
    }

    function modalImagenTrabajo(url, tipo) {
        $('#vat').html(tipo);
        $('#vai').attr('src', url);
        $('.modal-va').modal('show');
    }

    function zfill(number, width) {
        var numberOutput = Math.abs(number);
        var length = number.toString().length;
        var zero = "0";

        if (width <= length) {
            if (number < 0) {
                return ("-" + numberOutput.toString());
            } else {
                return numberOutput.toString();
            }
        } else {
            if (number < 0) {
                return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
            } else {
                return ((zero.repeat(width - length)) + numberOutput.toString());
            }
        }
    }

    function finalizar() {
        $.ajax({
            url: "{{url('mantenimiento/problemas/finalizar')}}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': $('[name="req_num_orden"]').val()
            }
        }).done(function(ok) {
            location.reload();
        });
    }
</script>
@endsection