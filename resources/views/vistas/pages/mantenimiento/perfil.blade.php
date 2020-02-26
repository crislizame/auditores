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
        <!-- Start Row principal -->
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body row">
                    <div class="col-lg-4">

                        <div class="form-group">
                            <label class="col-form-label">Nombre</label>
                            <div>
                                <input type="text" class="form-control" value="{{$user->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Foto</label>
                            <div class="col-8 offset-2">
                                <img class="img-thumbnail" src="https://images.pexels.com/photos/3568543/pexels-photo-3568543.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8">

                        <div class="form-group">
                            <label class="col-form-label">Dirección</label>
                            <div>
                                <input type="text" class="form-control" value="{{$user->direccion}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Celular</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$user->celular}}" readonly>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label class="col-form-label">Teléfono</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$user->telefono}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Hora de entrada</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$user->h_entrada}}" readonly>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label class="col-form-label">Cédula</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$user->cedula}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Hora de salida</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$user->h_salida}}" readonly>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label class="col-form-label">Calificación</label>
                                <div class="border rounded text-center mb-4" style="min-height: 80px;">
                                    <label class="col-form-label">Rango de cumplimiento</label>
                                    <span class="text-center" id="p_compliance"></span>
                                </div>
                                <div class="border rounded text-center" style="min-height: 80px;">
                                    <label class="col-form-label">Grado de satisfacción</label>
                                    <span class="text-center" id="p_satisfaction"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('script')

<script>
    $(document).ready(function() {
        {
            {
                --
                var tablePDS = $('#list_pds').DataTable({
                    "lengthMenu": [
                        [25, 50, 100, -1],
                        [25, 50, 100, "Todos"]
                    ]
                });

                //comisionista/listas/ajax/cargarPDS
                cargarPDS();

                function cargarPDS() {

                    $.ajax({
                        url: "{{route('cargarpds')}}",
                        method: "post",
                        dataType: 'text',
                        data: {
                            '_token': "{{csrf_token()}}"
                        },
                        beforeSend: function() {
                            //$('.btnPDSEditar').removeAttr('disabled');
                            swal({
                                title: "Cargando PDS",
                                icon: "info",
                                buttons: false,
                                timer: 2000,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });
                        }
                    }).done(function(done) {
                        tablePDS.destroy();
                        //$('.btnPDSEditar').attr('disabled');
                        $('.PDSTabla').html(done);
                        tablePDS = $('#list_pds').DataTable({
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
                --
            }
        }
    });
</script>
@endsection