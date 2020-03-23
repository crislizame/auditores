@extends('vistas.layout.mantenimiento')

@section('content')
<style>
    hr{
        border-top: 2px solid #52699B;
    }

    .titulos {
        font-weight: 400;
    }
</style>
<div class="container-fluid ">
    <div class="row ">

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
                                <td><a href="{{ url('/permisos/permisos') }}?pds={{ $row->id }}">{{ $row->pds_name }}</a></td>
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

                    <div class="row mt-3" id="detalles">
                        <div class="col-12">
                            @foreach($pds_permisos as $row)
                            <div class="row mt-3">
                                <div class="col-9">

                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="text-uppercase">{{ $row->nombre }}</h4>
                                        </div>
                                        <div class="col-2">
                                            <h4>Si</h2>
                                        </div>
                                        <div class="col-2">
                                            <h4>No</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-8">
                                            <h5>Estatus</h5>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" @if($row->aplica==1) checked @endif>
                                        </div>
                                        <div class="col-2">
                                            <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;" @if($row->aplica==0) checked @endif>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-7">
                                            <h5 class="titulos mt-2">Fecha de expedición</h5>
                                        </div>
                                        <div class="col-5">
                                            <input type="date" class="form-control" placeholder="00-00-0000" value="{{ $row->expedicion }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-2">
                                        <div class="col-7">
                                            <h5 class="titulos mt-2">Fecha de caducidad</h5>
                                        </div>
                                        <div class="col-5">
                                            <input type="date" class="form-control" placeholder="00-00-0000" value="{{ $row->caducidad }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-2">
                                        <div class="col-7">
                                            <h5 class="titulos mt-2">Conteo regresivo</h5>
                                        </div>
                                        <div class="col-5">
                                            @php
                                            $tiempo_restante = 0;
                                            if( date('Y-m-d') < $row->caducidad ){
                                                $tiempo_restante = \Carbon\Carbon::parse($row->caducidad)->diffForHumans();
                                            }
                                            @endphp
                                            <h4 class="mt-1">{{ $tiempo_restante }}</h4>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-3">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/tablefilter.js') }}"></script>
@endsection
@section('script')
<script>
    $(document).ready(function() {

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
</script>
@endsection