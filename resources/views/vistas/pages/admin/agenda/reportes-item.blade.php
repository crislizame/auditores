@extends('vistas.layout.dash')
@section('styles')
<style>
    .loadingc {
        background: #000000de;
        width: 100%;
        min-height: 100%;
        height: auto !important;
        position: fixed;
        top: 0;
        left: 0;
        float: left;
        z-index: 998;
        /*z-index: 1080;*/
    }

    .pepe {
        margin-top: 20%;
        height: 50%;
        width: 50%;
        margin-left: 35%;
        text-align: center;
    }

    .pds-lista-item:hover {
        background: #e3e3e3;
    }

    .lmhorizontal4 li a {}

    .lmhorizontal4 li a:hover {
        color: white;
    }

    .lmhorizontal4 li:hover a {
        color: white;
    }

    .lmhorizontal4 li.active a {
        color: white;
    }

    .lmhorizontal4 li.active:hover a:hover {
        color: white;
    }
</style>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="loadingc hidden">
        <div class="centrar pepe">
            <div class="progress mt-3 mb-4">
                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:100%"></div>
            </div>
            <span class="text-white"> Por favor espere mientras realizamos los cálculos de los indicadores.</span>

        </div>
    </div>
    @php
    $datos = (new \App\Auditoria_reporte())->where('idauditoria_reportes',request('id'))->first();
    $pdsdata = (new \App\Pdsperfile())->where('id',$datos->pds_id)->first();
    @endphp
    @if(request('cat') == "auditoria")
    <div class="row h-100">
        <!-- Start Row principal -->

        <div class="col-lg-12 mt-3">
            <div class="card m-0">
                <div class="card-body pl-0 pr-0 pb-0 pt-0">
                    <h2 class="titulos-categoria p-2 text-center">AUDITORIA GENERAL</h2>

                    <a target="_blank" href="{{route('imprimir/reportes-item')}}?cat=auditoria&id={{request('id')}}">
                        <h3 class="titulos-grandes p-2 text-center"><i class="fa fa-print text-white"></i> Ver en Formato de Impresión</h3>
                    </a>
                    <h2 class="titulos p-2 text-center">{{strtoupper($pdsdata->pds_name)}}</h2>
                    <h3 class="titulos p-2 text-center">Número de reporte: {{$datos->tipo.'-'.str_pad($datos->idauditoria_reportes, 7, "0", STR_PAD_LEFT)}}</h3>
                    <h3 class="titulos-negro p-2 text-center">{{\Carbon\Carbon::now()->format('d/m/Y')}}</h3>

                    <div class="col-lg-12 mb-2">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="row">
                                <div class="col titulos-visuales rounded p-2">
                                    <h2 class="titulos-categoria p-0">Estado</h2>
                                </div>
                                <div class="col titulos-visuales rounded p-2">
                                    <h2 class="titulos-categoria p-0">Activos</h2>
                                    <h1 class="titulos-categoria p-0"><i class="fa fa-check bg-success rounded-circle"></i></h1>
                                </div>
                                <div class="col titulos-visuales rounded p-2">
                                    <h2 class="titulos-categoria p-0">Perfil</h2>
                                    <h1 class="titulos-categoria p-0"><i class="fa fa-check bg-success rounded-circle"></i></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="titulos-grandes p-2 text-center">Perfil PDS</h3>
                    <table class="table ">
                        <tbody>
                            <tr>
                                <td><b>Nombre PDS:</b></td>
                                <td>{{strtoupper($pdsdata->pds_name)}}</td>
                            </tr>
                            <tr>
                                <td><b>Dirección</b></td>
                                <td>{{strtoupper($pdsdata->pds_direccion)}}</td>
                            </tr>
                            <tr>
                                <td><b>Provincia</b></td>
                                <td>{{strtoupper($pdsdata->pds_provincia)}}</td>
                            </tr>
                            <tr>
                                <td><b>Canton</b></td>
                                <td>{{strtoupper($pdsdata->pds_ciudad)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="titulos-grandes p-2 text-center">Comisionistas</h3>
                    <table class="table ">
                        <tbody>
                            @php
                            $comisionistas = (new \App\Comisionista())->where('pds_id',$pdsdata->id)->get();
                            @endphp
                            @forelse($comisionistas as $com)
                            <tr>
                                <td>{{strtoupper($com->nombres)}} {{strtoupper($com->apellidos)}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <h3 class="titulos-grandes p-2 text-center">Estado</h3>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','estado')->get();
                    @endphp
                    @forelse($datosverticales as $dv)
                    <h5 class="titulos p-2 ml-5" id="tituloaux{{$dv->idencaudit}}">{{ucfirst($dv->nombre_estado)}}</h5>
                    <table class="table">
                        <tbody>
                            @php
                            $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                            $promcaritas = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->count();
                            $valores = 0;
                            @endphp
                            @forelse($thc as $th)

                            @php
                            $encuesta = (new \App\Encauditdata())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id, 'auditor_id'=>$datos->auditor_id]);
                            $id = $encuesta->value('idencauditdatas');
                            $valor = 0;
                            if($encuesta->value('carita')>0){
                            switch ((int)$encuesta->value('carita')) {
                            case 1:
                            $valor = 0;
                            break;
                            case 2:
                            $valor = 25;
                            break;
                            case 3:
                            $valor = 50;
                            break;
                            case 4:
                            $valor = 75;
                            break;
                            case 5:
                            $valor = 100;
                            break;
                            }
                            $valores += $valor;
                            }
                            @endphp
                            <tr>
                                <td width="30%"><b>{{ucfirst($th->nombre_val)}}</b></td>
                                <td width=75>
                                    <h2 class="p-2 text-right">{{$valor}}%</h2>
                                </td>
                                <td width=75><img src="{{asset('img/cara'.$encuesta->value('carita').'.jpg')}}" width="50px" alt="carita"></td>
                                <td width="50%">
                                    <div class="rounded border border-dark">
                                        <b>{{ucfirst($encuesta->value('observa'))}}</b>
                                    </div>
                                </td>
                                <td><button data-id="{{$id}}" class="btn btn-sm btn-primary btn-verfotos">Ver Fotos</button></td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <script>
                            var tituloaux{{$dv->idencaudit}} = '{{ucfirst($dv->nombre_estado)}} <span class="border border-info rounded">{{number_format($valores/$promcaritas, 2, '.', '')}}%</span>';
                            $(document).ready(function(){
                                $('#tituloaux{{$dv->idencaudit}}').html(tituloaux{{$dv->idencaudit}});
                            });
                        </script>
                    </table>
                    @empty
                    @endforelse
                    <h3 class="titulos-grandes p-2 text-center">Activo</h3>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','activos')->get();
                    @endphp
                    @forelse($datosverticales as $dv)
                    <h5 class="titulos p-2">{{ucfirst($dv->nombre_estado)}}</h5>
                    @php
                    $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                    @endphp
                    @forelse($thc as $th)
                    <h6 class="titulos p-2"><b>{{ucfirst($th->nombre_val)}}</b></h6>
                    <table class="table ">


                        <tbody>

                            <tr>
                                <td width="25%"><b>Código</b></td>
                                <td><b>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('codigo')}}</b></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Cantidad</b></td>
                                <td>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('cantidad')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Marca</b></td>
                                <td>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('marca')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Modelo</b></td>
                                <td>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('Modelo')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Color</b></td>
                                <td>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('color')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Propiedad</b></td>
                                <td>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('propiedad') == 0 ? "Propio" : "Alquilado"}}</td>
                            </tr>
                            <tr>
                                <td width="30%"><b>Observación</b></td>
                                <td>{{(new \App\Encauditdataactivo())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('observa')}}</td>
                            </tr>

                        </tbody>

                    </table>
                    @empty
                    @endforelse
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- End Submenu -->
    <!--Start Dashboard Content-->
    @endif
    @if(request('cat') == "procesos")
    <div class="row h-100">
        <!-- Start Row principal -->

        <div class="col-lg-12 mt-3">
            <div class="card m-0">
                <div class="card-body pl-0 pr-0 pb-0 pt-0">
                    <h6 class="titulos-grandes p-2 text-white"><a class="text-white" target="_blank" href="{{route('imprimir/reportes-item')}}?cat=procesos&id={{request('id')}}"> <i class="fa fa-print "></i>Ver en Formato de Impresión</a></h6>
                    <h3 class="titulos-grandes p-2">Perfil PDS</h3>
                    <table class="table ">
                        <tbody>
                            <tr>
                                <td><b>Nombre PDS:</b></td>
                                <td>{{strtoupper($pdsdata->pds_name)}}</td>
                            </tr>
                            <tr>
                                <td><b>Dirección</b></td>
                                <td>{{strtoupper($pdsdata->pds_direccion)}}</td>
                            </tr>
                            <tr>
                                <td><b>Provincia</b></td>
                                <td>{{strtoupper($pdsdata->pds_provincia)}}</td>
                            </tr>
                            <tr>
                                <td><b>Canton</b></td>
                                <td>{{strtoupper($pdsdata->pds_ciudad)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="titulos-grandes p-2">Comisionistas</h3>
                    <table class="table ">
                        <tbody>
                            @php
                            $comisionistas = (new \App\Comisionista())->where('pds_id',$pdsdata->id)->get();
                            @endphp
                            @forelse($comisionistas as $com)
                            <tr>
                                <td>{{strtoupper($com->nombres)}} {{strtoupper($com->apellidos)}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <h3 class="titulos-grandes p-2">Procesos</h3>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','procesos')->get();
                    @endphp
                    @forelse($datosverticales as $dv)
                    <h5 class="titulos p-2">{{ucfirst($dv->nombre_estado)}}</h5>
                    <table class="table ">
                        <tbody>
                            @php
                            $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                            @endphp
                            @forelse($thc as $th)
                            <tr>
                                <td width="50%"><b>{{ucfirst($th->nombre_val)}}</b></td>
                                <td><img src="{{asset('img/cara'.(new \App\Encauditdata())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('carita').'.jpg')}}" width="50px" alt="carita"></td>
                                <td width="25%"><b>{{ucfirst((new \App\Encauditdata())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('observa'))}}</b></td>

                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @empty
                    @endforelse
                    <h3 class="titulos-grandes p-2">Arqueo de Caja</h3>
                    <h5 class="titulos p-2">Monedas</h5>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th style="text-align: center">Denominación</th>
                                <th style="text-align: center">Cantidad</th>
                                <th style="text-align: center">Suma</th>
                            </tr>
                        </thead>
                        @php

                        $arqueos = (new \App\Arqueocaja())->where(['pds_id'=>$datos->pds_id,'agenda_id'=>$datos->agenda_id])->first();
                        $sumacant = $arqueos->m001+$arqueos->m005+$arqueos->m010+$arqueos->m025+$arqueos->m050+$arqueos->m100+$arqueos->b100+$arqueos->b500+$arqueos->b1000+$arqueos->b2000+$arqueos->b5000+$arqueos->b10000;
                        $sumatotal = ($arqueos->m001*0.01)+($arqueos->m005*0.05)+($arqueos->m010*0.10)+($arqueos->m025*0.25)+($arqueos->m050*0.50)+($arqueos->m100*1.00)+($arqueos->b100*1.00)+($arqueos->b500*5.00)+($arqueos->b1000*10.00)+($arqueos->b2000*20.00)+($arqueos->b5000*50.00)+($arqueos->b10000*100.00);
                        $diferencia = ($sumatotal) - $arqueos->sumapos;
                        @endphp
                        <tbody>
                            <tr>
                                <td style="text-align: center">$ 0.01</td>
                                <td style="text-align: center">{{$arqueos->m001}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->m001*0.01),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 0.05</td>
                                <td style="text-align: center">{{$arqueos->m005}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->m005*0.05),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 0.10</td>
                                <td style="text-align: center">{{$arqueos->m010}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->m010*0.10),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 0.25</td>
                                <td style="text-align: center">{{$arqueos->m025}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->m025*0.25),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 0.50</td>
                                <td style="text-align: center">{{$arqueos->m050}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->m050*0.50),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 1.00</td>
                                <td style="text-align: center">{{$arqueos->m100}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->m100*1.00),2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="titulos p-2">Billetes</h5>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th style="text-align: center">Denominación</th>
                                <th style="text-align: center">Cantidad</th>
                                <th style="text-align: center">Suma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center">$ 1.00</td>
                                <td style="text-align: center">{{$arqueos->b100}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->b100*1.00),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 5.00</td>
                                <td style="text-align: center">{{$arqueos->b500}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->b500*5.00),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 10.00</td>
                                <td style="text-align: center">{{$arqueos->b1000}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->b1000*10.00),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 20.00</td>
                                <td style="text-align: center">{{$arqueos->b2000}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->b2000*20.00),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 50.00</td>
                                <td style="text-align: center">{{$arqueos->b5000}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->b5000*50.00),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">$ 100.00</td>
                                <td style="text-align: center">{{$arqueos->b10000}}</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->b10000*100.00),2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="titulos p-2">Conciliación del arqueo realizado</h5>
                    <table class="table ">

                        <tbody>
                            <tr>
                                <td style="text-align: center">Arqueo Físico</td>
                                <td style="text-align: center">{{$sumacant}}</td>
                                <td style="text-align: center">$ {{number_format($sumatotal,2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">Arqueo de POS</td>
                                <td style="text-align: center">-</td>
                                <td style="text-align: center">$ {{number_format(($arqueos->sumapos),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center">Diferencia</td>
                                <td style="text-align: center">-</td>
                                <td style="text-align: center">$ {{number_format(($diferencia),2)}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"></td>
                                <td style="text-align: center"></td>
                                <td style="text-align: center"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">Observación</td>
                                <td style="text-align: center" colspan="2">{{$arqueos->observacion}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- End Submenu -->
    <!--Start Dashboard Content-->
    @endif

    <!--End Dashboard Content-->
</div><!-- End Row principal -->

<div class="modal fade modal-verfotos" tabindex="-1" role="dialog" aria-labelledby="modal-verfotos" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modal-crear">Ver Fotos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row imagenes-id">



                </div>

            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="{{asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<script src="{{asset('assets/plugins/Chart.js/Chart.min.js')}}"></script>
<script>
    $(document).ready(function() {
        @if(request('cat') == "auditoria")
        $('.btn-verfotos').click(function() {
            $('.modal-verfotos').modal('show');
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('agenda/getimages')}}",
                method: "post",
                dataType: 'text',
                data: {
                    'id': id,
                    '_token': "{{csrf_token()}}"
                },
                beforeSend: function() {
                    $('.imagenes-id').html("");
                }
            }).done(function(data) {

                $('.imagenes-id').html(data);
            });
        });
        @endif
    });
</script>
@endsection