@extends('vistas.layout.print')
<style>
    @media print {

        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12 {
            float: left;
        }

        .col-sm-12 {
            width: 100%;
        }

        .col-sm-11 {
            width: 91.66666667%;
        }

        .col-sm-10 {
            width: 83.33333333%;
        }

        .col-sm-9 {
            width: 75%;
        }

        .col-sm-8 {
            width: 66.66666667%;
        }

        .col-sm-7 {
            width: 58.33333333%;
        }

        .col-sm-6 {
            width: 50%;
        }

        .col-sm-5 {
            width: 41.66666667%;
        }

        .col-sm-4 {
            width: 33.33333333%;
        }

        .col-sm-3 {
            width: 25%;
        }

        .col-sm-2 {
            width: 16.66666667%;
        }

        .col-sm-1 {
            width: 8.33333333%;
        }

        .col-sm-pull-12 {
            right: 100%;
        }

        .col-sm-pull-11 {
            right: 91.66666667%;
        }

        .col-sm-pull-10 {
            right: 83.33333333%;
        }

        .col-sm-pull-9 {
            right: 75%;
        }

        .col-sm-pull-8 {
            right: 66.66666667%;
        }

        .col-sm-pull-7 {
            right: 58.33333333%;
        }

        .col-sm-pull-6 {
            right: 50%;
        }

        .col-sm-pull-5 {
            right: 41.66666667%;
        }

        .col-sm-pull-4 {
            right: 33.33333333%;
        }

        .col-sm-pull-3 {
            right: 25%;
        }

        .col-sm-pull-2 {
            right: 16.66666667%;
        }

        .col-sm-pull-1 {
            right: 8.33333333%;
        }

        .col-sm-pull-0 {
            right: auto;
        }

        .col-sm-push-12 {
            left: 100%;
        }

        .col-sm-push-11 {
            left: 91.66666667%;
        }

        .col-sm-push-10 {
            left: 83.33333333%;
        }

        .col-sm-push-9 {
            left: 75%;
        }

        .col-sm-push-8 {
            left: 66.66666667%;
        }

        .col-sm-push-7 {
            left: 58.33333333%;
        }

        .col-sm-push-6 {
            left: 50%;
        }

        .col-sm-push-5 {
            left: 41.66666667%;
        }

        .col-sm-push-4 {
            left: 33.33333333%;
        }

        .col-sm-push-3 {
            left: 25%;
        }

        .col-sm-push-2 {
            left: 16.66666667%;
        }

        .col-sm-push-1 {
            left: 8.33333333%;
        }

        .col-sm-push-0 {
            left: auto;
        }

        .col-sm-offset-12 {
            margin-left: 100%;
        }

        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }

        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }

        .col-sm-offset-9 {
            margin-left: 75%;
        }

        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }

        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }

        .col-sm-offset-6 {
            margin-left: 50%;
        }

        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }

        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }

        .col-sm-offset-3 {
            margin-left: 25%;
        }

        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }

        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }

        .col-sm-offset-0 {
            margin-left: 0%;
        }

        .visible-xs {
            display: none !important;
        }

        .hidden-xs {
            display: block !important;
        }

        table.hidden-xs {
            display: table;
        }

        tr.hidden-xs {
            display: table-row !important;
        }

        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }

        .hidden-xs.hidden-print {
            display: none !important;
        }

        .hidden-sm {
            display: none !important;
        }

        .visible-sm {
            display: block !important;
        }

        table.visible-sm {
            display: table;
        }

        tr.visible-sm {
            display: table-row !important;
        }

        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
    }
</style>
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
                                    <h2 class="titulos-categoria p-0" id="promestado">Estado</h2>
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

                    <h3 class="titulos-grandes p-2 text-center" id="promestado">Estado</h3>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','estado')->get();
                    @endphp
                    @forelse($datosverticales as $dv)
                    <h5 class="titulos p-2 text-center" id="tituloaux{{$dv->idencaudit}}">{{ucfirst($dv->nombre_estado)}}</h5>
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
                                <td width=150>
                                    <h2 class="p-2 text-right">{{$valor}}%</h2>
                                </td>
                                <td width=75><img src="{{asset('img/cara'.$encuesta->value('carita').'.jpg')}}" width="50px" alt="carita"></td>
                                <td width="50%">
                                    <div class="rounded border border-dark px-1">
                                        <b>{{ucfirst($encuesta->value('observa'))}}</b>
                                    </div>
                                </td>
                                <td><button data-id="{{$id}}" class="btn btn-sm btn-primary btn-verfotos">Ver Fotos</button></td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <script>
                            var tituloaux{{$dv->idencaudit}} = '{{ucfirst($dv->nombre_estado)}} <span class="border border-info rounded px-1">{{number_format($valores/$promcaritas, 2, '.', '')}}%</span>';
                            $(document).ready(function(){
                                $('#tituloaux{{$dv->idencaudit}}').html(tituloaux{{$dv->idencaudit}});
                                $('#tituloaux{{$dv->idencaudit}}').attr('data-val',{{number_format($valores/$promcaritas, 2, '.', '')}});
                            });
                        </script>
                    </table>
                    @empty
                    @endforelse

                    <script>
                        $(document).ready(function(){
                            var sumaestados=0;
                            $('[data-val]').each(function(index,element){
                                sumaestados += $(this).attr('data-val');
                            });
                            var aux = sumaestados/{{$promcaritas}};
                            $('#promestado').html('Estado <span class="border border-white rounded px-1">'+aux.toFixed(2)+'%</span>');
                        });
                    </script>
                    <h3 class="titulos-grandes p-2 text-center">Activo</h3>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','activos')->get();
                    @endphp
                    <div class="row p-2">
                    @forelse($datosverticales as $dv)
                    <h5 class="col-lg-12 titulos p-2 text-center">{{ucfirst($dv->nombre_estado)}}</h5>
                    @php
                    $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                    @endphp
                    
                    
                    @forelse($thc as $th)
                    <div class="col-lg-4 py-2 px-5">
                    <h6 class="titulos p-2"><b>{{ucfirst($th->nombre_val)}}</b></h6>
                    <table class="table ">


                        <tbody>
@php
$valores_muebles = (new \App\Encauditdataactivo())->where([ 'encauditvalues_id'=>$th->idencauditvalues, 'agenda_id'=>$datos->agenda_id, 'pds_id'=>$pdsdata->id, 'auditor_id'=>$datos->auditor_id]);
@endphp
                            <tr>
                                <td width="25%"><b>Código</b></td>
                                <td><b>{{$valores_muebles->value('codigo')}}</b></td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Cantidad</b></td>
                                <td>{{$valores_muebles->value('cantidad')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Marca</b></td>
                                <td>{{$valores_muebles->value('marca')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Modelo</b></td>
                                <td>{{$valores_muebles->value('Modelo')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Color</b></td>
                                <td>{{$valores_muebles->value('color')}}</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Propiedad</b></td>
                                <td>{{$valores_muebles->value('propiedad') == 0 ? "Propio" : "Alquilado"}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>Observación</b></td>
                            </tr>
                            <tr style="background: lightgray;">
                                <td>{{$valores_muebles->value('observa')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    @empty
                    @endforelse

                    @empty
                    @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

@if(request('cat') == "procesos")
<div class="row h-100">
    <!-- Start Row principal -->

    <div class="col-lg-12 mt-3">
        <div class="card m-0">
            <div class="card-body pl-0 pr-0 pb-0 pt-0">
                <h6 class="titulos-grandes p-2 text-white"><a class="text-white" target="_blank" href="{{route('imprimir/reportes-item')}}?cat=procesos&id={{request('id')}}"> <i class="fa fa-print "></i>Ver en Formato de Impresión</a></h6>
                <h4 class="titulos-grandes p-2">Perfil PDS</h4>
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
                <h4 class="titulos-grandes p-2">Comisionistas</h4>
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
                <h4 class="titulos-grandes p-2">Procesos</h4>
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
                            <td><img src="{{asset('img/cara'.(new \App\Encauditdata())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('carita').'2.jpg')}}" width="50px" alt="carita"></td>
                            <td width="25%"><b>{{ucfirst((new \App\Encauditdata())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id])->value('observa'))}}</b></td>

                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                @empty
                @endforelse
                <h4 class="titulos-grandes p-2">Arqueo de Caja</h4>
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





<script type='text/javascript'>
    $(document).ready(function{
        window.onload = detectarCarga;
        function detectarCarga() {
            window.print();
        }
    });
</script>