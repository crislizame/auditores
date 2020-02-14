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
                            <ul class="nav lmhreporte mb-4">
                                <a href="#" onclick="cargar('loteria')">
                                    <li class="nav-item @if(request('cat') == "loteria") active @endif">Loteria</li>
                                </a>
                                <a href="#" onclick="cargar('proveedores')">
                                    <li href="#" class="nav-item @if(request('cat') == "proveedores") active @endif">Proveedores</li>
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

@endsection
@section('script')

<script>
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
                    ]
                });
            });
        }
    });
</script>
@endsection