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
                        <form method="POST" enctype="multipart/form-data" id="perfil">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label class="col-form-label">Foto</label>
                                <label class="pt" for="profileImg">
                                    <div class="col-8 offset-2">
                                        <img id="previewImg" src="@if($user->avatar != "users/default.png"){{ url('perfil') . '/'. $user->avatar }}@else{{'https://devtemporal92.grupolizame.com/person.jpg'}}@endif" class="img-thumbnail" alt=""/>
                                        <input type="file" id="profileImg" name="profileImg" style="display: none">
                                    </div>
                                </label>
                                <script>
                                    $("#profileImg").change(function () {
                                        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                                        if (regex.test($(this).val().toLowerCase())) {
                                            if (typeof (FileReader) != "undefined") {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#previewImg").attr("src", e.target.result);
                                                }
                                                reader.readAsDataURL($(this)[0].files[0]);
                                                $("#perfil").submit();
                                            }
                                        } else {
                                            alert("Solo se permiten archivos de imágenes!");
                                        }
                                    });
                                </script>
                            </div>
                        </form>
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