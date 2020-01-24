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
    @if(request('cat') == "N")
    <div class="row h-100">
        <!-- Start Row principal -->

        <div class="col-lg-12 mt-3">
            <div class="card m-0">
                <div class="card-body pl-0 pr-0 pb-0 pt-0">
                    <h2 class="titulos-categoria p-2 text-center">AUDITORIA GENERAL</h2>

                    <a target="_blank" href="{{route('imprimir/reportes-item')}}?cat=N&id={{request('id')}}">
                        <h3 class="titulos-grandes p-2 text-center"><i class="fa fa-print text-white"></i> Ver en Formato de Impresión</h3>
                    </a>
                    <h2 class="titulos p-2 text-center">{{strtoupper($pdsdata->pds_name)}}</h2>
                    <h3 class="titulos p-2 text-center">Número de reporte: {{$datos->tipo.'-'.str_pad($datos->idauditoria_reportes, 7, "0", STR_PAD_LEFT)}}</h3>
                    <h3 class="titulos-negro p-2 text-center">{{\Carbon\Carbon::now()->format('d/m/Y')}}</h3>

                    <div class="col-lg-12 mb-2">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="row">
                                <div class="col titulos-visuales rounded p-2">
                                    <h2 class="titulos-categoria p-0 pt-1">Estado</h2>
                                    <h2 class="text-white p-0 pt-1" id="promestado"></h2>
                                </div>
                                <div class="col titulos-visuales rounded p-2">
                                    <h2 class="titulos-categoria p-0">Activos</h2>
                                    <h1 class="text-white p-0"><i class="fa fa-check bg-success rounded-circle"></i></h1>
                                </div>
                                <div class="col titulos-visuales rounded p-2">
                                    <h2 class="titulos-categoria p-0">Perfil</h2>
                                    <h1 class="text-white p-0"><i class="fa fa-check bg-success rounded-circle"></i></h1>
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
                    <h3 class="titulos-grandes p-2 text-center promestado">Estado</h3>
                    <div class="row px-2">
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','estado')->get();
                    $cantidadestados =(new \App\Encaudit())->where('categoria','=','estado')->count();
                    $promcompleto = 0
                    @endphp
                    @forelse($datosverticales as $dv)
                    <h5 class="col titulos p-2 text-center" id="tituloaux{{$dv->idencaudit}}">{{ucfirst($dv->nombre_estado)}}</h5>
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
                            <div class="col-12 mb-2 ml-4">
                                <div class="row">
                                    <div class="col-4">
                                        <b>{{ucfirst($th->nombre_val)}}</b>
                                    </div>
                                    <div class="col-2">
                                        <b><span class="p-0 titulos-procentaje">{{$valor}}%</span></b>
                                        <img src="{{asset('img/cara'.$encuesta->value('carita').'.jpg')}}" width="50px" alt="carita" class="pull-right">
                                    </div>
                                    <div class="col-4">
                                        <div class="rounded border border-dark px-1" style="min-height: 7vh;">
                                            <b>{{ucfirst($encuesta->value('observa'))}}</b>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <button data-id="{{$id}}" class="btn btn-sm btn-primary btn-verfotos">Ver Fotos</button>
                                    </div>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        <script>
                            var tituloaux{{$dv->idencaudit}} = '{{ucfirst($dv->nombre_estado)}} <span class="border border-info rounded px-1">{{number_format($valores/$promcaritas, 2, '.', '')}}%</span>';
                            $(document).ready(function(){
                                $('#tituloaux{{$dv->idencaudit}}').html(tituloaux{{$dv->idencaudit}});
                                $('#tituloaux{{$dv->idencaudit}}').attr('data-val',{{number_format($valores/$promcaritas, 2, '.', '')}});
                            });
                            @php
                            $promcompleto += $valores/$promcaritas;
                            @endphp
                        </script>
                    @empty
                    @endforelse
                    <script>
                        $(document).ready(function(){
                            var aux = {{$promcompleto/$cantidadestados}};
                            $('#promestado').html('<span class="border border-white rounded px-1">'+aux.toFixed(2)+'%</span>');
                            $('.promestado').html('Estado <span class="border border-white rounded px-1">'+aux.toFixed(2)+'%</span>');
                        });
                    </script>
                    </div>



                            








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
                                <td colspan="2"><b>Observación</b></td>
                            </tr>
                            <tr style="background: lightgray;">
                                <td colspan="2">{{$valores_muebles->value('observa')}}</td>
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
    <!-- End Submenu -->
    <!--Start Dashboard Content-->
    @endif
    @if(request('cat') == "P")
    <div class="row h-100">
        <!-- Start Row principal -->

        <div class="col-lg-12 mt-3">
            <div class="card m-0">
                <div class="card-body pl-0 pr-0 pb-0 pt-0">
                <h2 class="titulos-categoria p-2 text-center">AUDITORIA DE PROCESO</h2>

<a target="_blank" href="{{route('imprimir/reportes-item')}}?cat=P&id={{request('id')}}">
    <h3 class="titulos-grandes p-2 text-center"><i class="fa fa-print text-white"></i> Ver en Formato de Impresión</h3>
</a>
<h2 class="titulos p-2 text-center">{{strtoupper($pdsdata->pds_name)}}</h2>
<h3 class="titulos p-2 text-center">Número de reporte: {{$datos->tipo.'-'.str_pad($datos->idauditoria_reportes, 7, "0", STR_PAD_LEFT)}}</h3>
<h3 class="titulos-negro p-2 text-center">{{\Carbon\Carbon::now()->format('d/m/Y')}}</h3>

<div class="col-lg-12 mb-2">
    <div class="col-lg-6 offset-lg-3">
        <div class="row">
            <div class="col titulos-visuales rounded p-2">
                <h2 class="titulos-categoria p-0 pt-1">Procesos</h2>
                <h2 class="text-white p-0 pt-1" id="promprocesos"></h2>
            </div>
            <div class="col titulos-visuales rounded p-2">
                <h2 class="titulos-categoria p-0">Activos</h2>
                <h1 class="text-white p-0"><i class="fa fa-check bg-success rounded-circle"></i></h1>
            </div>
            <div class="col titulos-visuales rounded p-2">
                <h2 class="titulos-categoria p-0">Perfil</h2>
                <h1 class="text-white p-0"><i class="fa fa-check bg-success rounded-circle"></i></h1>
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

<h3 class="titulos-grandes p-2 promprocesos text-center">Procesos</h3>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria','=','procesos')->get();
                    $valores = 0;
                    $promcaritas = 0;
                    @endphp
                    @forelse($datosverticales as $dv)
                    <h5 class="titulos p-2 text-center">{{ucfirst($dv->nombre_estado)}}</h5>
                    
                    <div class="row px-2">
                            @php
                            $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                            $promcaritas += (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->count();
                            @endphp

                            @forelse($thc as $th)
                            @php
                            $proceso = (new \App\Encauditdata())->where(['encauditvalues_id'=>$th->idencauditvalues,'agenda_id'=>$datos->agenda_id,'pds_id'=>$pdsdata->id]);
                            $valor = 0;
                            if($proceso->value('carita')>0){
                            switch ((int)$proceso->value('carita')) {
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
                                <div class="col-lg-6 mb-3">
                                    <div class="row mb-2">
                                       <div class="col-lg-7">
                                            <b>{{ucfirst($th->nombre_val)}}</b>
                                        </div>
                                        <div class="col-lg-3">
                                            <h2 class="p-2 text-right" data-val="{{$valor}}">{{$valor}}%</h2>
                                        </div>
                                        <div class="col-lg-2">
                                            <img src="{{asset('img/cara'.$proceso->value('carita').'.jpg')}}" width="50px" alt="carita">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span class="border border-info rounded px-1"><b>{{ucfirst($proceso->value('observa'))}}</b></span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                    </div>
                    @empty
                    @endforelse
                    <script>
                        $(document).ready(function(){
                            var sumaprocesos=0;
                            $('[data-val]').each(function(index,element){
                                sumaprocesos += parseInt($(this).attr('data-val'));
                            });
                            var aux = sumaprocesos/{{$promcaritas}};
                            $('#promprocesos').html('<span class="border border-white rounded px-1">'+aux.toFixed(2)+'%</span>');
                            $('.promprocesos').html('Procesos <span class="border border-white rounded px-1">'+aux.toFixed(2)+'%</span>');
                        });
                    </script>
                    
                    <h3 class="titulos-grandes p-2 text-center">Informes</h3>
                    <div class="row px-2">

                        <div class="col-lg-4 my-3">

                            <div class="col text-center titulos-negro p-2">
                                    <h2 class="p-0 pt-1">Si <i class="fa fa-check bg-success rounded-circle text-white p-1"></i></h2>
                            </div>
                            @php
                                $informes = (new \App\Informes_reporte())->join('encauditvalues','informes_reportes.informes_id','encauditvalues.idencauditvalues')->where([ 'agenda_id'=>$datos->agenda_id,  'pds_id'=>$pdsdata->id, 'auditor_id'=>$datos->auditor_id, 'value'=>'SI' ])->get();
                            @endphp
                            @forelse($informes as $informe)
                                <div class="col-lg-12 mb-3">
                                    <h4 class="p-2 titulos-informes">{{$informe->nombre_val}}</h4>
                                    <div class="border border-info rounded px-1 observaciones-informes"><b>{{$informe->observa}}</b></div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                        
                        <div class="col-lg-4 my-3">

                            <div class="col text-center titulos-negro p-2">
                                    <h2 class="p-0 pt-1">No <i class="fa fa-times-circle-o bg-danger rounded-circle text-white p-1"></i></h2>
                            </div>
                            @php
                                $informes = (new \App\Informes_reporte())->join('encauditvalues','informes_reportes.informes_id','encauditvalues.idencauditvalues')->where([ 'agenda_id'=>$datos->agenda_id,  'pds_id'=>$pdsdata->id, 'auditor_id'=>$datos->auditor_id, 'value'=>'NO' ])->get();
                            @endphp
                            @forelse($informes as $informe)
                                <div class="col-lg-12 mb-3">
                                    <h4 class="p-2 titulos-informes">{{$informe->nombre_val}}</h4>
                                    <div class="border border-info rounded px-1 observaciones-informes"><b>{{$informe->observa}}</b></div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                        
                        <div class="col-lg-4 my-3">

                            <div class="col text-center titulos-negro p-2">
                                    <h2 class="p-0 pt-1">N/A <i class="fa fa-asterisk bg-warning rounded-circle text-white p-1"></i></h2>
                            </div>
                            @php
                                $informes = (new \App\Informes_reporte())->join('encauditvalues','informes_reportes.informes_id','encauditvalues.idencauditvalues')->where([ 'agenda_id'=>$datos->agenda_id,  'pds_id'=>$pdsdata->id, 'auditor_id'=>$datos->auditor_id, 'value'=>'N/A' ])->get();
                            @endphp
                            @forelse($informes as $informe)
                                <div class="col-lg-12 mb-3">
                                    <h4 class="p-2 titulos-informes">{{$informe->nombre_val}}</h4>
                                    <div class="border border-info rounded px-1 observaciones-informes"><b>{{$informe->observa}}</b></div>
                                </div>
                            @empty
                            @endforelse

                        </div>


                    </div>

                    <h3 class="titulos-grandes p-2 text-center">Arqueo de Caja</h3>
                    

    
                    <div class="row px-2">

                        <div class="col-lg-4">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><h5 class="titulos p-2">Monedas</h5></th>
                                        <th style="text-align: center"><h5 class="titulos p-2">Cantidad</h5></th>
                                        <th style="text-align: center"><h5 class="titulos p-2">Total</h5></th>
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

                        </div>

                        <div class="col-lg-4">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><h5 class="titulos p-2">Billetes</h5></th>
                                        <th style="text-align: center"><h5 class="titulos p-2">Cantidad</h5></th>
                                        <th style="text-align: center"><h5 class="titulos p-2">Total</h5></th>
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

                        </div>

                        <div class="col-lg-4 mt-2">
                            <div class="row">
                                <div class="col-lg-8"><h5 class="titulos p-2 text-center">Monedas y billetes</h5></div>
                                <div class="col-lg-4 text-center p-2">$ {{number_format($sumatotal,2)}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8"><h5 class="titulos p-2 text-center">Depósitos parciales</h5></div>
                                <div class="col-lg-4 text-center p-2">$ {{number_format($arqueos->depositosparciales,2)}}</div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <span data-id="{{$arqueos->idarqueocajas}}" class="btn btn-primary" id="depositos"><i class="fa fa-eye"></i> Ver depósitos</span>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-lg-12"><h5 class="titulos p-2 text-center">Conciliación del arqueo realizado</h5></div>
                            </div>
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
        @if(request('cat') == "N")
        $('.btn-verfotos').click(function() {
            $('.modal-verfotos').modal('show');
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('agenda/getimages')}}",
                method: "post",
                dataType: 'text',
                data: {
                    'id': id,
                    'cat': 'N',
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
        @if(request('cat') == "P")
        $('#depositos').click(function() {
            $('.modal-verfotos').modal('show');
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('agenda/getimages')}}",
                method: "post",
                dataType: 'text',
                data: {
                    'id': id,
                    'cat': 'P',
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