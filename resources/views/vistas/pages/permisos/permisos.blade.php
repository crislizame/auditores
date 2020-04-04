@extends('vistas.layout.mantenimiento')

@section('content')
<style>
    hr {
        border-top: 2px solid #52699B;
    }

    .titulos {
        font-weight: 400;
    }
</style>
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <ul class="nav lmhorizontal mb-4" style="grid-template-columns: repeat(1, 1fr);">
                                <a href="#">
                                    <li class="nav-item active">Clientes</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <table class="table" id="tablaPDS">
                        <thead>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Buscar" onkeyup="filtrar()" id="buscar">
                            </div>
                        </thead>
                        <tbody>
                            @foreach($pds as $row)
                            <tr>
                                <td><a href="#" onclick="buscarPermisos({{ $row->id }})">{{ $row->pds_name }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <ul class="nav lmhorizontal mb-4" style="grid-template-columns: repeat(1, 1fr);">
                                <a href="#">
                                    <li class="nav-item active">Detalles</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12" id="detalles">
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
        $("#tablaPDS a").first().click();
    });

    function filtrar() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("buscar");
        filter = input.value.toUpperCase();
        table = document.getElementById("tablaPDS");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function buscarPermisos(id) {
        $.ajax({
            url: "{{ url('permisos/buscar') }}",
            method: "post",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id
            },
            beforeSend: function() {
                swal({
                    title: "Cargando Permisos",
                    icon: "info",
                    buttons: false,
                    timer: 2000,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }).done(function(done) {
            $('#detalles').html(done);
        });
    }
</script>
@endsection