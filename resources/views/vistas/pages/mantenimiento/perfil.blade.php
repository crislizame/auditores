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
                <div class="card-body">
                    <h5 class="card-title"><button data-toggle="modal" data-target=".addComisionistaModal" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar PDS</button></h5>
                    <table class="table" id="list_pds">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">ID</th>
                                <th>Punto de Suerte</th>
                                <th>Provincia</th>
                                <th>Ciudad</th>
                                <th>Supervisor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="PDSTabla">
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
    });
</script>
@endsection
