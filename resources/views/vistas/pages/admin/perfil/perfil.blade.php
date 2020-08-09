@extends('vistas.layout.dash')

@section('content')
<div class="container-fluid ">
    <div class="row ">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <form action="{{ url('perfil/modificar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información Personal</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6 text-center">
                                <label class="pt-2" for="profileImg">
                                    <img id="previewImg" src="@if($user->avatar != "users/default.png"){{ url('perfil') . '/'. $user->avatar }}@else{{'https://devtemporal92.grupolizame.com/person.jpg'}}@endif" class="img-thumbnail" alt=""/>
                                    <input type="file" id="profileImg" name="profileImg" style="display: none">
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
                                            }
                                        } else {
                                            alert("Solo se permiten archivos de imágenes!");
                                        }
                                    });
                                </script>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nombre completo</label>
                                    <input class="form-control" name="nombre" type="text" value="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Cédula</label>
                                    <input class="form-control" name="cedula" type="text" value="@if($user->cedula!=null){{$user->cedula}}@endif">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="form-control" name="clave" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input class="form-control" name="direccion" type="text" value="@if($user->direccion!=null){{$user->direccion}}@endif">
                                </div>
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input class="form-control" name="correo" type="text" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right mb-2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
