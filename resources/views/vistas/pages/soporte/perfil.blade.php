@extends('vistas.layout.soporte')

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
                                <img class="img-thumbnail" src="{{url('soporte/imagen/' . $user->attachment_id)}}">
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

    });
</script>
@endsection