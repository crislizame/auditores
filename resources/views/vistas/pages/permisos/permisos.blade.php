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
                                @php
                                    // Permiso más próximo a vencerse
                                    $diferencia=0;
                                    $fechaMasProxima = \Illuminate\Support\Facades\DB::table('permisospds')->select('caducidad')->where('id_pds', $row->id)->orderBy('caducidad', 'ASC')->first();
                                    if($fechaMasProxima!=null){
                                        $diferencia = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($fechaMasProxima->caducidad), false);
                                    }
                                @endphp
                                <td><a href="#" onclick="buscarPermisos({{ $row->id }})">{{ $row->pds_name }}</a></td><td width="60"><h3>@if($fechaMasProxima!=null)@if($diferencia <= 30)<i class="fa fa-frown-o" style="color: red"></i>@elseif($diferencia > 30 && $diferencia < 180)<i class="fa fa-meh-o" style="color: orange"></i>@else<i class="fa fa-smile-o" style="color: green"></i>@endif @else<i class="fa fa-frown-o" style="color: red"></i>@endif</h3></td>
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
                    <div class="row mt-3 mx-0">
                        <div class="col-12" id="detalles">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-va" tabindex="-1" role="dialog" aria-labelledby="modal-va" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="pt"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-2">
                <img class="img-thumbnail" id="pi">
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

    function modalImagen(url, tipo) {
        $('#pt').html(tipo);
        $('#pi').attr('src', url);
        $('.modal-va').modal('show');
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
