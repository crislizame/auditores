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

    .lmhorizontal2 li a {}

    .lmhorizontal2 li a:hover {
        color: white;
    }

    .lmhorizontal2 li:hover a {
        color: white;
    }

    .lmhorizontal2 li.active a {
        color: white;
    }

    .lmhorizontal2 li.active:hover a:hover {
        color: white;
    }
</style>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="loadingc">
        <div class="centrar pepe">
            <div class="progress mt-3 mb-4">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:100%"></div>
            </div>
            <span class="text-white"> Por favor espere mientras realizamos los cálculos de los indicadores.</span>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-12">
            <ul class="nav lmhorizontal2">
                <a href="{{route('indicadores')}}?cat=auditoria">
                    <li class="nav-item @if(request('cat') == "auditoria") active @endif">Auditoria</li>
                </a>
                <a href="{{route('indicadores')}}?cat=comisionistas">
                    <li class="nav-item @if(request('cat') == "comisionistas") active @endif">Comisionistas</li>
                </a>
                <a href="{{route('indicadores')}}?cat=mantenimiento">
                    <li class="nav-item @if(request('cat') == "mantenimiento") active @endif">Mantenimiento</li>
                </a>
                <a href="{{route('indicadores')}}?cat=soporte">
                    <li class="nav-item @if(request('cat') == "soporte") active @endif">Soporte</li>
                </a>
                <a href="{{route('indicadores')}}?cat=rp3">
                    <li class="nav-item @if(request('cat') == "rp3") active @endif">RP3</li>
                </a>
                <a href="{{route('indicadores')}}?cat=lottogame">
                    <li class="nav-item @if(request('cat') == "lottogame") active @endif">Lotto Game</li>
                </a>
            </ul>
        </div>
    </div>

    @if(request('cat') == "auditoria")
    <div class="row h-100">
        <div class="col-lg-3 mt-0">
            <span class="titulos text-info bold">Filtrar</span>
            <div class="card pb-3 m-0">
                <form action="{{route('indicadores')}}?cat=auditoria" method="post">
                    {{csrf_field()}}
                    <div class="card-body pt-1">
                        <div class="row align-content-center text-center">
                            <span class=" pr-4 pl-4 w-100"><i class="fa text-center fa-sliders pointer"></i> Seleccionar rango de fecha:</span>
                            </span>
                        </div>
                        <div class="row pt-2 pr-4 pl-4">
                            <label for="sel-dateinicio">Inicio (o único día)</label>
                            <input type="date" name="sel-dateinicio" id="sel-dateinicio" class="form-control " value="{{(new \Carbon\Carbon())::now()->format('Y-m-d')}}">
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="sel-datefin">Fin (si es único día dejar en blanco)</label>
                            <input type="date" name="sel-datefin" id="sel-datefin" class="form-control ">
                        </div>
                        <hr class="pb-2">
                        <div class="row align-content-center text-center">
                            <span class=" pr-4 pl-4 w-100"><i class="fa text-center fa-sliders "></i> Seleccionar escala:</span>
                            </span>
                        </div>
                        <input type="hidden" class="tipoescala" name="tipoescala">
                        <div class="row pt-2 pr-4 pl-4 text-center">
                            <span class="w-100 selglobal text-danger pointer"> Borrar filtros escala</span>
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="sel-date">Analizar por Provincia</label>
                            <select name="provincia" class="form-control form-control-sm p-0" id="provincia" style="height: 23px;">
                                <option selected value="0">Sin filtro</option>
                                @php
                                $provincias = (new \App\Pdsperfile())->groupBy('pds_provincia')->orderBy('pds_provincia','asc')->get();
                                @endphp
                                @foreach($provincias as $provincia)
                                <option value="{{$provincia->pds_provincia}}">{{$provincia->pds_provincia}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="sel-date">Analizar por Ciudad</label>
                            <select name="ciudad" class="form-control form-control-sm p-0" id="ciudad" style="height: 23px;">
                                <option selected value="0">Sin filtro</option>
                                @php
                                $ciudades = (new \App\Pdsperfile())->groupBy('pds_ciudad')->orderBy('pds_ciudad','asc')->get();
                                @endphp
                                @foreach($ciudades as $ciudad)
                                <option value="{{$ciudad->pds_ciudad}}">{{$ciudad->pds_ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="pdssel">Analizar por PDS</label>
                            <select name="pdssel" class="form-control form-control-sm p-0 " id="pdssel" style="height: 23px;">
                                <option value="0"> Sin filtro</option>

                                @php
                                $ciudades = (new \App\Pdsperfile())->orderBy('pds_ciudad','asc')->get();
                                @endphp
                                @foreach($ciudades as $ciudad)
                                <option value="{{$ciudad->id}}">{{$ciudad->pds_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pt-1 m-0 w-100">
                            <button type="submit" class="btn w-100 btn-primary">Generar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        @php
        $datainicio = request()->has('sel-dateinicio')? \Carbon\Carbon::parse(request()->post('sel-dateinicio'))->toDateTimeString() : \Carbon\Carbon::now()->toDateTimeString() ;
        $datainicioletra = request()->has('sel-dateinicio')? \Carbon\Carbon::parse(request()->post('sel-dateinicio'))->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY') : \Carbon\Carbon::now()->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY') ;
        $datafin = request()->has('sel-datefin')? \Carbon\Carbon::parse(request()->post('sel-datefin'))->toDateTimeString() : \Carbon\Carbon::now()->addDays(1)->toDateTimeString() ;
        $datafinletra = request()->post('sel-datefin') != null ? "<br>".ucfirst(\Carbon\Carbon::parse(request()->post('sel-datefin'))->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY')): "" ;
        $pds_id = ((request()->post('pdssel') != "0") and (request()->post('pdssel') != null)) || (request()->has('pdssel') and request()->post('pdssel') != "0") ? request()->post('pdssel') : "%" ;
        $global = request()->post('global') == "on"? request()->post('global') : "off" ;
        $ciudad = ((request()->post('ciudad') != "0") and (request()->post('ciudad') != null)) || (request()->has('ciudad') and request()->post('ciudad') != "0")? request()->post('ciudad') : "sc" ;
        $provincia = ((request()->post('provincia') != "0") and (request()->post('provincia') != null)) || (request()->has('provincia') and request()->post('provincia') != "0")? request()->post('provincia') : "sp" ;
        $cambio = "Global";
        if($ciudad != "sc"){
            $cambio = ucfirst($ciudad);
        }else if($pds_id != "%"){
            $cambio = (new \App\Pdsperfile())->where('id',$pds_id)->value('pds_name');
        }
        @endphp
        <div class="col-lg-9 mt-0">

            <div class="row pt-4">
                <div class="col-12">
                    <ul class="nav navsubitemindicadores">
                        <li class="nav-item active" data-val="estado">Estado</li>
                        <li class="nav-item" data-val="procesos">Procesos</li>
                    </ul>
                </div>
            </div>
            <div class="row data-estado">
                <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
                    <div class="row">
                        <span class="pl-4 tiposel titulos w-50 text-left">{{$cambio}}</span>
                        <span class="pr-4 fechasel titulos w-50 text-right">{{ucfirst($datainicioletra)}} {!! $datafinletra !!}</span>
                    </div>
                    @php
                        $datosverticales = (new \App\Encaudit())->where('categoria',"estado")->get();
                    @endphp

                    @forelse($datosverticales as $dv)
                    <h5 class="titulos-grandes text-center">{{$dv->nombre_estado}}</h5>

                    <ul class="indicadoresgraf nav">
                        @php
                        $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                        @endphp

                        @forelse($thc as $tc)

                            @php
                            $c = 0;
                            $c0 = 0;
                            $c1 = 0;
                            $c2 = 0;
                            $c3 = 0;
                            $cc = 0;
                            $c0c = 0;
                            $c1c = 0;
                            $c2c = 0;
                            $c3c = 0;
                            $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                            $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                            $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                            $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                            $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                            $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                            $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');
                            $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                            $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                            $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                            $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                            $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                            if($pds_id != "%"){
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                            } else {
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');

                                if($ciudad != "sc"){
                                    $carita = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $caritac = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                }

                                if($provincia != "sp"){
                                    $carita = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $caritac = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                }
                            }

                            $carita = $carita->value('carita');
                            $caritac = $caritac->count();
                            $carita0 = $carita0->value('carita');
                            $carita0c = $carita0c->count();
                            $carita1 = $carita1->value('carita');
                            $carita1c = $carita1c->count();
                            $carita2 = $carita2->value('carita');
                            $carita2c = $carita2c->count();
                            $carita3 = $carita3->value('carita');
                            $carita3c = $carita3c->count();

                            $c += $carita == null?"0":$carita;
                            $c0 += $carita0 == null?"0":$carita0;
                            $c1 += $carita1 == null?"0":$carita1;
                            $c2 += $carita2 == null?"0":$carita2;
                            $c3 += $carita3 == null?"0":$carita3;
                            $cc += $caritac == null?"0":$caritac;
                            $c0c += $carita0c == null?"0":$carita0c;
                            $c1c += $carita1c == null?"0":$carita1c;
                            $c2c += $carita2c == null?"0":$carita2c;
                            $c3c += $carita3c == null?"0":$carita3c;

                            $cc = $cc == "0"?"1":$cc;
                            $c0c = $c0c == "0"?"1":$c0c;
                            $c1c = $c1c == "0"?"1":$c1c;
                            $c2c = $c2c == "0"?"1":$c2c;
                            $c3c = $c3c == "0"?"1":$c3c;
                            $caritares = number_format((($c/($cc))*10)*2);
                            $carita0res = number_format((($c0/($c0c))*10)*2);
                            $carita1res = number_format((($c1/($c1c))*10)*2);
                            $carita2res = number_format((($c2/($c2c))*10)*2);
                            $carita3res = number_format((($c3/($c3c))*10)*2);

                            @endphp

                        <li class="nav-item">
                            <div class="w-100">
                                <div class=" text-center">
                                    <span class="titulos">{{$tc->nombre_val}}</span>
                                    <hr>
                                </div>
                                <div class="text-center">
                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$caritares}}">
                                </div>
                                <div class="text-center">
                                    <canvas class="lineChart{{$tc->idencauditvalues}}" height="100%"></canvas>
                                    <script>
                                        $(document).ready(function() {
                                            var ctx = $('.lineChart{{$tc->idencauditvalues}}');
                                            ctx.css('display', 'initial!important');
                                            var chartOptions = {
                                                legend: {
                                                    display: false,
                                                    position: 'top',
                                                    labels: {
                                                        boxWidth: 80,
                                                        fontColor: 'black'
                                                    }
                                                }
                                            };
                                            var myChart = new Chart(ctx, {
                                                type: 'line',
                                                options: chartOptions,
                                                data: {
                                                    labels: ['{{$mes3letra}}', '{{$mes2letra}}', '{{$mes1letra}}', '{{$mes0letra}}'],
                                                    datasets: [{
                                                        label: '',
                                                        data: [{{$carita3res}}, {{$carita2res}}, {{$carita1res}}, {{$carita0res}}],
                                                        backgroundColor: "transparent",
                                                        borderColor: "#004e92",
                                                        borderWidth: 2
                                                    }]
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>

                    @empty
                    @endforelse
                </div>
            </div>
            <div class="row data-procesos">
                <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
                    <div class="row">
                        <span class="pl-4 tiposel titulos w-50 text-left">{{$cambio}}</span>
                        <span class="pr-4 fechasel titulos w-50 text-right">{{ucfirst($datainicioletra)}} {!! $datafinletra !!}</span>
                    </div>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria',"procesos")->get();
                    @endphp

                    @forelse($datosverticales as $dv)

                    <h5 class="titulos-grandes text-center">{{$dv->nombre_estado}}</h5>

                    <ul class="indicadoresgraf nav">
                        @php
                            $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                        @endphp

                        @forelse($thc as $tc)

                            @php
                            $c = 0;
                            $c0 = 0;
                            $c1 = 0;
                            $c2 = 0;
                            $c3 = 0;
                            $cc = 0;
                            $c0c = 0;
                            $c1c = 0;
                            $c2c = 0;
                            $c3c = 0;
                            $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                            $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                            $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                            $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                            $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                            $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                            $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');
                            $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                            $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                            $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                            $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                            $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                            if($pds_id != "%"){
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                            } else {
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');

                                if($ciudad != "sc"){
                                    $carita = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $caritac = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                }

                                if($provincia != "sp"){
                                    $carita = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $caritac = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                }
                            }

                            $carita = $carita->value('carita');
                            $caritac = $caritac->count();
                            $carita0 = $carita0->value('carita');
                            $carita0c = $carita0c->count();
                            $carita1 = $carita1->value('carita');
                            $carita1c = $carita1c->count();
                            $carita2 = $carita2->value('carita');
                            $carita2c = $carita2c->count();
                            $carita3 = $carita3->value('carita');
                            $carita3c = $carita3c->count();

                            $c += $carita == null?"0":$carita;
                            $c0 += $carita0 == null?"0":$carita0;
                            $c1 += $carita1 == null?"0":$carita1;
                            $c2 += $carita2 == null?"0":$carita2;
                            $c3 += $carita3 == null?"0":$carita3;
                            $cc += $caritac == null?"0":$caritac;
                            $c0c += $carita0c == null?"0":$carita0c;
                            $c1c += $carita1c == null?"0":$carita1c;
                            $c2c += $carita2c == null?"0":$carita2c;
                            $c3c += $carita3c == null?"0":$carita3c;

                        $cc = $cc == "0"?"1":$cc;
                        $c0c = $c0c == "0"?"1":$c0c;
                        $c1c = $c1c == "0"?"1":$c1c;
                        $c2c = $c2c == "0"?"1":$c2c;
                        $c3c = $c3c == "0"?"1":$c3c;
                        $caritares = number_format((($c/($cc))*10)*2);
                        $carita0res = number_format((($c0/($c0c))*10)*2);
                        $carita1res = number_format((($c1/($c1c))*10)*2);
                        $carita2res = number_format((($c2/($c2c))*10)*2);
                        $carita3res = number_format((($c3/($c3c))*10)*2);

                        @endphp
                        <li class="nav-item">
                            <div class="w-100">
                                <div class=" text-center">
                                    <span class="titulos">{{$tc->nombre_val}}</span>
                                    <hr>
                                </div>
                                <div class="text-center">
                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$caritares}}">
                                </div>
                                <div class="text-center">
                                    <canvas class="lineChart{{$tc->idencauditvalues}}" height="100%"></canvas>
                                    <script>
                                        $(document).ready(function() {
                                            var ctx = $('.lineChart{{$tc->idencauditvalues}}');
                                            ctx.css('display', 'initial!important');
                                            var chartOptions = {
                                                legend: {
                                                    display: false,
                                                    position: 'top',
                                                    labels: {
                                                        boxWidth: 80,
                                                        fontColor: 'black'
                                                    }
                                                }
                                            };
                                            var myChart = new Chart(ctx, {
                                                type: 'line',
                                                options: chartOptions,
                                                data: {
                                                    labels: ['{{$mes3letra}}', '{{$mes2letra}}', '{{$mes1letra}}', '{{$mes0letra}}'],
                                                    datasets: [{
                                                        label: '',
                                                        data: [{{$carita3res}}, {{$carita2res}}, {{$carita1res}}, {{$carita0res}}],
                                                        backgroundColor: "transparent",
                                                        borderColor: "#004e92",
                                                        borderWidth: 2
                                                    }]
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(request('cat') == "comisionistas")
    <div class="row h-100">
        <div class="col-lg-3 mt-0">
            <span class="titulos text-info bold">Filtrar</span>
            <div class="card pb-3 m-0">
                <form action="{{route('indicadores')}}?cat=comisionistas" method="post">
                    {{csrf_field()}}
                    <div class="card-body pt-1">
                        <div class="row align-content-center text-center">
                            <span class=" pr-4 pl-4 w-100"><i class="fa text-center fa-sliders pointer"></i> Seleccionar rango de fecha:</span>
                            </span>
                        </div>
                        <div class="row pt-2 pr-4 pl-4">
                            <label for="sel-dateinicio">Inicio (o único día)</label>
                            <input type="date" name="sel-dateinicio" id="sel-dateinicio" class="form-control " value="{{(new \Carbon\Carbon())::now()->format('Y-m-d')}}">
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="sel-datefin">Fin (si es único día dejar en blanco)</label>
                            <input type="date" name="sel-datefin" id="sel-datefin" class="form-control ">
                        </div>
                        <hr class="pb-2">
                        <div class="row align-content-center text-center">
                            <span class=" pr-4 pl-4 w-100"><i class="fa text-center fa-sliders "></i> Seleccionar escala:</span>
                            </span>
                        </div>
                        <input type="hidden" class="tipoescala" name="tipoescala">
                        <div class="row pt-2 pr-4 pl-4 text-center">
                            <span class="w-100 selglobal text-danger pointer"> Borrar filtros escala</span>
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="sel-date">Analizar por Provincia</label>
                            <select name="provincia" class="form-control form-control-sm p-0" id="provincia" style="height: 23px;">
                                <option selected value="0">Sin filtro</option>
                                @php
                                $provincias = (new \App\Pdsperfile())->groupBy('pds_provincia')->orderBy('pds_provincia','asc')->get();
                                @endphp
                                @foreach($provincias as $provincia)
                                <option value="{{$provincia->pds_provincia}}">{{$provincia->pds_provincia}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="sel-date">Analizar por Ciudad</label>
                            <select name="ciudad" class="form-control form-control-sm p-0" id="ciudad" style="height: 23px;">
                                <option selected value="0">Sin filtro</option>
                                @php
                                $ciudades = (new \App\Pdsperfile())->groupBy('pds_ciudad')->orderBy('pds_ciudad','asc')->get();
                                @endphp
                                @foreach($ciudades as $ciudad)
                                <option value="{{$ciudad->pds_ciudad}}">{{$ciudad->pds_ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pt-2 pb-3 pr-4 pl-4">
                            <label for="pdssel">Analizar por PDS</label>
                            <select name="pdssel" class="form-control form-control-sm p-0 " id="pdssel" style="height: 23px;">
                                <option value="0"> Sin filtro</option>

                                @php
                                $ciudades = (new \App\Pdsperfile())->orderBy('pds_ciudad','asc')->get();
                                @endphp
                                @foreach($ciudades as $ciudad)
                                <option value="{{$ciudad->id}}">{{$ciudad->pds_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pt-1 m-0 w-100">
                            <button type="submit" class="btn w-100 btn-primary">Generar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        @php
        $datainicio = request()->has('sel-dateinicio')? \Carbon\Carbon::parse(request()->post('sel-dateinicio'))->toDateTimeString() : \Carbon\Carbon::now()->toDateTimeString() ;
        $datainicioletra = request()->has('sel-dateinicio')? \Carbon\Carbon::parse(request()->post('sel-dateinicio'))->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY') : \Carbon\Carbon::now()->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY') ;
        $datafin = request()->has('sel-datefin')? \Carbon\Carbon::parse(request()->post('sel-datefin'))->toDateTimeString() : \Carbon\Carbon::now()->addDays(1)->toDateTimeString() ;
        $datafinletra = request()->post('sel-datefin') != null ? "<br>".ucfirst(\Carbon\Carbon::parse(request()->post('sel-datefin'))->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY')): "" ;
        $pds_id = ((request()->post('pdssel') != "0") and (request()->post('pdssel') != null)) || (request()->has('pdssel') and request()->post('pdssel') != "0") ? request()->post('pdssel') : "%" ;
        $global = request()->post('global') == "on"? request()->post('global') : "off" ;
        $ciudad = ((request()->post('ciudad') != "0") and (request()->post('ciudad') != null)) || (request()->has('ciudad') and request()->post('ciudad') != "0")? request()->post('ciudad') : "sc" ;
        $provincia = ((request()->post('provincia') != "0") and (request()->post('provincia') != null)) || (request()->has('provincia') and request()->post('provincia') != "0")? request()->post('provincia') : "sp" ;
        $cambio = "Global";
        if($ciudad != "sc"){
            $cambio = ucfirst($ciudad);
        }else if($pds_id != "%"){
            $cambio = (new \App\Pdsperfile())->where('id',$pds_id)->value('pds_name');
        }
        @endphp
        <div class="col-lg-9 mt-0">
            <div class="row">
                <span class="col pr-4 fechasel titulos w-50 text-right font-weight-bold">{{ucfirst($datainicioletra)}} {!! $datafinletra !!}</span>
            </div>
            <h5 class="titulos-grandes text-center">{{$cambio}}</h5>
            <div class="row">
                <span class="col pr-4 fechasel titulos w-50 font-weight-bold">Estado</span>
            </div>
            <div class="row mb-2">
                <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
                    @php
                    $datosverticales = (new \App\Encaudit())->where('categoria',"estado")->get();

                    $porcentaje = 0; 
                    $porcentaje0 = 0; 
                    $porcentaje1 = 0; 
                    $porcentaje2 = 0; 
                    $porcentaje3 = 0; 

                    @endphp

                    <ul class="indicadoresgrafE nav">
                    @forelse($datosverticales as $dv)

                        @php
                        $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                        $porcentaje_encaudit = 0; 
                        $porcentaje_encaudit0 = 0; 
                        $porcentaje_encaudit1 = 0; 
                        $porcentaje_encaudit2 = 0; 
                        $porcentaje_encaudit3 = 0; 

                        $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                        $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                        $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                        $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');
                        @endphp

                        @forelse($thc as $tc)

                            @php
                            $c = 0;
                            $c0 = 0;
                            $c1 = 0;
                            $c2 = 0;
                            $c3 = 0;
                            $cc = 0;
                            $c0c = 0;
                            $c1c = 0;
                            $c2c = 0;
                            $c3c = 0;
                            $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                            $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                            $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                            $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                            $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                            $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                            $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                            $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                            if($pds_id != "%"){
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                            } else {
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');

                                if($ciudad != "sc"){
                                    $carita = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $caritac = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                }

                                if($provincia != "sp"){
                                    $carita = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $caritac = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                }
                            }

                            $carita = $carita->value('carita');
                            $caritac = $caritac->count();
                            $carita0 = $carita0->value('carita');
                            $carita0c = $carita0c->count();
                            $carita1 = $carita1->value('carita');
                            $carita1c = $carita1c->count();
                            $carita2 = $carita2->value('carita');
                            $carita2c = $carita2c->count();
                            $carita3 = $carita3->value('carita');
                            $carita3c = $carita3c->count();

                            $c += $carita == null?"0":$carita;
                            $c0 += $carita0 == null?"0":$carita0;
                            $c1 += $carita1 == null?"0":$carita1;
                            $c2 += $carita2 == null?"0":$carita2;
                            $c3 += $carita3 == null?"0":$carita3;
                            $cc += $caritac == null?"0":$caritac;
                            $c0c += $carita0c == null?"0":$carita0c;
                            $c1c += $carita1c == null?"0":$carita1c;
                            $c2c += $carita2c == null?"0":$carita2c;
                            $c3c += $carita3c == null?"0":$carita3c;

                            $cc = $cc == "0"?"1":$cc;
                            $c0c = $c0c == "0"?"1":$c0c;
                            $c1c = $c1c == "0"?"1":$c1c;
                            $c2c = $c2c == "0"?"1":$c2c;
                            $c3c = $c3c == "0"?"1":$c3c;
                            $caritares = number_format((($c/($cc))*10)*2);
                            $carita0res = number_format((($c0/($c0c))*10)*2);
                            $carita1res = number_format((($c1/($c1c))*10)*2);
                            $carita2res = number_format((($c2/($c2c))*10)*2);
                            $carita3res = number_format((($c3/($c3c))*10)*2);

                            $porcentaje_encaudit += $caritares; 
                            $porcentaje_encaudit0 += $carita0res; 
                            $porcentaje_encaudit1 += $carita1res; 
                            $porcentaje_encaudit2 += $carita2res; 
                            $porcentaje_encaudit3 += $carita3res; 
                            @endphp

                        @empty
                        @endforelse

                        <li class="nav-item">
                            <div class="w-100">
                                <div class=" text-center">
                                    <span class="titulos">{{$dv->nombre_estado}}</span>
                                    <hr>
                                </div>
                                <div class="text-center">
                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$porcentaje_encaudit/count($datosverticales)}}">
                                </div>
                                <div class="text-center">
                                    <canvas class="lineChart{{$dv->idencaudit}}" height="100%"></canvas>
                                    <script>
                                        $(document).ready(function() {
                                            var ctx = $('.lineChart{{$dv->idencaudit}}');
                                            ctx.css('display', 'initial!important');
                                            var chartOptions = {
                                                legend: {
                                                    display: false,
                                                    position: 'top',
                                                    labels: {
                                                        boxWidth: 80,
                                                        fontColor: 'black'
                                                    }
                                                }
                                            };
                                            var myChart = new Chart(ctx, {
                                                type: 'line',
                                                options: chartOptions,
                                                data: {
                                                    labels: ['{{$mes3letra}}', '{{$mes2letra}}', '{{$mes1letra}}', '{{$mes0letra}}'],
                                                    datasets: [{
                                                        label: '',
                                                        data: [{{$porcentaje_encaudit3/count($datosverticales)}}, {{$porcentaje_encaudit2/count($datosverticales)}}, {{$porcentaje_encaudit1/count($datosverticales)}}, {{$porcentaje_encaudit0/count($datosverticales)}}],
                                                        backgroundColor: "transparent",
                                                        borderColor: "#004e92",
                                                        borderWidth: 2
                                                    }]
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </li>

                        @php
                            $porcentaje += $porcentaje_encaudit / count($datosverticales);
                            $porcentaje0 += $porcentaje_encaudit0 / count($datosverticales);
                            $porcentaje1 += $porcentaje_encaudit1 / count($datosverticales);
                            $porcentaje2 += $porcentaje_encaudit2 / count($datosverticales);
                            $porcentaje3 += $porcentaje_encaudit3 / count($datosverticales);
                        @endphp
                    @empty
                    @endforelse
<<<<<<< HEAD
=======
                    <script>
                        $(document).ready(function(){
                            //$('.indicadoresgrafE').prepend('<li class="nav-item"><div class="w-100"><div class=" text-center"><span class="titulos">Estado</span><hr></div><div class="text-center"><input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$porcentaje!=0?$porcentaje/count($datosverticales):0}}"></div><div class="text-center"><canvas class="lineChartE" height="100%"></canvas><script>$(document).ready(function() {var ctx = $(".lineChartE");ctx.css("display", "initial!important");var chartOptions = {legend: {display: false,position: "top",labels: {boxWidth: 80,fontColor: "black"}}}; var myChart = new Chart(ctx, {type: "line",options: chartOptions,data: {labels: ["{{$mes3letra}}", "{{$mes2letra}}", "{{$mes1letra}}", "{{$mes0letra}}"],datasets: [{label: "",data: [{{$porcentaje3!=0?$porcentaje3/count($datosverticales):0}}, {{$porcentaje2!=0?$porcentaje2/count($datosverticales):0}}, {{$porcentaje1!=0?$porcentaje1/count($datosverticales):0}}, {{$porcentaje0!=0?$porcentaje0/count($datosverticales):0}}],backgroundColor: "transparent",borderColor: "#004e92",borderWidth: 2}]}});});</script></div></div></li>');
                        });
                    </script>
>>>>>>> parent of 2e101ef... ok
                    </ul>
                </div>
            </div>

            <div class="row">
                <span class="col pr-4 fechasel titulos w-50 font-weight-bold">Proceso</span>
            </div>
<<<<<<< HEAD
            <div class="row">

=======
            <div class="row data-procesos">
                <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
                @php
                    $datosverticales = (new \App\Encaudit())->where('categoria',"proceso")->get();

                    $porcentaje = 0; 
                    $porcentaje0 = 0; 
                    $porcentaje1 = 0; 
                    $porcentaje2 = 0; 
                    $porcentaje3 = 0; 

                    @endphp

                    <ul class="indicadoresgrafP nav">
                    @forelse($datosverticales as $dv)

                        @php
                        $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                        $porcentaje_encaudit = 0; 
                        $porcentaje_encaudit0 = 0; 
                        $porcentaje_encaudit1 = 0; 
                        $porcentaje_encaudit2 = 0; 
                        $porcentaje_encaudit3 = 0; 

                        $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                        $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                        $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                        $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');
                        @endphp

                        @forelse($thc as $tc)

                            @php
                            $c = 0;
                            $c0 = 0;
                            $c1 = 0;
                            $c2 = 0;
                            $c3 = 0;
                            $cc = 0;
                            $c0c = 0;
                            $c1c = 0;
                            $c2c = 0;
                            $c3c = 0;
                            $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                            $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                            $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                            $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                            $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                            $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                            $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                            $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                            if($pds_id != "%"){
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$datainicio, $datafin])->where('pds_id','like',"$pds_id");
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mesactualinicio, $mesactualfin])->where('pds_id','like',"$pds_id");
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes1inicio, $mes1fin])->where('pds_id','like',"$pds_id");
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes2inicio, $mes2fin])->where('pds_id','like',"$pds_id");
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('created_at', [$mes3inicio, $mes3fin])->where('pds_id','like',"$pds_id");
                            } else {
                                $carita = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $caritac = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$datainicio, $datafin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita0c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mesactualinicio, $mesactualfin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita1c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes1inicio, $mes1fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita2c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes2inicio, $mes2fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3 = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');
                                $carita3c = (new \App\Encauditdata())->select(DB::raw('sum(carita) as carita'))->where(['encauditvalues_id'=>$tc->idencauditvalues])->whereBetween('encauditdatas.created_at', [$mes3inicio, $mes3fin])->join('pdsperfiles', 'pdsperfiles.id', '=', 'encauditdatas.pds_id');

                                if($ciudad != "sc"){
                                    $carita = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $caritac = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita0c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita1c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita2c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3 = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                    $carita3c = $carita->where('pdsperfiles.pds_ciudad',$ciudad);
                                }

                                if($provincia != "sp"){
                                    $carita = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $caritac = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita0c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita1c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita2c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3 = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                    $carita3c = $carita->where('pdsperfiles.pds_provincia',$provincia);
                                }
                            }

                            $carita = $carita->value('carita');
                            $caritac = $caritac->count();
                            $carita0 = $carita0->value('carita');
                            $carita0c = $carita0c->count();
                            $carita1 = $carita1->value('carita');
                            $carita1c = $carita1c->count();
                            $carita2 = $carita2->value('carita');
                            $carita2c = $carita2c->count();
                            $carita3 = $carita3->value('carita');
                            $carita3c = $carita3c->count();

                            $c += $carita == null?"0":$carita;
                            $c0 += $carita0 == null?"0":$carita0;
                            $c1 += $carita1 == null?"0":$carita1;
                            $c2 += $carita2 == null?"0":$carita2;
                            $c3 += $carita3 == null?"0":$carita3;
                            $cc += $caritac == null?"0":$caritac;
                            $c0c += $carita0c == null?"0":$carita0c;
                            $c1c += $carita1c == null?"0":$carita1c;
                            $c2c += $carita2c == null?"0":$carita2c;
                            $c3c += $carita3c == null?"0":$carita3c;

                            $cc = $cc == "0"?"1":$cc;
                            $c0c = $c0c == "0"?"1":$c0c;
                            $c1c = $c1c == "0"?"1":$c1c;
                            $c2c = $c2c == "0"?"1":$c2c;
                            $c3c = $c3c == "0"?"1":$c3c;
                            $caritares = number_format((($c/($cc))*10)*2);
                            $carita0res = number_format((($c0/($c0c))*10)*2);
                            $carita1res = number_format((($c1/($c1c))*10)*2);
                            $carita2res = number_format((($c2/($c2c))*10)*2);
                            $carita3res = number_format((($c3/($c3c))*10)*2);

                            $porcentaje_encaudit += $caritares; 
                            $porcentaje_encaudit0 += $carita0res; 
                            $porcentaje_encaudit1 += $carita1res; 
                            $porcentaje_encaudit2 += $carita2res; 
                            $porcentaje_encaudit3 += $carita3res; 
                            @endphp

                        @empty
                        @endforelse

                        <li class="nav-item">
                            <div class="w-100">
                                <div class=" text-center">
                                    <span class="titulos">{{$dv->nombre_estado}}</span>
                                    <hr>
                                </div>
                                <div class="text-center">
                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$porcentaje_encaudit/count($datosverticales)}}">
                                </div>
                                <div class="text-center">
                                    <canvas class="lineChart{{$dv->idencaudit}}" height="100%"></canvas>
                                    <script>
                                        $(document).ready(function() {
                                            var ctx = $('.lineChart{{$dv->idencaudit}}');
                                            ctx.css('display', 'initial!important');
                                            var chartOptions = {
                                                legend: {
                                                    display: false,
                                                    position: 'top',
                                                    labels: {
                                                        boxWidth: 80,
                                                        fontColor: 'black'
                                                    }
                                                }
                                            };
                                            var myChart = new Chart(ctx, {
                                                type: 'line',
                                                options: chartOptions,
                                                data: {
                                                    labels: ['{{$mes3letra}}', '{{$mes2letra}}', '{{$mes1letra}}', '{{$mes0letra}}'],
                                                    datasets: [{
                                                        label: '',
                                                        data: [{{$porcentaje_encaudit3/count($datosverticales)}}, {{$porcentaje_encaudit2/count($datosverticales)}}, {{$porcentaje_encaudit1/count($datosverticales)}}, {{$porcentaje_encaudit0/count($datosverticales)}}],
                                                        backgroundColor: "transparent",
                                                        borderColor: "#004e92",
                                                        borderWidth: 2
                                                    }]
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </li>

                        @php
                            $porcentaje += $porcentaje_encaudit / count($datosverticales);
                            $porcentaje0 += $porcentaje_encaudit0 / count($datosverticales);
                            $porcentaje1 += $porcentaje_encaudit1 / count($datosverticales);
                            $porcentaje2 += $porcentaje_encaudit2 / count($datosverticales);
                            $porcentaje3 += $porcentaje_encaudit3 / count($datosverticales);
                        @endphp
                    @empty
                    @endforelse
                    <script>
                        $(document).ready(function(){
                            //$('.indicadoresgrafP').prepend('<li class="nav-item"><div class="w-100"><div class=" text-center"><span class="titulos">Proceso</span><hr></div><div class="text-center"><input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$porcentaje!=0?$porcentaje/count($datosverticales):0}}"></div><div class="text-center"><canvas class="lineChartE" height="100%"></canvas><script>$(document).ready(function() {var ctx = $(".lineChartE");ctx.css("display", "initial!important");var chartOptions = {legend: {display: false,position: "top",labels: {boxWidth: 80,fontColor: "black"}}}; var myChart = new Chart(ctx, {type: "line",options: chartOptions,data: {labels: ["{{$mes3letra}}", "{{$mes2letra}}", "{{$mes1letra}}", "{{$mes0letra}}"],datasets: [{label: "",data: [{{$porcentaje3!=0?$porcentaje3/count($datosverticales):0}}, {{$porcentaje2!=0?$porcentaje2/count($datosverticales):0}}, {{$porcentaje1!=0?$porcentaje1/count($datosverticales):0}}, {{$porcentaje0!=0?$porcentaje0/count($datosverticales):0}}],backgroundColor: "transparent",borderColor: "#004e92",borderWidth: 2}]}});});</script></div></div></li>');
                        });
                    </script>
                    </ul>
                </div>
<<<<<<< HEAD
>>>>>>> parent of 2e101ef... ok
            </div>
=======
            </div>
--}}
>>>>>>> parent of 631bc70... ok
        </div>
    </div>
    @endif


</div>



@endsection
@section('script')
<script src="{{asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<script src="{{asset('assets/plugins/Chart.js/Chart.min.js')}}"></script>
<script>
    $(document).ready(function() {
        @if(request('cat') == "auditoria")
            $(".knob").knob({
                'readOnly': true,
                'rotation': "anticlockwise",
            });
            $('.loadingc').addClass('hidden');
            $('.data-procesos').css('display', 'none');
            $('.navsubitemindicadores li').click(function() {
                var data = $(this).attr('data-val');
                if (!$(this).hasClass('active')) {
                    if (data == "estado") {
                        $(this).addClass('active');
                        $(".navsubitemindicadores li[data-val='procesos']").removeClass('active');
                        $('.data-estado').css('display', 'flex');
                        $('.data-procesos').css('display', 'none');
                    } else {
                        $(this).addClass('active');
                        $(".navsubitemindicadores li[data-val='estado']").removeClass('active');
                        $('.data-procesos').css('display', 'flex');
                        $('.data-estado').css('display', 'none');
                    }
                }
            });
            $('.selglobal').click(function() {
                $('#pdssel').val(0).trigger('change');
                $('#ciudad').val(0).trigger('change');
            });
            $('#pdssel').on('select2:select', function(e) {
                $('#ciudad').val(0).trigger('change');
            });
            $('#ciudad').on('select2:select', function(e) {
                $('#pdssel').val(0).trigger('change');
            });
            $('#provincia').on('select2:select', function(e) {
                $('#ciudad').val(0).trigger('change');
                $('#pdssel').val(0).trigger('change');
            });
            $('#pdssel').select2({
                placeholder: "Seleccione un PDS",
                allowClear: false
            });
            $('#ciudad').select2({
                placeholder: "Seleccione una Ciudad",
                allowClear: false
            });
            $('#provincia').select2({
                placeholder: "Seleccione una Provincia",
                allowClear: false
            });
        @endif

        @if(request('cat') == "comisionistas")
            $(".knob").knob({
                'readOnly': true,
                'rotation': "anticlockwise",
            });
            $('.loadingc').addClass('hidden');
            $('.selglobal').click(function() {
                $('#pdssel').val(0).trigger('change');
                $('#ciudad').val(0).trigger('change');
            });
            $('#pdssel').on('select2:select', function(e) {
                $('#ciudad').val(0).trigger('change');
            });
            $('#ciudad').on('select2:select', function(e) {
                $('#pdssel').val(0).trigger('change');
            });
            $('#provincia').on('select2:select', function(e) {
                $('#ciudad').val(0).trigger('change');
                $('#pdssel').val(0).trigger('change');
            });
            $('#pdssel').select2({
                placeholder: "Seleccione un PDS",
                allowClear: false
            });
            $('#ciudad').select2({
                placeholder: "Seleccione una Ciudad",
                allowClear: false
            });
            $('#provincia').select2({
                placeholder: "Seleccione una Provincia",
                allowClear: false
            });
        @endif
    });
</script>
@endsection
