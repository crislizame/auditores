@extends('vistas.layout.mantenimiento')

@section('content')
<div class="container-fluid ">
    <div class="row ">
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
                        @if($user->attachment_id!=null)
                        <div class="form-group">
                            <label class="col-form-label">Foto</label>
                            <div class="col-8 offset-2">
                                <img class="img-thumbnail" src="{{url('/imagen/' . $user->attachment_id)}}">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="col-form-label">Dirección</label>
                            <div>
                                <input type="text" class="form-control" value="@if($user->direccion!=null){{$user->direccion}}@endif" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Celular</label>
                                <div>
                                    <input type="text" class="form-control" value="@if($user->celular!=null){{$user->celular}}@endif" readonly>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-form-label">Teléfono</label>
                                <div>
                                    <input type="text" class="form-control" value="@if($user->telefono!=null){{$user->telefono}}@endif" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Hora de entrada</label>
                                <div>
                                    <input type="text" class="form-control" value="@if($user->h_entrada!=null){{$user->h_entrada}}@endif" readonly>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-form-label">Cédula</label>
                                <div>
                                    <input type="text" class="form-control" value="@if($user->cedula!=null){{$user->cedula}}@endif" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-form-label">Hora de salida</label>
                                <div>
                                    <input type="text" class="form-control" value="@if($user->h_salida!=null){{$user->h_salida}}@endif" readonly>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-form-label">Calificación</label>
                                <div class="border rounded text-center mb-4" style="min-height: 80px;">
                                    <label class="col-form-label">Rango de cumplimiento</label>
                                    <br>
                                    <label class="col-form-label"><b>{{ $cumple }}</b></label>
                                </div>
                                <div class="border rounded text-center" style="min-height: 80px;">
                                    <label class="col-form-label col">Grado de satisfacción</label>
                                    <br>
                                        <div class="calificacion mx-auto"></div>
                                    @php
                                        $porcentaje = 0;
                                        switch($calificacion){
                                            case 1:
                                                $porcentaje = 0;
                                                break;
                                            case 2:
                                                $porcentaje = 25;
                                                break;
                                            case 3:
                                                $porcentaje = 50;
                                                break;
                                            case 4:
                                                $porcentaje = 75;
                                                break;
                                            case 5:
                                                $porcentaje = 100;
                                                break;
                                        }
                                    @endphp
                                <label class="col-form-label col"><b>{{ $porcentaje }}%</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .calificacion {
        width: 80px;
        height: 80px;
        background-repeat: no-repeat;
        background-position: center;
        background-image:url("{{url('/img/cara')}}{{ $calificacion }}.jpg");
    }
</style>
@endsection
@section('script')
<script>
    $(document).ready(function() {

    });
</script>
@endsection