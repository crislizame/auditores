@extends('vistas.layout.dash')

@section('content')
<div class="container-fluid ">
    <div class="row ">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body row">

                    <form id="formeditComisionistas" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información Personal</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <img class="img-thumbnail" src="https://devtemporal92.grupolizame.com/person.jpg">
                            </div>
                            <div class="col-6">
                                <div class="form-group col-md-12">
                                    <label>Nombre completo</label>
                                    <input class="form-control" name="nombre" type="text" value="{{$user->name}}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Cédula</label>
                                    <input class="form-control" name="cedula" type="text" value="@if($user->cedula!=null){{$user->cedula}}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Contraseña de App</label>
                                <input class="form-control" name="claveapp" type="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Dirección</label>
                                <input class="form-control" name="direccion" type="text" value="@if($user->direccion!=null){{$user->direccion}}@endif">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Correo</label>
                                <input class="form-control" name="correo" type="text" value="$user->email">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection