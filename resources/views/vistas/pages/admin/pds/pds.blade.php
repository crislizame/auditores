@extends('vistas.layout.dash')
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

    <div class="modal fade addComisionistaModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Agregar PDS</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formguardarComisionistas" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información PDS</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_name">Nombre del PDS</label>
                                <input class="form-control" id="pds_name" name="pds_name" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_cod">Código de establecimiento</label>
                                <input class="form-control" id="pds_cod" name="pds_cod" type="text">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información Personal</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_provincia">Provincia</label>
                                <select  class="form-control pds_ciudad" id="pds_provincia" name="pds_provincia">
                                    <option value="0">Provincia</option>
                                    @php
                                        $provinciasx = public_path('provincias.json');
                                        $abierto = file_get_contents($provinciasx);
                                        $provincias = json_decode($abierto);
                                    @endphp
                                    {{--                                asds--}}
                                    @forelse($provincias as $provincia)
                                        <option value="{{$provincia->provincia}}">{{$provincia->provincia}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_ciudad">Ciudad</label>
                                <select  class="form-control pds_ciudad" id="pds_ciudad" name="pds_ciudad">
                                    <option value="0">Ciudad</option>

                                    @forelse($provincias as $provincia)
                                        @forelse($provincia->cantones as $canton)
                                            <option value="{{$canton->canton}}">{{$canton->canton}}</option>
                                        @empty
                                        @endforelse
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_sventas">Supervisor de ventas</label>
                                <input class="form-control" id="pds_sventas" name="pds_sventas" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_recaudo">Recaudador</label>
                                <input class="form-control" id="pds_recaudo" name="pds_recaudo" type="text">

                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_logistic">Logistico</label>
                                <input class="form-control" id="pds_logistic" name="pds_logistic" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_direccion">Direccion</label>
                                <input class="form-control" id="pds_direccion" name="pds_direccion" type="text">

                            </div>


                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Contrato de arriendo</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_arrinicio">Inicio</label>
                                <input class="form-control" id="pds_arrinicio" name="pds_arrinicio" type="date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_arrfin">Fin</label>
                                <input class="form-control" id="pds_arrfin" name="pds_arrfin" type="date">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_fapertura">Fecha de apertura</label>
                                <input class="form-control" id="pds_fapertura" name="pds_fapertura" type="date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_telef">Teléfonos</label>
                                <input class="form-control" id="pds_telef" name="pds_telef" type="text">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_mt2">Mt2 del local</label>
                                <input class="form-control" id="pds_mt2" name="pds_mt2" type="text">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Horario de Lunes a Viernes y Sabados a Domingos</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="pds_lvapertura">Hora de Entrada L-V</label>
                                <input class="form-control" id="pds_lvapertura" name="pds_lvapertura" type="time">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_lvcierre">Hora de Salida L-V</label>
                                <input class="form-control" id="pds_lvcierre" name="pds_lvcierre" type="time">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_sapertura">Hora de Entrada S</label>
                                <input class="form-control" id="pds_sapertura" name="pds_sapertura" type="time">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_scierre">Hora de Salida S</label>
                                <input class="form-control" id="pds_scierre" name="pds_scierre" type="time">

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="pds_dapertura">Hora de Entrada Domingos</label>
                                <input class="form-control" id="pds_dapertura" name="pds_dapertura" type="time">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_dcierre">Hora de Salida Domingos</label>
                                <input class="form-control" id="pds_dcierre" name="pds_dcierre" type="time">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Permisos</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <div class="">Bomberos</div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="bsenal" name="bsenal">
                                    <label for="bsenal">Señaléticas</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="bextintores" name="bextintores">
                                    <label for="bextintores">Extintores</label>
                                </div>

                            </div>
                            <div class="form-group col-md-4">
                                <div class="">Municipales</div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="msuelo" name="msuelo">
                                    <label for="msuelo">Uso de suelo</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="msalud" name="msalud">
                                    <label for="msalud">Permiso del Ministerio de Salud</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="mpatente" name="mpatente">
                                    <label for="mpatente">Patente</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="mtasa" name="mtasa">
                                    <label for="mtasa">Tasa de habilitación</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox" id="mpermisoanterior" name="mpermisoanterior">
                                    <label for="mpermisoanterior">Permiso del año anterior</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="">Letreros</div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="lpermiso" name="lpermiso">
                                    <label for="lpermiso">Permiso</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="lotros" name="lotros">
                                    <label for="lotros">Otros</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btnGuardarComisionistas">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade editComisionistaModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary ">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Editar PDS</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formeditComisionistas" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información PDS</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <img width="100%" height="200px" style="max-height: 200px" id="img_editar" class="img-fluid p-2">
                            </div>
                            <div class="col-6">
                                <div class="form-group col-md-12">
                                    <label for="pds_name">Nombre del PDS</label>
                                    <input class="form-control" id="pds_name2" name="pds_name" type="text">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="pds_cod">Código de establecimiento</label>
                                    <input class="form-control" id="pds_cod2" name="pds_cod" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Información Personal</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_provincia">Provincia</label>
                                <select  class="form-control pds_ciudad" id="pds_provincia2" name="pds_provincia">
                                    <option value="0">Provincia</option>
                                    @php
                                        $provinciasx = public_path('provincias.json');
                                        $abierto = file_get_contents($provinciasx);
                                        $provincias = json_decode($abierto);
                                    @endphp
                                    {{--                                asds--}}
                                    @forelse($provincias as $provincia)
                                        <option value="{{$provincia->provincia}}">{{$provincia->provincia}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_ciudad">Ciudad</label>
                                <select  class="form-control pds_ciudad" id="pds_ciudad2" name="pds_ciudad">
                                    <option value="0">Ciudad</option>

                                    @forelse($provincias as $provincia)
                                        @forelse($provincia->cantones as $canton)
                                            <option value="{{$canton->canton}}">{{$canton->canton}}</option>
                                        @empty
                                        @endforelse
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_sventas">Supervisor de ventas</label>
                                <input class="form-control" id="pds_sventas2" name="pds_sventas" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_recaudo">Recaudador</label>
                                <input class="form-control" id="pds_recaudo2" name="pds_recaudo" type="text">

                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_logistic">Logistico</label>
                                <input class="form-control" id="pds_logistic2" name="pds_logistic" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_direccion">Direccion</label>
                                <input class="form-control" id="pds_direccion2" name="pds_direccion" type="text">

                            </div>


                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Contrato de arriendo</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_arrinicio">Inicio</label>
                                <input class="form-control" id="pds_arrinicio2" name="pds_arrinicio" type="text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_arrfin">Fin</label>
                                <input class="form-control" id="pds_arrfin2" name="pds_arrfin" type="text">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pds_fapertura">Fecha de apertura</label>
                                <input class="form-control" id="pds_fapertura2" name="pds_fapertura" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_telef">Teléfonos</label>
                                <input class="form-control" id="pds_telef2" name="pds_telef" type="text">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_mt2">Mt2 del local</label>
                                <input class="form-control" id="pds_mt22" name="pds_mt2" type="text">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Horario de Lunes a Viernes y Sabados a Domingos</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="pds_lvapertura">Hora de Entrada L-V</label>
                                <input class="form-control" id="pds_lvapertura2" name="pds_lvapertura" type="text">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_lvcierre">Hora de Salida L-V</label>
                                <input class="form-control" id="pds_lvcierre2" name="pds_lvcierre" type="text">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_sapertura">Hora de Entrada S</label>
                                <input class="form-control" id="pds_sapertura2" name="pds_sapertura" type="text">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="pds_scierre">Hora de Salida S</label>
                                <input class="form-control" id="pds_scierre2" name="pds_scierre" type="text">

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="pds_dapertura">Hora de Entrada Domingos</label>
                                <input class="form-control" id="pds_dapertura2" name="pds_dapertura" type="text">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="pds_dcierre">Hora de Salida Domingos</label>
                                <input class="form-control" id="pds_dcierre2" name="pds_dcierre" type="text">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">Permisos</div>
                                <hr class="pt-0 mt-0 text-black" style="color: black!important">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <div class="">Bomberos</div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="bsenal2" name="bsenal">
                                    <label for="bsenal2">Señaléticas</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="bextintores2" name="bextintores">
                                    <label for="bextintores2">Extintores</label>
                                </div>

                            </div>
                            <div class="form-group col-md-4">
                                <div class="">Municipales</div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="msuelo2" name="msuelo">
                                    <label for="msuelo2">Uso de suelo</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="msalud2" name="msalud">
                                    <label for="msalud2">Permiso del Ministerio de Salud</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="mpatente2" name="mpatente">
                                    <label for="mpatente2">Patente</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="mtasa2" name="mtasa">
                                    <label for="mtasa2">Tasa de habilitación</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox" id="mpermisoanterior2" name="mpermisoanterior">
                                    <label for="mpermisoanterior2">Permiso del año anterior</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="">Letreros</div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="lpermiso2" name="lpermiso">
                                    <label for="lpermiso2">Permiso</label>
                                </div>
                                <br>
                                <div class="icheck-primary">
                                    <input type="checkbox"  id="lotros2" name="lotros">
                                    <label for="lotros2">Otros</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btnComisionistasEditar">Guardar</button>
                        </div>
                    </form>
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

            $('form').on('submit', function() {
                return false;
            });
            $('.pds_ciudad').select2();

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
                    opcionesTabla();
                    tablePDS.on('search.dt draw.dt order.dt', function() {
                        opcionesTabla();
                    });
                });
            }

            function opcionesTabla() {
                $('.btnEditarComisionista').click(function() {
                    var id = $(this).attr('data-id');
                    $('.editComisionistaModal').modal('show');
                    $.ajax({
                        url: "{{route('pds/listas/ajax/mostrarpds')}}",
                        method: "post",
                        dataType: 'json',
                        data: {
                            comi_id: id,
                            '_token': "{{csrf_token()}}"
                        },
                        beforeSend: function() {
                            $('#pds_name2').val('');
                            $('#pds_ciudad2').val(0)
                                .trigger('change');
                            $('#pds_provincia2').val(0)
                                .trigger('change');
                            $('#pds_cod2').val('');
                            $('#pds_sventas2').val('');
                            $('#pds_fapertura2').val('');

                            $('#pds_direccion2').val('');
                            $('#pds_arrinicio2').val('');
                            $('#pds_arrfin2').val('');
                            $('#pds_mt22').val('');
                            $('#pds_lvapertura2').val('');
                            $('#pds_lvcierre2').val('');
                            $('#pds_sapertura2').val('');
                            $('#pds_scierre2').val('');
                            $('#pds_dapertura2').val('');
                            $('#pds_dcierre2').val('');
                            $('#pds_logistic2').val('');
                            $('#pds_recaudo2').val('');
                            $('#pds_telef').val('');
                            $('#img_editar').attr('src',"");
                            $('#bsenal2').removeAttr('checked');
                            $('#bextintores2').removeAttr('checked');
                            $('#msuelo2').removeAttr('checked');
                            $('#msalud2').removeAttr('checked');
                            $('#mpatente2').removeAttr('checked');
                            $('#mtasa2').removeAttr('checked');
                            $('#mpermisoanterior2').removeAttr('checked');
                            $('#lpermiso2').removeAttr('checked');
                            $('#lotros2').removeAttr('checked');

                        }
                    }).done(function(data) {
                        //asdasdasd
                        $('#formeditComisionistas').attr('data-id', id);
                        $('#pds_ciudad2').val(data[0].pds_ciudad).trigger('change');
                        $('#pds_provincia2').val(data[0].pds_provincia).trigger('change');
                        var date1 = $('#pds_ciudad2').select2('data');
                        $('#pds_ciudad2').trigger({
                            type: 'select2:select',
                            params: {
                                data: date1[0]

                            }
                        });
                        var date = $('#pds_provincia2').select2('data');
                        $('#pds_provincia2').trigger({
                            type: 'select2:select',
                            params: {
                                data: date[0]

                            }
                        });
                        $('#pds_name2').val(data[0].pds_name);
                        $('#pds_cod2').val(data[0].pds_cod);
                        $('#pds_sventas2').val(data[0].pds_sventas);
                        $('#pds_fapertura2').val(data[0].pds_fapertura);
                        if(data[0].attach == null || data[0].attach == "null" ){
                            $('#img_editar').attr('src',"{{asset('nego.png')}}");
                        }else{
                            $('#img_editar').attr('src',"{{url('imagen')}}/"+data[0].attach);
                        }

                        $('#pds_direccion2').val(data[0].pds_direccion);
                        $('#pds_arrinicio2').val(data[0].pds_arrinicio);
                        $('#pds_arrfin2').val(data[0].pds_arrfin);
                        $('#pds_mt22').val(data[0].pds_mt2);
                        $('#pds_lvapertura2').val(data[0].pds_lvapertura);
                        $('#pds_lvcierre2').val(data[0].pds_lvcierre);
                        $('#pds_sapertura2').val(data[0].pds_sapertura);
                        $('#pds_scierre2').val(data[0].pds_scierre);
                        $('#pds_dapertura2').val(data[0].pds_dapertura);
                        $('#pds_dcierre2').val(data[0].pds_dcierre);
                        $('#pds_logistic2').val(data[0].pds_logistic);
                        $('#pds_recaudo2').val(data[0].pds_recaudo);
                        $('#pds_telef2').val(data[0].pds_telef);
                        if(data[1].bsenal === "true"){
                            $('label[for="bsenal2"]').click();

                        }
                        if(data[1].bextintores === "true"){
                            $('label[for="bextintores2"]').click();

                        }
                        if(data[1].msuelo === "true"){
                            $('label[for="msuelo2"]').click();

                        }
                        if(data[1].msalud === "true"){
                            $('label[for="msalud2"]').click();

                        }
                        if(data[1].mpatente === "true"){
                            $('label[for="mpatente2"]').click();

                        }
                        if(data[1].mtasa === "true"){
                            $('label[for="mtasa2"]').click();

                        }
                        if(data[1].mpermisoanterior === "true"){
                            $('label[for="mpermisoanterior2"]').click();

                        }
                        if(data[1].lpermiso === "true"){
                            $('label[for="lpermiso2"]').click();

                        }
                        if(data[1].lotros === "true"){
                            $('label[for="lotros2"]').click();
                        }

                    });
                });
                $('.btnEliminarComisionista').click(function() {
                    var id = $(this).attr('data-id');
                    swal({
                        title: "¿Estas seguro de ELIMINAR el PDS?",
                        icon: "warning",
                        buttons: {
                            cancel: {
                                text: "NO",
                                className: "btn-danger shadow-danger",
                                visible: true,
                                closeModal: true,
                            },
                            willsuccess: "Eliminar"


                        },
                        dangerMode: false,
                    }).then((willsuccess) => {
                        if (willsuccess) {
                            $.ajax({
                                url: "{{route('pds/listas/ajax/eliminarPDS')}}",
                                method: "post",
                                dataType: 'text',
                                data: {
                                    comi_id: id,
                                    _token: "{{csrf_token()}}"
                                },
                                beforeSend: function() {

                                }
                            }).done(function(data) {
                                swal({
                                    title: "Pds Eliminado con éxito",
                                    icon: "success",
                                    buttons: false,
                                    timer: 1000,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });

                                cargarPDS();
                            });
                        }
                    });

                });
            }
            $('#formeditComisionistas').submit(function() {
                var formdata = $(this).serializeArray();
                var btncomi = $(this);
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{route('pds/listas/ajax/editarPDS')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        datos: formdata,
                        comi_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: function() {

                    }
                }).done(function(data) {
                    $('.editComisionistaModal').modal('hide');
                    noti = Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        title: "¡Guardardo!",
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'fa fa-check-circle',
                        msg: 'Edición Guardado'
                    });
                });

            });
            $('#formguardarComisionistas').submit(function() {
                var formdata = $(this).serializeArray();
                var btncomi = $(this);
                $.ajax({
                    url: "{{route('pds/listas/ajax/guardarPDS')}}",
                    method: "post",
                    dataType: 'text',
                    data: {
                        datos: formdata,
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: function() {

                    }
                }).done(function(data) {
                    $('.addComisionistaModal').modal('hide');
                    noti = Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        title: "¡Guardardo!",
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'fa fa-check-circle',
                        msg: 'Edición Guardado'
                    });
                    cargarPDS();
                });

            });
        });
    </script>
@endsection
