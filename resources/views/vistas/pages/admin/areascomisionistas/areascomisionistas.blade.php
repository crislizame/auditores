@extends('vistas.layout.dash')

@section('content')
<div class="container-fluid ">
    <div class="row mt-2">
        <div class="col-6 row">
            <div class="col-6">
                <span class="titulos text-info bold">Areas</span>
                <div class="card">
                    <div class="card-body" id="areas" style="padding: 0;">
                        <ul class="nav subm flex-column" data-toggle="buttons">
                            @foreach($areas as $area)
                            <li class="nav-item subm-item" data-toggle="button" aria-pressed="false">
                                <a class="nav-link subm-a p-5" href="#" onclick="buscarSubAreas(this)" data="{{ $area->idareas }}">{{ $area->nombre }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <span class="titulos text-info bold">SubAreas</span>
                <div class="card">
                    <div class="card-body" id="subareas" style="padding: 0;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <span class="titulos text-info bold">Problemas</span>
            <div class="card">
                <div class="card-body" id="problemas">
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4 offset-lg-4">
                    <button type="button" class="btn btn-primary btn-block waves-effect waves-light m-3" data-toggle="modal" data-target="#marea">Agregar Area</button>
                    <button type="button" class="btn btn-primary btn-block waves-effect waves-light m-3" data-toggle="modal" data-target="#msubarea">Agregar Subarea</button>
                    <button type="button" class="btn btn-primary btn-block waves-effect waves-light m-3" data-toggle="modal" data-target="#mproblema">Agregar Problema</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="marea" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Agregar Área</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{ url('comisionista/areas/agregar') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mx-auto">Seleccione la entidad</label>
                        <select name="entidad" class="form-control">
                            @foreach($entidades as $entidad)
                            <option value="{{ $entidad->identidad }}">{{ $entidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Nombre de nueva area</label>
                        <input type="text" name="area" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="msubarea" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Agregar Subárea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{ url('comisionista/subareas/agregar') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mx-auto">Seleccione el área</label>
                        <select name="area" class="form-control">
                            @foreach($areas as $area)
                            <option value="{{ $area->idareas }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Nombre de nueva subárea</label>
                        <input type="text" name="subarea" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mproblema" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Agregar Problema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{ url('comisionista/problemas/agregar') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mx-auto">Seleccione el área</label>
                        <select name="areasubareas" class="form-control" onchange="buscarAreasSubareas()">
                            @foreach($areas as $area)
                            <option value="{{ $area->idareas }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Seleccione la subárea</label>
                        <select name="subareasareas" class="form-control" disabled>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Nombre del nuevo problema</label>
                        <input type="text" name="problema" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Tiempo de solución en horas</label>
                        <input type="number" name="tiempo" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="meditproblema" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Editar Problema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form method="post" action="{{ url('comisionista/problema/modificar') }}">
                @csrf
                <input type="hidden" name="editid">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mx-auto">Seleccione el área</label>
                        <select name="editareasubareas" class="form-control" onchange="editBuscarAreasSubareas()">
                            @foreach($areas as $area)
                            <option value="{{ $area->idareas }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Seleccione la subárea</label>
                        <select name="editsubareasareas" class="form-control" disabled>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Nombre del nuevo problema</label>
                        <input type="text" name="editproblema" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="mx-auto">Tiempo de solución en horas</label>
                        <input type="number" name="edittiempo" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
    var delayTimer = null;
    var datos = null;

    $(document).ready(function() {
        $("#areas a").first().click();
        buscarAreasSubareas();
    });

    function buscarSubAreas(item) {
        $('#areas a').each(function() {
            $(this).removeClass('active');
        });
        $(item).addClass('active');

        $.ajax({
            url: "{{ url('comisionista/subareas') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': $(item).attr('data')
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Subareas",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            $('#subareas').html(done);
            $("#subareas a").first().click();
        });
    }

    function buscarProblemas(item) {
        $('#subareas a').each(function() {
            $(this).removeClass('active');
        });
        $(item).addClass('active');

        $.ajax({
            url: "{{ url('comisionista/problemas') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': $(item).attr('data')
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
            $('#problemas').html(done);
        });
    }

    function buscarAreasSubareas() {
        $.ajax({
            url: "{{ url('comisionista/subareas/buscar') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': $('[name="areasubareas"]').val()
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Subareas",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            $('[name="subareasareas"]').html(done);
            $('[name="subareasareas"]').removeAttr('disabled');
        });
    }
    
    function editBuscarAreasSubareas() {
        $.ajax({
            url: "{{ url('comisionista/subareas/buscar') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': $('[name="editareasubareas"]').val()
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Subareas",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            $('[name="editsubareasareas"]').html(done);
            $('[name="editsubareasareas"]').removeAttr('disabled');
        });
    }

    function mostrarProblema(id){
        $.ajax({
            url: "{{ url('comisionista/problema') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Problema",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            datos = done[0];
            
            $('[name="editid"]').val(id);

            $('[name="editareasubareas"] option[value="'+datos.area_id+'"]').attr("selected", true);
            $('[name="editareasubareas"]').change();

            delayTimer = setInterval(function() {
                if($('[name="editsubareasareas"]').attr('disabled') == undefined){
                    $('[name="editsubareasareas"] option[value="'+datos.subarea_id+'"]').attr("selected", true);
                    $('[name="editsubareasareas"]').change();

                    $('[name="editproblema"]').val(datos.nombre);

                    $('[name="edittiempo"]').val(datos.tiempo);

                    $("#meditproblema").modal("show");

                    clearInterval(delayTimer); 
                }else{
                    console.log("esperando");
                }
            }, 1000);
        });
    }
</script>
@endsection