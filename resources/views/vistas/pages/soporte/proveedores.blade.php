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

        $.ajax({
            url: "{{url('proveedores/cargar')}}",
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
                    }
                ]
            });
        });
    });
</script>
@endsection