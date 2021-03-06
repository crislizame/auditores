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

        .lmhorizontal2 li a {
        }

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
                <ul class="nav lmhorizontal2" style="grid-template-columns: repeat(7, 1fr)">
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
                    <a href="{{route('indicadores')}}?cat=reporteria">
                        <li class="nav-item @if(request('cat') == "reporteria") active @endif">Reporteria</li>
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
                                    <span class=" pr-4 pl-4 w-100"><i
                                                class="fa text-center fa-sliders pointer"></i> Seleccionar rango de fecha:</span>
                                    </span>
                                </div>
                                <div class="row pt-2 pr-4 pl-4">
                                    <label for="sel-dateinicio">Inicio (o único día)</label>
                                    <input type="date" name="sel-dateinicio" id="sel-dateinicio" class="form-control "
                                           value="{{(new \Carbon\Carbon())::now()->format('Y-m-d')}}">
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
                    $datainicio = request()->has('sel-dateinicio') ? \Carbon\Carbon::parse(request()->post('sel-dateinicio'))->toDateTimeString() : \Carbon\Carbon::now()->toDateTimeString();
                    $datainicioletra = request()->has('sel-dateinicio') ? \Carbon\Carbon::parse(request()->post('sel-dateinicio'))->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY') : \Carbon\Carbon::now()->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY') ;
                    $datafin = request()->has('sel-datefin') ? \Carbon\Carbon::parse(request()->post('sel-datefin'))->toDateTimeString() : \Carbon\Carbon::now()->addDays(1)->toDateTimeString() ;
                    $datafinletra = request()->has('sel-datefin') ? "<br>".ucfirst(\Carbon\Carbon::parse(request()->post('sel-datefin'))->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY')) : "" ;
                    $pds_id = ((request()->post('pdssel') != "0") and (request()->post('pdssel') != null)) || (request()->has('pdssel') and request()->post('pdssel') != "0") ? request()->post('pdssel') : "%" ;
                    $ciudad = ((request()->post('ciudad') != "0") and (request()->post('ciudad') != null)) || (request()->has('ciudad') and request()->post('ciudad') != "0") ? request()->post('ciudad') : "sc" ;
                    $provincia = ((request()->post('provincia') != "0") and (request()->post('provincia') != null)) || (request()->has('provincia') and request()->post('provincia') != "0") ? request()->post('provincia') : "sp" ;
                    $cambio = "Global";
                    if($ciudad != "sc"){
                        $cambio = ucfirst($ciudad);
                    } else if($provincia != "sp"){
                        $cambio = ucfirst($provincia);
                    } else if($pds_id != "%"){
                        $cambio = \App\Pdsperfile::where('id', $pds_id)->value('pds_name');
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
                        <div class="col-12">
                            <div class="row">
                                <span class="pl-4 tiposel titulos w-50 text-left">{{$cambio}}</span>
                                <span class="pr-4 fechasel titulos w-50 text-right">{{ucfirst($datainicioletra)}} {!! $datafinletra !!}</span>
                            </div>
                            @php
                                $datosverticales = (new \App\Encaudit())->where([['categoria',"estado"],['nombre_estado','!=','Informes']])->get();
                                $promGlobalE = 0;
                            @endphp

                            @forelse($datosverticales as $dv)
                                @php
                                    $tgsum=0;
                                @endphp
                                <h5 class="titulos-grandes text-center tg-{{$dv->idencaudit}}">{{$dv->nombre_estado}}</h5>

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

                                            $carita = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';
                                            $caritac = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';

                                            $carita0 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';
                                            $carita0c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';

                                            $carita1 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';
                                            $carita1c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';

                                            $carita2 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';
                                            $carita2c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';

                                            $carita3 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';
                                            $carita3c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';

                                            if($pds_id != "%"){

                                              $carita .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $caritac .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita0 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita0c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita1 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita1c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita2 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita2c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita3 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita3c .= ' AND pdsperfiles.id = ' . $pds_id;

                                            }

                                            if($ciudad != "sc"){

                                              $carita .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                            }

                                            if($provincia != "sp"){

                                              $carita .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                            }

                                            $carita = DB::select($carita);
                                            $c += 0;
                                            foreach($carita as $item){
                                            $c += $item->carita;
                                            }

                                            $caritac = DB::select($caritac);
                                            $cc += 0;
                                            foreach($caritac as $item){
                                            $cc += $item->carita;
                                            }

                                            $carita0 = DB::select($carita0);
                                            $c0 += 0;
                                            foreach($carita0 as $item){
                                            $c0 += $item->carita;
                                            }

                                            $carita0c = DB::select($carita0c);
                                            $c0c += 0;
                                            foreach($carita0c as $item){
                                            $c0c += $item->carita;
                                            }

                                            $carita1 = DB::select($carita1);
                                            $c1 += 0;
                                            foreach($carita1 as $item){
                                            $c1 += $item->carita;
                                            }

                                            $carita1c = DB::select($carita1c);
                                            $c1c += 0;
                                            foreach($carita1c as $item){
                                            $c1c += $item->carita;
                                            }

                                            $carita2 = DB::select($carita2);
                                            $c2 += 0;
                                            foreach($carita2 as $item){
                                            $c2 += $item->carita;
                                            }

                                            $carita2c = DB::select($carita2c);
                                            $c2c += 0;
                                            foreach($carita2c as $item){
                                            $c2c += $item->carita;
                                            }

                                            $carita3 = DB::select($carita3);
                                            $c3 += 0;
                                            foreach($carita3 as $item){
                                            $c3 += $item->carita;
                                            }

                                            $carita3c = DB::select($carita3c);
                                            $c3c += 0;
                                            foreach($carita3c as $item){
                                            $c3c += $item->carita;
                                            }

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

                                            $tgsum += $caritares != null && $caritares > -1 ? $caritares : 0;
                                        @endphp

                                        <li class="nav-item">
                                            <div class="w-100">
                                                <div class="text-center">
                                                    <span class="titulos">{{$tc->nombre_val}}</span>
                                                    <hr>
                                                </div>
                                                <div class="text-center" style="min-width: 170px; min-height: 170px;">
                                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                           disabled data-fgcolor="#004e92"
                                                           value="{{ $caritares != null && $caritares > -1 ? $caritares : 0 }}">
                                                </div>
                                                <div class="text-center">
                                                    <canvas class="lineChartp{{$tc->idencauditvalues}}" height="100%"></canvas>
                                                    <script>
                                                        $(document).ready(function () {
                                                            var ctx = $('.lineChartp{{$tc->idencauditvalues}}');
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
                                                                        data: [
                                                                            {{ $carita3res != null && $carita3res > -1 ? $carita3res : 0 }},
                                                                            {{ $carita2res != null && $carita2res > -1 ? $carita2res : 0}},
                                                                            {{ $carita1res != null && $carita1res > -1 ? $carita1res : 0}},
                                                                            {{ $carita0res != null && $carita0res > -1 ? $carita0res : 0}}
                                                                        ],
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

                                    <script>
                                        $(document).ready(function () {
                                            $('.tg-{{$dv->idencaudit}}').html("{{$dv->nombre_estado}} {{ number_format($tgsum/count($thc)) }}%");

                                            @php
                                                $promGlobalE += number_format($tgsum/count($thc));
                                            @endphp
                                        });
                                    </script>
                                </ul>

                            @empty
                            @endforelse

                            <script>
                                $(document).ready(function () {
                                    $('[data-val="estado"]').html("Estado {{ number_format($promGlobalE / count($datosverticales)) }}%");
                                });
                            </script>
                        </div>
                    </div>
                    <div class="row data-procesos">
                        <div class="col-12">
                            <div class="row">
                                <span class="pl-4 tiposel titulos w-50 text-left">{{$cambio}}</span>
                                <span class="pr-4 fechasel titulos w-50 text-right">{{ucfirst($datainicioletra)}} {!! $datafinletra !!}</span>
                            </div>
                            @php
                                $datosverticales = (new \App\Encaudit())->where([['categoria',"procesos"],['nombre_estado','!=','Informes']])->get();
                                $promGlobalP = 0;
                            @endphp

                            @forelse($datosverticales as $dv)
                                @php
                                    $tgsum=0;
                                @endphp
                                <h5 class="titulos-grandes text-center tg-{{$dv->idencaudit}}">{{$dv->nombre_estado}}</h5>

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

                                            $carita = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';
                                            $caritac = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';

                                            $carita0 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';
                                            $carita0c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';

                                            $carita1 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';
                                            $carita1c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';

                                            $carita2 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';
                                            $carita2c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';

                                            $carita3 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';
                                            $carita3c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';

                                            if($pds_id != "%"){

                                              $carita .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $caritac .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita0 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita0c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita1 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita1c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita2 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita2c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita3 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita3c .= ' AND pdsperfiles.id = ' . $pds_id;

                                            }

                                            if($ciudad != "sc"){

                                              $carita .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                            }

                                            if($provincia != "sp"){

                                              $carita .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                            }

                                            $carita = DB::select($carita);
                                            $c += 0;
                                            foreach($carita as $item){
                                            $c += $item->carita;
                                            }

                                            $caritac = DB::select($caritac);
                                            $cc += 0;
                                            foreach($caritac as $item){
                                            $cc += $item->carita;
                                            }

                                            $carita0 = DB::select($carita0);
                                            $c0 += 0;
                                            foreach($carita0 as $item){
                                            $c0 += $item->carita;
                                            }

                                            $carita0c = DB::select($carita0c);
                                            $c0c += 0;
                                            foreach($carita0c as $item){
                                            $c0c += $item->carita;
                                            }

                                            $carita1 = DB::select($carita1);
                                            $c1 += 0;
                                            foreach($carita1 as $item){
                                            $c1 += $item->carita;
                                            }

                                            $carita1c = DB::select($carita1c);
                                            $c1c += 0;
                                            foreach($carita1c as $item){
                                            $c1c += $item->carita;
                                            }

                                            $carita2 = DB::select($carita2);
                                            $c2 += 0;
                                            foreach($carita2 as $item){
                                            $c2 += $item->carita;
                                            }

                                            $carita2c = DB::select($carita2c);
                                            $c2c += 0;
                                            foreach($carita2c as $item){
                                            $c2c += $item->carita;
                                            }

                                            $carita3 = DB::select($carita3);
                                            $c3 += 0;
                                            foreach($carita3 as $item){
                                            $c3 += $item->carita;
                                            }

                                            $carita3c = DB::select($carita3c);
                                            $c3c += 0;
                                            foreach($carita3c as $item){
                                            $c3c += $item->carita;
                                            }

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

                                            $tgsum += $caritares != null && $caritares > -1 ? $caritares : 0;
                                        @endphp

                                        <li class="nav-item">
                                            <div class="w-100">
                                                <div class="text-center">
                                                    <span class="titulos">{{$tc->nombre_val}}</span>
                                                    <hr>
                                                </div>
                                                <div class="text-center" style="min-width: 170px; min-height: 170px;">
                                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                           disabled data-fgcolor="#004e92"
                                                           value="{{ $caritares != null && $caritares > -1 ? $caritares : 0 }}">
                                                </div>
                                                <div class="text-center">
                                                    <canvas class="lineChartp{{$tc->idencauditvalues}}" height="100%"></canvas>
                                                    <script>
                                                        $(document).ready(function () {
                                                            var ctx = $('.lineChartp{{$tc->idencauditvalues}}');
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
                                                                        data: [
                                                                            {{ $carita3res != null && $carita3res > -1 ? $carita3res : 0 }},
                                                                            {{ $carita2res != null && $carita2res > -1 ? $carita2res : 0}},
                                                                            {{ $carita1res != null && $carita1res > -1 ? $carita1res : 0}},
                                                                            {{ $carita0res != null && $carita0res > -1 ? $carita0res : 0}}
                                                                        ],
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

                                    <script>
                                        $(document).ready(function () {
                                            $('.tg-{{$dv->idencaudit}}').html("{{$dv->nombre_estado}} {{ number_format( $tgsum/count($thc) ) }}%");

                                            @php
                                                $promGlobalP += number_format( $tgsum/count($thc) );
                                            @endphp
                                        });
                                    </script>
                                </ul>

                            @empty
                            @endforelse

                            <script>
                                $(document).ready(function () {
                                    $('[data-val="procesos"]').html("Procesos {{ number_format($promGlobalP / count($datosverticales)) }}%");
                                });
                            </script>
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
                                    <span class=" pr-4 pl-4 w-100"><i
                                                class="fa text-center fa-sliders pointer"></i> Seleccionar rango de fecha:</span>
                                    </span>
                                </div>
                                <div class="row pt-2 pr-4 pl-4">
                                    <label for="sel-dateinicio">Inicio (o único día)</label>
                                    <input type="date" name="sel-dateinicio" id="sel-dateinicio" class="form-control "
                                           value="{{(new \Carbon\Carbon())::now()->format('Y-m-d')}}">
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
                    <h5 class="titulos-grandes text-center" id="GGlobal">{{$cambio}}</h5>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="col titulos-grandes text-center" id="GEstado">Estado</h5>
                        </div>
                    </div>
                    <div class="row data-estado mb-2">
                        <div class="col-12">
                            @php
                                $datosverticales = (new \App\Encaudit())->where([['categoria',"estado"],['nombre_estado','!=','Informes']])->get();

                                $totaldatosverticalesE = count($datosverticales);

                                $porcentajeE = 0;
                                $porcentajeE0 = 0;
                                $porcentajeE1 = 0;
                                $porcentajeE2 = 0;
                                $porcentajeE3 = 0;

                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                            @endphp

                            <ul class="indicadoresgraf nav lista-estado">
                                @forelse($datosverticales as $dv)

                                    @php
                                        $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                                        $porcentaje_encaudit = 0;
                                        $porcentaje_encaudit0 = 0;
                                        $porcentaje_encaudit1 = 0;
                                        $porcentaje_encaudit2 = 0;
                                        $porcentaje_encaudit3 = 0;
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

                                            $carita = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';
                                            $caritac = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';

                                            $carita0 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';
                                            $carita0c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';

                                            $carita1 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';
                                            $carita1c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';

                                            $carita2 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';
                                            $carita2c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';

                                            $carita3 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';
                                            $carita3c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';

                                            if($pds_id != "%"){

                                              $carita .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $caritac .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita0 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita0c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita1 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita1c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita2 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita2c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita3 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita3c .= ' AND pdsperfiles.id = ' . $pds_id;

                                            }

                                            if($ciudad != "sc"){

                                              $carita .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                            }

                                            if($provincia != "sp"){

                                              $carita .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                            }

                                            $carita = DB::select($carita);
                                            $c += 0;
                                            foreach($carita as $item){
                                            $c += $item->carita;
                                            }

                                            $caritac = DB::select($caritac);
                                            $cc += 0;
                                            foreach($caritac as $item){
                                            $cc += $item->carita;
                                            }

                                            $carita0 = DB::select($carita0);
                                            $c0 += 0;
                                            foreach($carita0 as $item){
                                            $c0 += $item->carita;
                                            }

                                            $carita0c = DB::select($carita0c);
                                            $c0c += 0;
                                            foreach($carita0c as $item){
                                            $c0c += $item->carita;
                                            }

                                            $carita1 = DB::select($carita1);
                                            $c1 += 0;
                                            foreach($carita1 as $item){
                                            $c1 += $item->carita;
                                            }

                                            $carita1c = DB::select($carita1c);
                                            $c1c += 0;
                                            foreach($carita1c as $item){
                                            $c1c += $item->carita;
                                            }

                                            $carita2 = DB::select($carita2);
                                            $c2 += 0;
                                            foreach($carita2 as $item){
                                            $c2 += $item->carita;
                                            }

                                            $carita2c = DB::select($carita2c);
                                            $c2c += 0;
                                            foreach($carita2c as $item){
                                            $c2c += $item->carita;
                                            }

                                            $carita3 = DB::select($carita3);
                                            $c3 += 0;
                                            foreach($carita3 as $item){
                                            $c3 += $item->carita;
                                            }

                                            $carita3c = DB::select($carita3c);
                                            $c3c += 0;
                                            foreach($carita3c as $item){
                                            $c3c += $item->carita;
                                            }

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
                                                <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                       disabled data-fgcolor="#004e92" value="{{number_format($porcentaje_encaudit/count($thc), 2)}}">
                                            </div>
                                            <div class="text-center">
                                                <canvas class="lineChart{{$dv->idencaudit}}" height="100%"></canvas>
                                                <script>
                                                    $(document).ready(function () {
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
                                                                    data: [
                                                                        {{number_format($porcentaje_encaudit3/count($thc), 2)}},
                                                                        {{number_format($porcentaje_encaudit2/count($thc), 2)}},
                                                                        {{number_format($porcentaje_encaudit1/count($thc), 2)}},
                                                                        {{number_format($porcentaje_encaudit0/count($thc), 2)}}],
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
                                        $porcentajeE += $porcentaje_encaudit / count($thc);
                                        $porcentajeE0 += $porcentaje_encaudit0 / count($thc);
                                        $porcentajeE1 += $porcentaje_encaudit1 / count($thc);
                                        $porcentajeE2 += $porcentaje_encaudit2 / count($thc);
                                        $porcentajeE3 += $porcentaje_encaudit3 / count($thc);
                                    @endphp
                                @empty
                                @endforelse
                            </ul>
                            <script>
                                $(document).ready(function () {
                                    $('#GEstado').html("Estado {{$porcentajeE!=0?number_format($porcentajeE/$totaldatosverticalesE, 2):0}}%");
                                });
                            </script>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="col titulos-grandes text-center" id="GProceso">Proceso</h5>
                    </div>
                    <div class="row data-procesos">
                        <div class="col-12">
                            @php
                                $datosverticales = (new \App\Encaudit())->where([['categoria',"procesos"],['nombre_estado','!=','Informes']])->get();

                                $totaldatosverticalesP = count($datosverticales);

                                $porcentajeP = 0;
                                $porcentajeP0 = 0;
                                $porcentajeP1 = 0;
                                $porcentajeP2 = 0;
                                $porcentajeP3 = 0;

                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                            @endphp

                            <ul class="indicadoresgraf nav lista-proceso">
                                @forelse($datosverticales as $dv)

                                    @php
                                        $thc = (new \App\Encauditvalue())->where('encaudit_id',$dv->idencaudit)->get();
                                        $porcentaje_encaudit = 0;
                                        $porcentaje_encaudit0 = 0;
                                        $porcentaje_encaudit1 = 0;
                                        $porcentaje_encaudit2 = 0;
                                        $porcentaje_encaudit3 = 0;
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

                                            $carita = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';
                                            $caritac = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $datainicio . '\' AND \'' . $datafin . '\'';

                                            $carita0 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';
                                            $carita0c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mesactualinicio . '\' AND \'' . $mesactualfin . '\'';

                                            $carita1 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';
                                            $carita1c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes1inicio . '\' AND \'' . $mes1fin . '\'';

                                            $carita2 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';
                                            $carita2c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes2inicio . '\' AND \'' . $mes2fin . '\'';

                                            $carita3 = 'SELECT COUNT(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';
                                            $carita3c = 'SELECT sum(carita) as carita FROM encauditdatas JOIN pdsperfiles ON pdsperfiles.id = encauditdatas.pds_id
                                              WHERE encauditvalues_id = ' . $tc->idencauditvalues . ' AND encauditdatas.created_at BETWEEN \'' . $mes3inicio . '\' AND \'' . $mes3fin . '\'';

                                            if($pds_id != "%"){

                                              $carita .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $caritac .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita0 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita0c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita1 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita1c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita2 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita2c .= ' AND pdsperfiles.id = ' . $pds_id;

                                              $carita3 .= ' AND pdsperfiles.id = ' . $pds_id;
                                              $carita3c .= ' AND pdsperfiles.id = ' . $pds_id;

                                            }

                                            if($ciudad != "sc"){

                                              $carita .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_ciudad = \'' . $ciudad . '\'';

                                            }

                                            if($provincia != "sp"){

                                              $carita .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $caritac .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita0 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita0c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita1 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita1c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita2 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita2c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                              $carita3 .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';
                                              $carita3c .= ' AND pdsperfiles.pds_provincia = \'' . $provincia . '\'';

                                            }

                                            $carita = DB::select($carita);
                                            $c += 0;
                                            foreach($carita as $item){
                                            $c += $item->carita;
                                            }

                                            $caritac = DB::select($caritac);
                                            $cc += 0;
                                            foreach($caritac as $item){
                                            $cc += $item->carita;
                                            }

                                            $carita0 = DB::select($carita0);
                                            $c0 += 0;
                                            foreach($carita0 as $item){
                                            $c0 += $item->carita;
                                            }

                                            $carita0c = DB::select($carita0c);
                                            $c0c += 0;
                                            foreach($carita0c as $item){
                                            $c0c += $item->carita;
                                            }

                                            $carita1 = DB::select($carita1);
                                            $c1 += 0;
                                            foreach($carita1 as $item){
                                            $c1 += $item->carita;
                                            }

                                            $carita1c = DB::select($carita1c);
                                            $c1c += 0;
                                            foreach($carita1c as $item){
                                            $c1c += $item->carita;
                                            }

                                            $carita2 = DB::select($carita2);
                                            $c2 += 0;
                                            foreach($carita2 as $item){
                                            $c2 += $item->carita;
                                            }

                                            $carita2c = DB::select($carita2c);
                                            $c2c += 0;
                                            foreach($carita2c as $item){
                                            $c2c += $item->carita;
                                            }

                                            $carita3 = DB::select($carita3);
                                            $c3 += 0;
                                            foreach($carita3 as $item){
                                            $c3 += $item->carita;
                                            }

                                            $carita3c = DB::select($carita3c);
                                            $c3c += 0;
                                            foreach($carita3c as $item){
                                            $c3c += $item->carita;
                                            }

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
                                                <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                       disabled data-fgcolor="#004e92" value="{{number_format($porcentaje_encaudit/count($thc), 2)}}">
                                            </div>
                                            <div class="text-center">
                                                <canvas class="lineChart{{$dv->idencaudit}}" height="100%"></canvas>
                                                <script>
                                                    $(document).ready(function () {
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
                                                                    data: [
                                                                        {{number_format($porcentaje_encaudit3/count($thc), 2)}},
                                                                        {{number_format($porcentaje_encaudit2/count($thc), 2)}},
                                                                        {{number_format($porcentaje_encaudit1/count($thc), 2)}},
                                                                        {{number_format($porcentaje_encaudit0/count($thc), 2)}}],
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
                                        $porcentajeP += $porcentaje_encaudit / count($thc);
                                        $porcentajeP0 += $porcentaje_encaudit0 / count($thc);
                                        $porcentajeP1 += $porcentaje_encaudit1 / count($thc);
                                        $porcentajeP2 += $porcentaje_encaudit2 / count($thc);
                                        $porcentajeP3 += $porcentaje_encaudit3 / count($thc);
                                    @endphp
                                @empty
                                @endforelse
                            </ul>
                            <script>
                                $(document).ready(function () {
                                    $('#GProceso').html("Proceso {{$porcentajeP!=0?number_format($porcentajeP/$totaldatosverticalesP, 2):0}}%");
                                    @php
                                        $percentE = $porcentajeE!=0?number_format($porcentajeE/$totaldatosverticalesE, 2):0;
                                        $percentP = $porcentajeP!=0?number_format($porcentajeP/$totaldatosverticalesP, 2):0;
                                    @endphp
                                    $('#GGlobal').html("{{ $cambio . ' ' . number_format( ($percentE + $percentP ) / 2, 2 ) }}%")
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(request('cat') == "mantenimiento")
            @php
                $category = 'Mantenimiento';
            @endphp
            <div class="row h-100">
                <div class="col-lg-3 mt-0">
                    <span class="titulos text-info bold">Filtrar</span>
                    <div class="card pb-3 m-0">
                        <form action="{{route('indicadores')}}?cat=mantenimiento" method="post">
                            {{csrf_field()}}
                            <div class="card-body pt-1">
                                <div class="row align-content-center text-center">
                                    <span class=" pr-4 pl-4 w-100"><i
                                                class="fa text-center fa-sliders pointer"></i> Seleccionar rango de fecha:</span>
                                </div>
                                <div class="row pt-2 pr-4 pl-4">
                                    <label for="sel-dateinicio">Inicio (o único día)</label>
                                    <input type="date" name="sel-dateinicio" id="sel-dateinicio" class="form-control "
                                           value="{{(new \Carbon\Carbon())::now()->format('Y-m-d')}}">
                                </div>
                                <div class="row pt-2 pb-3 pr-4 pl-4">
                                    <label for="sel-datefin">Fin (si es único día dejar en blanco)</label>
                                    <input type="date" name="sel-datefin" id="sel-datefin" class="form-control ">
                                </div>
                                <hr class="pb-2">
                                <div class="row align-content-center text-center">
                                    <span class=" pr-4 pl-4 w-100"><i class="fa text-center fa-sliders "></i> Seleccionar escala:</span>
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
                    <h5 class="titulos-grandes text-center">Tiempo</h5>
                    <div class="row">
                        <span class="col pr-4 fechasel titulos w-50 font-weight-bold">Estado</span>
                    </div>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="row mt-2 mb-1">
                                <div class="col-md-6 text-primary">Solicitado - Proceso</div>
                                <div class="col-md-6 text-primary">Proceso - Cerrado</div>
                            </div>
                            <hr class="mb-2">
                            <div class="row mb-1">
                                @php
                                    $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado')
                                    ->join('problemas','orden_requermientos.problema_id','problemas.id')
                                    ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                                    ->join('areas','subareas.area_id','areas.idareas')
                                    ->join('entidades','areas.entidad_id','entidades.identidad')
                                    ->where('entidades.nombre', $category)
                                    ->whereBetween('solicitado', [$datainicio, $datafin]);
                                    if($pds_id != "%"){
                                        $ordenes = $ordenes->where("pds_id",$pds_id);
                                    } else {
                                        if($ciudad != "sc"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                        }
                                        if($provincia != "sp"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                        }
                                    }
                                    $ordenes = $ordenes->get();
                                    $tiempoSP = 0;
                                    $tiempoPF = 0;
                                    foreach($ordenes as $orden){
                                        $tiempoSP += \Carbon\Carbon::parse($orden->solicitado)->diffInMinutes($orden->enproceso);
                                        $tiempoPF += \Carbon\Carbon::parse($orden->enproceso)->diffInMinutes($orden->finalizado);
                                    }
                                    $tSP = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoSP/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                    $tPF = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoPF/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                @endphp
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tSP->format('H:i')}}</h2></div>
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tPF->format('H:i')}}</h2></div>
                            </div>
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Calificación de Gestión al Comisionista</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        @php
                            $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                            ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                            ->leftJoin('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                            ->join('problemas','orden_requermientos.problema_id','problemas.id')
                            ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                            ->join('areas','subareas.area_id','areas.idareas')
                            ->join('entidades','areas.entidad_id','entidades.identidad')
                            ->where('entidades.nombre',$category)
                            ->whereBetween('solicitado', [$datainicio, $datafin]);
                            if($pds_id != "%"){
                                $ordenes = $ordenes->where("pds_id",$pds_id);
                            } else {
                                if($ciudad != "sc"){
                                    $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                }
                                if($provincia != "sp"){
                                    $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                }
                            }
                            $ordenes = $ordenes->get();
                            $calificaciones = 0;
                            $diasParaResolver = 0;
                            foreach($ordenes as $orden){
                                $calificaciones += $orden->calificacion;

                                $diasParaResolver += $orden->enproceso != null && $orden->finalizado != null ? 
                                \Carbon\Carbon::parse($orden->enproceso)->diffInHours(\Carbon\Carbon::parse($orden->finalizado))
                                 : 0;
                            }
                            if(count($ordenes)>0){
                                $promedioDiasParaResolver = ceil($diasParaResolver/count($ordenes));
                            }else{
                                $promedioDiasParaResolver = 0;
                            }
                            $porcentaje = 0;
                            if(count($ordenes)>0){
                                switch(ceil($calificaciones/count($ordenes))){
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
                            }
                        @endphp
                        <div class="row col-md-3 offset-md-4 text-center p-0">
                            <div class="col-6 p-0 mx-auto">
                                <div class="calificacion mx-auto"></div>
                            </div>
                            <div class="col-6 p-0 my-auto mx-auto"><h2 class="text-primary"><b>{{ $porcentaje }}%</b></h2></div>
                        </div>
                        <style>
                            .calificacion {
                                width: 80px;
                                height: 80px;
                                background-repeat: no-repeat;
                                background-position: center;
                                background-image: url("{{url('/img/cara')}}{{ count($ordenes)>0?ceil($calificaciones/count($ordenes)):0 }}.jpg");
                            }
                        </style>
                    </div>

                    <h5 class="titulos-grandes text-center">Promedio de tiempo en solucionar</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="row col-md-4 offset-md-4 text-center p-0">
                            <div class="col p-0 my-auto mx-auto"><h2 class="text-primary"><b>{{ $promedioDiasParaResolver.':00 horas' }}</b></h2></div>
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Resultado de reporteria</h5>
                    <div class="row data-estado mb-2">
                        <div class="col-12">
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $ordenesS = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                $ordenesS0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                $ordenesS1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                $ordenesS2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                $ordenesS3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                                $ordenesF = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                $ordenesF0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                $ordenesF1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                $ordenesF2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                $ordenesF3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                        function porcentaje( $a, $b ){
                            if( $a > $b ){
                                return $b / $a * 100;
                            } else if( $b > $a ){
                                return $a / $b * 100;
                            } else {
                                return 0;
                            }
                        }

                                                $ordenesP = $ordenesS != 0 && $ordenesF != 0 ? porcentaje( $ordenesS, $ordenesF ) : 0;
                                                $ordenesP0 = $ordenesS0 != 0 && $ordenesF0 != 0 ? porcentaje( $ordenesS0, $ordenesF0 ) : 0;
                                                $ordenesP1 = $ordenesS1 != 0 && $ordenesF1 != 0 ? porcentaje( $ordenesS1, $ordenesF1 ) : 0;
                                                $ordenesP2 = $ordenesS2 != 0 && $ordenesF2 != 0 ? porcentaje( $ordenesS2, $ordenesF2 ) : 0;
                                                $ordenesP3 = $ordenesS3 != 0 && $ordenesF3 != 0 ? porcentaje( $ordenesS3, $ordenesF3 ) : 0;
                            @endphp
                            
                            <ul class="indicadoresgraf nav lista-estado">

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesS }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartS" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartS');
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
                                                                data: [{{$ordenesS3}}, {{$ordenesS2}}, {{$ordenesS1}}, {{$ordenesS0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento solucionadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesF }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartF" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartF');
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
                                                                data: [{{$ordenesF3}}, {{$ordenesF2}}, {{$ordenesF1}}, {{$ordenesF0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">Porcentaje de Solucionadas VS Ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ (int) $ordenesP }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartP" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartP');
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
                                                                data: [{{$ordenesP3}}, {{$ordenesP2}}, {{$ordenesP1}}, {{$ordenesP0}}],
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

                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        @endif

        @if(request('cat') == "soporte")
            @php
                $category = 'Soporte';
            @endphp
            <div class="row h-100">
                <div class="col-lg-3 mt-0">
                    <span class="titulos text-info bold">Filtrar</span>
                    <div class="card pb-3 m-0">
                        <form action="{{route('indicadores')}}?cat=soporte" method="post">
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
                    <h5 class="titulos-grandes text-center">Tiempo</h5>
                    <div class="row">
                        <span class="col pr-4 fechasel titulos w-50 font-weight-bold">Estado</span>
                    </div>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="row mt-2 mb-1">
                                <div class="col-md-6 text-primary">Solicitado - Proceso</div>
                                <div class="col-md-6 text-primary">Proceso - Cerrado</div>
                            </div>
                            <hr class="mb-2">
                            <div class="row mb-1">
                                @php
                                    $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado')
                                    ->join('problemas','orden_requermientos.problema_id','problemas.id')
                                    ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                                    ->join('areas','subareas.area_id','areas.idareas')
                                    ->join('entidades','areas.entidad_id','entidades.identidad')
                                    ->where('entidades.nombre', $category)
                                    ->whereBetween('solicitado', [$datainicio, $datafin]);
                                    if($pds_id != "%"){
                                        $ordenes = $ordenes->where("pds_id",$pds_id);
                                    } else {
                                        if($ciudad != "sc"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                        }
                                        if($provincia != "sp"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                        }
                                    }
                                    $ordenes = $ordenes->get();
                                    $tiempoSP = 0;
                                    $tiempoPF = 0;
                                    foreach($ordenes as $orden){
                                        $tiempoSP += \Carbon\Carbon::parse($orden->solicitado)->diffInMinutes($orden->enproceso);
                                        $tiempoPF += \Carbon\Carbon::parse($orden->enproceso)->diffInMinutes($orden->finalizado);
                                    }
                                    $tSP = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoSP/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                    $tPF = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoPF/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                @endphp
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tSP->format('H:i')}}</h2></div>
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tPF->format('H:i')}}</h2></div>
                            </div>
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Calificación de Gestión al Comisionista</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        @php
                            $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                            ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                            ->leftJoin('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                            ->join('problemas','orden_requermientos.problema_id','problemas.id')
                            ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                            ->join('areas','subareas.area_id','areas.idareas')
                            ->join('entidades','areas.entidad_id','entidades.identidad')
                            ->where('entidades.nombre',$category)
                            ->whereBetween('solicitado', [$datainicio, $datafin]);
                            if($pds_id != "%"){
                                $ordenes = $ordenes->where("pds_id",$pds_id);
                            } else {
                                if($ciudad != "sc"){
                                    $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                }
                                if($provincia != "sp"){
                                    $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                }
                            }
                            $ordenes = $ordenes->get();
                            $calificaciones = 0;
                            $diasParaResolver = 0;
                            foreach($ordenes as $orden){
                                $calificaciones += $orden->calificacion;

                                $diasParaResolver += $orden->enproceso != null && $orden->finalizado != null ? 
                                \Carbon\Carbon::parse($orden->enproceso)->diffInHours(\Carbon\Carbon::parse($orden->finalizado))
                                 : 0;
                            }
                            if(count($ordenes)>0){
                                $promedioDiasParaResolver = ceil($diasParaResolver/count($ordenes));
                            }else{
                                $promedioDiasParaResolver = 0;
                            }
                            $porcentaje = 0;
                            if(count($ordenes)>0){
                                switch(ceil($calificaciones/count($ordenes))){
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
                            }
                        @endphp
                        <div class="row col-md-3 offset-md-4 text-center p-0">
                            <div class="col-6 p-0 mx-auto"><div class="calificacion mx-auto"></div></div>
                            <div class="col-6 p-0 my-auto mx-auto"><h2 class="text-primary"><b>{{ $porcentaje }}%</b></h2></div>
                        </div>
                        <style>
                            .calificacion {
                                width: 80px;
                                height: 80px;
                                background-repeat: no-repeat;
                                background-position: center;
                                background-image:url("{{url('/img/cara')}}{{ count($ordenes)>0?ceil($calificaciones/count($ordenes)):0 }}.jpg");
                            }
                        </style>
                    </div>

                    <h5 class="titulos-grandes text-center">Promedio de tiempo en solucionar</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="row col-md-4 offset-md-4 text-center p-0">
                            <div class="col p-0 my-auto mx-auto"><h2 class="text-primary"><b>{{ $promedioDiasParaResolver.':00 horas' }}</b></h2></div>
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Resultado de reporteria</h5>
                    <div class="row data-estado mb-2">
                        <div class="col-12">
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $ordenesS = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                $ordenesS0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                $ordenesS1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                $ordenesS2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                $ordenesS3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                                $ordenesF = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                $ordenesF0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                $ordenesF1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                $ordenesF2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                $ordenesF3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                        function porcentaje( $a, $b ){
                            if( $a > $b ){
                                return $b / $a * 100;
                            } else if( $b > $a ){
                                return $a / $b * 100;
                            } else {
                                return 0;
                            }
                        }

                                                $ordenesP = $ordenesS != 0 && $ordenesF != 0 ? porcentaje( $ordenesS, $ordenesF ) : 0;
                                                $ordenesP0 = $ordenesS0 != 0 && $ordenesF0 != 0 ? porcentaje( $ordenesS0, $ordenesF0 ) : 0;
                                                $ordenesP1 = $ordenesS1 != 0 && $ordenesF1 != 0 ? porcentaje( $ordenesS1, $ordenesF1 ) : 0;
                                                $ordenesP2 = $ordenesS2 != 0 && $ordenesF2 != 0 ? porcentaje( $ordenesS2, $ordenesF2 ) : 0;
                                                $ordenesP3 = $ordenesS3 != 0 && $ordenesF3 != 0 ? porcentaje( $ordenesS3, $ordenesF3 ) : 0;
                            @endphp


                            <ul class="indicadoresgraf nav lista-estado">

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesS }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartS" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartS');
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
                                                                data: [{{$ordenesS3}}, {{$ordenesS2}}, {{$ordenesS1}}, {{$ordenesS0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento solucionadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesF }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartF" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartF');
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
                                                                data: [{{$ordenesF3}}, {{$ordenesF2}}, {{$ordenesF1}}, {{$ordenesF0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">Porcentaje de Solucionadas VS Ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ (int) $ordenesP }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartP" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartP');
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
                                                                data: [{{$ordenesP3}}, {{$ordenesP2}}, {{$ordenesP1}}, {{$ordenesP0}}],
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

                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        @endif

        @if(request('cat') == "rp3")
            @php
                $category = 'RP3';
            @endphp
            <div class="row h-100">
                <div class="col-lg-3 mt-0">
                    <span class="titulos text-info bold">Filtrar</span>
                    <div class="card pb-3 m-0">
                        <form action="{{route('indicadores')}}?cat=rp3" method="post">
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
                    <h5 class="titulos-grandes text-center">Tiempo</h5>
                    <div class="row">
                        <span class="col pr-4 fechasel titulos w-50 font-weight-bold">Estado</span>
                    </div>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="row mt-2 mb-1">
                                <div class="col-md-6 text-primary">Solicitado - Proceso</div>
                                <div class="col-md-6 text-primary">Proceso - Cerrado</div>
                            </div>
                            <hr class="mb-2">
                            <div class="row mb-1">
                                @php
                                    $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado')
                                    ->join('problemas','orden_requermientos.problema_id','problemas.id')
                                    ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                                    ->join('areas','subareas.area_id','areas.idareas')
                                    ->join('entidades','areas.entidad_id','entidades.identidad')
                                    ->where('entidades.nombre', $category)
                                    ->whereBetween('solicitado', [$datainicio, $datafin]);
                                    if($pds_id != "%"){
                                        $ordenes = $ordenes->where("pds_id",$pds_id);
                                    } else {
                                        if($ciudad != "sc"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                        }
                                        if($provincia != "sp"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                        }
                                    }
                                    $ordenes = $ordenes->get();
                                    $tiempoSP = 0;
                                    $tiempoPF = 0;
                                    foreach($ordenes as $orden){
                                        $tiempoSP += \Carbon\Carbon::parse($orden->solicitado)->diffInMinutes($orden->enproceso);
                                        $tiempoPF += \Carbon\Carbon::parse($orden->enproceso)->diffInMinutes($orden->finalizado);
                                    }
                                    $tSP = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoSP/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                    $tPF = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoPF/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                @endphp
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tSP->format('H:i')}}</h2></div>
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tPF->format('H:i')}}</h2></div>
                            </div>
                        </div>
                    </div>

                    @php
                        $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                        ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                        ->leftJoin('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                        ->join('problemas','orden_requermientos.problema_id','problemas.id')
                        ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                        ->join('areas','subareas.area_id','areas.idareas')
                        ->join('entidades','areas.entidad_id','entidades.identidad')
                        ->where('entidades.nombre',$category)
                        ->whereBetween('solicitado', [$datainicio, $datafin]);
                        if($pds_id != "%"){
                            $ordenes = $ordenes->where("pds_id",$pds_id);
                        } else {
                            if($ciudad != "sc"){
                                $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                            }
                            if($provincia != "sp"){
                                $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                            }
                        }
                        $ordenes = $ordenes->get();
                        $calificaciones = 0;
                        $diasParaResolver = 0;
                        foreach($ordenes as $orden){
                            $calificaciones += $orden->calificacion;

                            $diasParaResolver += $orden->enproceso != null && $orden->finalizado != null ? 
                            \Carbon\Carbon::parse($orden->enproceso)->diffInHours(\Carbon\Carbon::parse($orden->finalizado))
                             : 0;
                        }
                        if(count($ordenes)>0){
                            $promedioDiasParaResolver = ceil($diasParaResolver/count($ordenes));
                        }else{
                            $promedioDiasParaResolver = 0;
                        }
                        $porcentaje = 0;
                        if(count($ordenes)>0){
                            switch(ceil($calificaciones/count($ordenes))){
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
                        }
                    @endphp

                    <h5 class="titulos-grandes text-center">Promedio de tiempo en solucionar</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="row col-md-4 offset-md-4 text-center p-0">
                            <div class="col p-0 my-auto mx-auto"><h2 class="text-primary"><b>{{ $promedioDiasParaResolver.':00 horas' }}</b></h2></div>
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Resultado de reporteria</h5>
                    <div class="row data-estado mb-2">
                        <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $ordenesS = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                $ordenesS0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                $ordenesS1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                $ordenesS2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                $ordenesS3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                                $ordenesF = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                $ordenesF0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                $ordenesF1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                $ordenesF2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                $ordenesF3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                        function porcentaje( $a, $b ){
                            if( $a > $b ){
                                return $b / $a * 100;
                            } else if( $b > $a ){
                                return $a / $b * 100;
                            } else {
                                return 0;
                            }
                        }

                                                $ordenesP = $ordenesS != 0 && $ordenesF != 0 ? porcentaje( $ordenesS, $ordenesF ) : 0;
                                                $ordenesP0 = $ordenesS0 != 0 && $ordenesF0 != 0 ? porcentaje( $ordenesS0, $ordenesF0 ) : 0;
                                                $ordenesP1 = $ordenesS1 != 0 && $ordenesF1 != 0 ? porcentaje( $ordenesS1, $ordenesF1 ) : 0;
                                                $ordenesP2 = $ordenesS2 != 0 && $ordenesF2 != 0 ? porcentaje( $ordenesS2, $ordenesF2 ) : 0;
                                                $ordenesP3 = $ordenesS3 != 0 && $ordenesF3 != 0 ? porcentaje( $ordenesS3, $ordenesF3 ) : 0;
                            @endphp
                            

                            <ul class="indicadoresgraf nav lista-estado">

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesS }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartS" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartS');
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
                                                                data: [{{$ordenesS3}}, {{$ordenesS2}}, {{$ordenesS1}}, {{$ordenesS0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento solucionadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesF }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartF" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartF');
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
                                                                data: [{{$ordenesF3}}, {{$ordenesF2}}, {{$ordenesF1}}, {{$ordenesF0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">Porcentaje de Solucionadas VS Ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ (int) $ordenesP }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartP" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartP');
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
                                                                data: [{{$ordenesP3}}, {{$ordenesP2}}, {{$ordenesP1}}, {{$ordenesP0}}],
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

                            </ul>

                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center tauditorias" style="display: none;">Auditorias</h5>
                    <div class="row data-estado mb-2" style="display: none;">
                        <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $ordenes = \Illuminate\Support\Facades\DB::select("SELECT subareas.nombre as subarea, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY subareas.nombre");

                                $tproblemas = 0;
                            @endphp

                            <ul class="indicadoresgraf nav lista-estado">
                                @forelse($ordenes as $orden)
                                    @php
                                        $tproblemas += $orden->problemas;
                                        $ordenes0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND subareas.nombre = '$orden->subarea' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                        $ordenes1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND subareas.nombre = '$orden->subarea' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                        $ordenes2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND subareas.nombre = '$orden->subarea' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                        $ordenes3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND subareas.nombre = '$orden->subarea' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));
                                    @endphp
                                    <li class="nav-item">
                                        <div class="w-100">
                                            <div class=" text-center">
                                                <span class="titulos">{{$orden->subarea}}</span>
                                                <hr>
                                            </div>
                                            <div class="text-center">
                                                <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{ $orden->problemas }}">
                                            </div>
                                            <div class="text-center">
                                                <canvas class="lineChart{{$orden->subarea}}" height="100%"></canvas>
                                                <script>
                                                    $(document).ready(function() {
                                                        var ctx = $('.lineChart{{$orden->subarea}}');
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
                                                                    data: [{{$ordenes3}}, {{$ordenes2}}, {{$ordenes1}}, {{$ordenes0}}],
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

                            @if(count($ordenes) == 0)
                                <h3 style="text-align: center; padding: 50px;">En los parámetros establecidos no se encuentra información que mostrar</h3>
                            @endif
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Calificación de Gestión</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        @php
                            $ordenesC = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                            ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                            ->join('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                            ->join('problemas','orden_requermientos.problema_id','problemas.id')
                            ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                            ->join('areas','subareas.area_id','areas.idareas')
                            ->join('entidades','areas.entidad_id','entidades.identidad')
                            ->where('entidades.nombre',$category)
                            ->where('calificaciones.tipo','C')
                            ->whereBetween('solicitado', [$datainicio, $datafin]);
                            if($pds_id != "%"){
                                $ordenesC = $ordenesC->where("pds_id",$pds_id);
                            } else {
                                if($ciudad != "sc"){
                                    $ordenesC = $ordenesC->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                }
                                if($provincia != "sp"){
                                    $ordenesC = $ordenesC->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                }
                            }
                            $ordenesC = $ordenesC->get();
                            $calificacionesC = 0;
                            foreach($ordenesC as $orden){
                                $calificacionesC += $orden->calificacion;
                            }
                            $porcentajeC = 0;
                            if(count($ordenesC)>0){
                                switch(ceil($calificacionesC/count($ordenesC))){
                                    case 1:
                                        $porcentajeC = 0;
                                    break;
                                    case 2:
                                        $porcentajeC = 25;
                                    break;
                                    case 3:
                                        $porcentajeC = 50;
                                    break;
                                    case 4:
                                        $porcentajeC = 75;
                                    break;
                                    case 5:
                                        $porcentajeC = 100;
                                    break;
                                }
                            }

                            $ordenesS = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                            ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                            ->join('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                            ->join('problemas','orden_requermientos.problema_id','problemas.id')
                            ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                            ->join('areas','subareas.area_id','areas.idareas')
                            ->join('entidades','areas.entidad_id','entidades.identidad')
                            ->where('entidades.nombre',$category)
                            ->where('calificaciones.tipo','S')
                            ->whereBetween('solicitado', [$datainicio, $datafin]);
                            if($pds_id != "%"){
                                $ordenesS = $ordenesS->where("pds_id",$pds_id);
                            } else {
                                if($ciudad != "sc"){
                                    $ordenesS = $ordenesS->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                }
                                if($provincia != "sp"){
                                    $ordenesS = $ordenesS->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                }
                            }
                            $ordenesS = $ordenesS->get();
                            $calificacionesS = 0;
                            foreach($ordenesS as $orden){
                                $calificacionesS += $orden->calificacion;
                            }
                            $porcentajeS = 0;
                            if(count($ordenesS)>0){
                                switch(ceil($calificacionesS/count($ordenesS))){
                                    case 1:
                                        $porcentajeS = 0;
                                    break;
                                    case 2:
                                        $porcentajeS = 25;
                                    break;
                                    case 3:
                                        $porcentajeS = 50;
                                    break;
                                    case 4:
                                        $porcentajeS = 75;
                                    break;
                                    case 5:
                                        $porcentajeS = 100;
                                    break;
                                }
                            }
                        @endphp
                        <div class="row">
                            <div class="row col-md-6 text-center px-5">
                                <h2 class="text-primary px-3 mt-3 ml-3"><b>Comisionista</b></h2>
                                <div class="calificacionC"></div>
                                <h2 class="text-primary pull-left px-3 mt-3"><b>{{ $porcentajeC }}%</b></h2>
                                <style>
                                    .calificacionC {
                                        width: 80px;
                                        height: 80px;
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        background-image:url("{{url('/img/cara')}}{{ count($ordenesC)>0?ceil($calificacionesC/count($ordenesC)):0 }}.jpg");
                                    }
                                </style>
                            </div>
                            <div class="row col-md-6 text-center px-5">
                                <h2 class="text-primary px-3 mt-3 ml-3"><b>Soporte</b></h2>
                                <div class="calificacionS"></div>
                                <h2 class="text-primary pull-left px-3 mt-3"><b>{{ $porcentajeS }}%</b></h2>
                                <style>
                                    .calificacionS {
                                        width: 80px;
                                        height: 80px;
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        background-image:url("{{url('/img/cara')}}{{ count($ordenesS)>0?ceil($calificacionesS/count($ordenesS)):0 }}.jpg");
                                    }
                                </style>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        @if(request('cat') == "lottogame")
            @php
                $category = 'Lotto Game';
            @endphp
            <div class="row h-100">
                <div class="col-lg-3 mt-0">
                    <span class="titulos text-info bold">Filtrar</span>
                    <div class="card pb-3 m-0">
                        <form action="{{route('indicadores')}}?cat=lottogame" method="post">
                            {{csrf_field()}}
                            <div class="card-body pt-1">
                                <div class="row align-content-center text-center">
                                    <span class=" pr-4 pl-4 w-100"><i class="fa text-center fa-sliders pointer"></i> Seleccionar rango de fecha:</span>
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
                    <h5 class="titulos-grandes text-center">Tiempo</h5>
                    <div class="row">
                        <span class="col pr-4 fechasel titulos w-50 font-weight-bold">Estado</span>
                    </div>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="row mt-2 mb-1">
                                <div class="col-md-6 text-primary">Solicitado - Proceso</div>
                                <div class="col-md-6 text-primary">Proceso - Cerrado</div>
                            </div>
                            <hr class="mb-2">
                            <div class="row mb-1">
                                @php
                                    $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado')
                                    ->join('problemas','orden_requermientos.problema_id','problemas.id')
                                    ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                                    ->join('areas','subareas.area_id','areas.idareas')
                                    ->join('entidades','areas.entidad_id','entidades.identidad')
                                    ->where('entidades.nombre', $category)
                                    ->whereBetween('solicitado', [$datainicio, $datafin]);
                                    if($pds_id != "%"){
                                        $ordenes = $ordenes->where("pds_id",$pds_id);
                                    } else {
                                        if($ciudad != "sc"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                        }
                                        if($provincia != "sp"){
                                            $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                        }
                                    }
                                    $ordenes = $ordenes->get();
                                    $tiempoSP = 0;
                                    $tiempoPF = 0;
                                    foreach($ordenes as $orden){
                                        $tiempoSP += \Carbon\Carbon::parse($orden->solicitado)->diffInMinutes($orden->enproceso);
                                        $tiempoPF += \Carbon\Carbon::parse($orden->enproceso)->diffInMinutes($orden->finalizado);
                                    }
                                    $tSP = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoSP/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                    $tPF = count($ordenes)>0?\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->addMinutes($tiempoPF/count($ordenes)):\Carbon\Carbon::create(2000, 1, 1, 0, 0, 0);
                                @endphp
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tSP->format('H:i')}}</h2></div>
                                <div class="col-md-6 border py-5"><h2 class="my-5 text-primary">{{$tPF->format('H:i')}}</h2></div>
                            </div>
                        </div>
                    </div>

                    @php
                        $ordenes = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                        ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                        ->leftJoin('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                        ->join('problemas','orden_requermientos.problema_id','problemas.id')
                        ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                        ->join('areas','subareas.area_id','areas.idareas')
                        ->join('entidades','areas.entidad_id','entidades.identidad')
                        ->where('entidades.nombre',$category)
                        ->whereBetween('solicitado', [$datainicio, $datafin]);
                        if($pds_id != "%"){
                            $ordenes = $ordenes->where("pds_id",$pds_id);
                        } else {
                            if($ciudad != "sc"){
                                $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                            }
                            if($provincia != "sp"){
                                $ordenes = $ordenes->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                            }
                        }
                        $ordenes = $ordenes->get();
                        $calificaciones = 0;
                        $diasParaResolver = 0;
                        foreach($ordenes as $orden){
                            $calificaciones += $orden->calificacion;

                            $diasParaResolver += $orden->enproceso != null && $orden->finalizado != null ? 
                            \Carbon\Carbon::parse($orden->enproceso)->diffInHours(\Carbon\Carbon::parse($orden->finalizado))
                             : 0;
                        }
                        if(count($ordenes)>0){
                            $promedioDiasParaResolver = ceil($diasParaResolver/count($ordenes));
                        }else{
                            $promedioDiasParaResolver = 0;
                        }
                        $porcentaje = 0;
                        if(count($ordenes)>0){
                            switch(ceil($calificaciones/count($ordenes))){
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
                        }
                    @endphp

                    <h5 class="titulos-grandes text-center">Promedio de tiempo en solucionar</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        <div class="row col-md-4 offset-md-4 text-center p-0">
                            <div class="col p-0 my-auto mx-auto"><h2 class="text-primary"><b>{{ $promedioDiasParaResolver.':00 horas' }}</b></h2></div>
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Resultado de reporteria</h5>
                    <div class="row data-estado mb-2">
                        <div class="col-12 " {{--style="height: 546px!important;overflow: scroll;overflow-x: hidden;"--}}>
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
                                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                                $ordenesS = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                                $ordenesS0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                                $ordenesS1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                                $ordenesS2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                                $ordenesS3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                                                $ordenesF = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$datainicio' AND '$datafin'"));
                                                $ordenesF0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                                $ordenesF1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                                $ordenesF2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                                $ordenesF3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND finalizado != 'null' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));

                        function porcentaje( $a, $b ){
                            if( $a > $b ){
                                return $b / $a * 100;
                            } else if( $b > $a ){
                                return $a / $b * 100;
                            } else {
                                return 0;
                            }
                        }

                                                $ordenesP = $ordenesS != 0 && $ordenesF != 0 ? porcentaje( $ordenesS, $ordenesF ) : 0;
                                                $ordenesP0 = $ordenesS0 != 0 && $ordenesF0 != 0 ? porcentaje( $ordenesS0, $ordenesF0 ) : 0;
                                                $ordenesP1 = $ordenesS1 != 0 && $ordenesF1 != 0 ? porcentaje( $ordenesS1, $ordenesF1 ) : 0;
                                                $ordenesP2 = $ordenesS2 != 0 && $ordenesF2 != 0 ? porcentaje( $ordenesS2, $ordenesF2 ) : 0;
                                                $ordenesP3 = $ordenesS3 != 0 && $ordenesF3 != 0 ? porcentaje( $ordenesS3, $ordenesF3 ) : 0;
                            @endphp


                            <ul class="indicadoresgraf nav lista-estado">

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesS }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartS" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartS');
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
                                                                data: [{{$ordenesS3}}, {{$ordenesS2}}, {{$ordenesS1}}, {{$ordenesS0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">N. de ordenes de requerimiento solucionadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ $ordenesF }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartF" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartF');
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
                                                                data: [{{$ordenesF3}}, {{$ordenesF2}}, {{$ordenesF1}}, {{$ordenesF0}}],
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

                                <li class="nav-item">
                                    <div class="w-100">
                                        <div class=" text-center">
                                            <span class="titulos">Porcentaje de Solucionadas VS Ingresadas</span>
                                            <hr>
                                        </div>
                                        <div class="text-center">
                                            <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round"
                                                   disabled data-fgcolor="#004e92" value="{{ (int) $ordenesP }}">
                                        </div>
                                        <div class="text-center">
                                            <canvas class="lineChartP" height="100%"></canvas>
                                            <script>
                                                $(document).ready(function () {
                                                    var ctx = $('.lineChartP');
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
                                                                data: [{{$ordenesP3}}, {{$ordenesP2}}, {{$ordenesP1}}, {{$ordenesP0}}],
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

                            </ul>

                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center tauditorias" style="display: none;">Auditorias</h5>
                    <div class="data-estado mb-2" style="display: none;">
                        <div class="col-12 py-4" style="background:white;">
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $subareas = \Illuminate\Support\Facades\DB::select("SELECT subareas.nombre as subarea, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY subareas.nombre");
                                $control = 0;
                            @endphp

                            @forelse($subareas as $subarea)
                                <div class="row">
                                    <span class="titulos text-center font-weight-bold col t{{str_replace(' ', '_', $subarea->subarea)}}">{{$subarea->subarea}}</span>
                                </div>
                                <hr>
                                <ul class="indicadoresgraf nav">
                                    @php
                                        $problemas = \Illuminate\Support\Facades\DB::select("SELECT problemas.nombre as problema, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY problemas.nombre");
                                    @endphp
                                    @forelse($problemas as $problema)
                                        @php
                                            $problemas0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                            $problemas1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                            $problemas2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                            $problemas3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));
                                        @endphp
                                        <li class="nav-item">
                                            <div class="w-100">
                                                <div class=" text-center">
                                                    <span class="titulos">{{$problema->problema}}</span>
                                                    <hr>
                                                </div>
                                                <div class="text-center">
                                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{ $problema->problemas }}">
                                                </div>
                                                <div class="text-center">
                                                    <canvas class="lineChart{{$control}}" height="100%"></canvas>
                                                    <script>
                                                        $(document).ready(function() {
                                                            var ctx = $('.lineChart{{$control++}}');
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
                                                                        data: [{{$problemas3}}, {{$problemas2}}, {{$problemas1}}, {{$problemas0}}],
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

                            @if(count($subareas) == 0)
                                <h3 style="text-align: center; padding: 50px;">En los parámetros establecidos no se encuentra información que mostrar</h3>
                            @endif
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center">Calificación de Gestión</h5>
                    <div class="col py-2 mb-4" style="background: white;">
                        @php
                            $ordenesC = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                            ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                            ->join('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                            ->join('problemas','orden_requermientos.problema_id','problemas.id')
                            ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                            ->join('areas','subareas.area_id','areas.idareas')
                            ->join('entidades','areas.entidad_id','entidades.identidad')
                            ->where('entidades.nombre',$category)
                            ->where('calificaciones.tipo','C')
                            ->whereBetween('solicitado', [$datainicio, $datafin]);
                            if($pds_id != "%"){
                                $ordenesC = $ordenesC->where("pds_id",$pds_id);
                            } else {
                                if($ciudad != "sc"){
                                    $ordenesC = $ordenesC->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                }
                                if($provincia != "sp"){
                                    $ordenesC = $ordenesC->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                }
                            }
                            $ordenesC = $ordenesC->get();
                            $calificacionesC = 0;
                            foreach($ordenesC as $orden){
                                $calificacionesC += $orden->calificacion;
                            }
                            $porcentajeC = 0;
                            if(count($ordenesC)>0){
                                switch(ceil($calificacionesC/count($ordenesC))){
                                    case 1:
                                        $porcentajeC = 0;
                                    break;
                                    case 2:
                                        $porcentajeC = 25;
                                    break;
                                    case 3:
                                        $porcentajeC = 50;
                                    break;
                                    case 4:
                                        $porcentajeC = 75;
                                    break;
                                    case 5:
                                        $porcentajeC = 100;
                                    break;
                                }
                            }

                            $ordenesS = (new \App\Orden_Requerimiento())->select('solicitado','enproceso','finalizado','calificacion')
                            ->join('orden_trabajos','orden_requermientos.idorden_requermientos','orden_trabajos.orden_requermiento_id')
                            ->join('calificaciones','orden_trabajos.idorden_trabajos','calificaciones.id_orden_trabajo')
                            ->join('problemas','orden_requermientos.problema_id','problemas.id')
                            ->join('subareas','problemas.subarea_id','subareas.idsubareas')
                            ->join('areas','subareas.area_id','areas.idareas')
                            ->join('entidades','areas.entidad_id','entidades.identidad')
                            ->where('entidades.nombre',$category)
                            ->where('calificaciones.tipo','S')
                            ->whereBetween('solicitado', [$datainicio, $datafin]);
                            if($pds_id != "%"){
                                $ordenesS = $ordenesS->where("pds_id",$pds_id);
                            } else {
                                if($ciudad != "sc"){
                                    $ordenesS = $ordenesS->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_ciudad",$ciudad);
                                }
                                if($provincia != "sp"){
                                    $ordenesS = $ordenesS->join('pdsperfiles','orden_requermientos.pds_id', 'pdsperfiles.id')->where("pds_provincia",$provincia);
                                }
                            }
                            $ordenesS = $ordenesS->get();
                            $calificacionesS = 0;
                            foreach($ordenesS as $orden){
                                $calificacionesS += $orden->calificacion;
                            }
                            $porcentajeS = 0;
                            if(count($ordenesS)>0){
                                switch(ceil($calificacionesS/count($ordenesS))){
                                    case 1:
                                        $porcentajeS = 0;
                                    break;
                                    case 2:
                                        $porcentajeS = 25;
                                    break;
                                    case 3:
                                        $porcentajeS = 50;
                                    break;
                                    case 4:
                                        $porcentajeS = 75;
                                    break;
                                    case 5:
                                        $porcentajeS = 100;
                                    break;
                                }
                            }
                        @endphp
                        <div class="row">
                            <div class="row col-md-6 text-center px-5">
                                <h2 class="text-primary px-3 mt-3 ml-3"><b>Comisionista</b></h2>
                                <div class="calificacionC"></div>
                                <h2 class="text-primary pull-left px-3 mt-3"><b>{{ $porcentajeC }}%</b></h2>
                                <style>
                                    .calificacionC {
                                        width: 80px;
                                        height: 80px;
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        background-image:url("{{url('/img/cara')}}{{ count($ordenesC)>0?ceil($calificacionesC/count($ordenesC)):0 }}.jpg");
                                    }
                                </style>
                            </div>
                            <div class="row col-md-6 text-center px-5">
                                <h2 class="text-primary px-3 mt-3 ml-3"><b>Soporte</b></h2>
                                <div class="calificacionS"></div>
                                <h2 class="text-primary pull-left px-3 mt-3"><b>{{ $porcentajeS }}%</b></h2>
                                <style>
                                    .calificacionS {
                                        width: 80px;
                                        height: 80px;
                                        background-repeat: no-repeat;
                                        background-position: center;
                                        background-image:url("{{url('/img/cara')}}{{ count($ordenesS)>0?ceil($calificacionesS/count($ordenesS)):0 }}.jpg");
                                    }
                                </style>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        @if(request('cat') == "reporteria")
            @php
                $category = 'Lotto Game';
            @endphp
            <div class="row h-100">
                <div class="col-lg-3 mt-0">
                    <span class="titulos text-info bold">Filtrar</span>
                    <div class="card pb-3 m-0">
                        <form action="{{route('indicadores')}}?cat=reporteria" method="post">
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

                    <h5 class="titulos-grandes text-center tauditorias">Número de ordenes de requerimiento</h5>
                    <div class="row">
                        <h4 class="titulos text-center font-weight-bold col tareas">Areas</h4>
                    </div>
                    <div class="mb-2">
                        <div class="col-12 py-4" style="background:white;">
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $areas = \Illuminate\Support\Facades\DB::select("SELECT areas.nombre as area, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY areas.nombre");
                                $control = 0;
                            @endphp

                            <ul class="indicadoresgraf nav">
                                @forelse($areas as $area)
                                    @php
                                        $problemas0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                        $problemas1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                        $problemas2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                        $problemas3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));
                                    @endphp
                                    <li class="nav-item">
                                        <div class="w-100">
                                            <div class=" text-center">
                                                <span class="titulos">{{$area->area}}</span>
                                                <hr>
                                            </div>
                                            <div class="text-center">
                                                <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{ $area->problemas }}">
                                            </div>
                                            <div class="text-center">
                                                <canvas class="lineChart{{$control}}" height="100%"></canvas>
                                                <script>
                                                    $(document).ready(function() {
                                                        var ctx = $('.lineChart{{$control++}}');
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
                                                                    data: [{{$problemas3}}, {{$problemas2}}, {{$problemas1}}, {{$problemas0}}],
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
                            @if(count($areas) == 0)
                                <h3 style="text-align: center; padding: 50px;">En los parámetros establecidos no se encuentra información que mostrar</h3>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <h4 class="titulos text-center font-weight-bold col tareas">SubAreas</h4>
                    </div>
                    <div class="mb-2">
                        <div class="col-12" style="background:white;">
                            <div class="row">
                                @php
                                    $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                    $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                    $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                    $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                    $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                    $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                    $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                    $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                    $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                    $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                    $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                    $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                    $areas = \Illuminate\Support\Facades\DB::select("SELECT areas.nombre as area, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY areas.nombre");
                                    $control = 0;
                                @endphp
                                @forelse($areas as $area)
                                    <h5 class="titulos-grandes text-center tauditorias">{{ $area->area }} - {{ $area->problemas }}</h5>
                                    <ul class="indicadoresgraf nav">
                                        @php
                                            $problemas = \Illuminate\Support\Facades\DB::select("SELECT subareas.nombre as subarea, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY subareas.nombre");
                                        @endphp
                                        @forelse($problemas as $problema)
                                            @php
                                                $problemas0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND subareas.nombre = '$problema->subarea' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                                $problemas1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND subareas.nombre = '$problema->subarea' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                                $problemas2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND subareas.nombre = '$problema->subarea' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                                $problemas3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE areas.nombre = '$area->area' AND subareas.nombre = '$problema->subarea' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));
                                            @endphp
                                            <li class="nav-item">
                                                <div class="w-100">
                                                    <div class=" text-center">
                                                        <span class="titulos">{{$problema->subarea}}</span>
                                                        <hr>
                                                    </div>
                                                    <div class="text-center">
                                                        <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{ $problema->problemas }}">
                                                    </div>
                                                    <div class="text-center">
                                                        <canvas class="lineChartSubareas{{$control}}" height="100%"></canvas>
                                                        <script>
                                                            $(document).ready(function() {
                                                                var ctx = $('.lineChartSubareas{{$control++}}');
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
                                                                            data: [{{$problemas3}}, {{$problemas2}}, {{$problemas1}}, {{$problemas0}}],
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
                            @if(count($areas) == 0)
                                <h3 style="text-align: center; padding: 50px;">En los parámetros establecidos no se encuentra información que mostrar</h3>
                            @endif
                        </div>
                    </div>

                    <h5 class="titulos-grandes text-center tauditorias">Requerimientos por problema (Dispositivo)</h5>
                    <div class="data-estado mb-2">
                        <div class="col-12 py-4" style="background:white;">
                            @php
                                $mes0letra = \Carbon\Carbon::now()->isoFormat('MMM');
                                $mes1letra = \Carbon\Carbon::now()->subMonths(1)->isoFormat('MMM');
                                $mes2letra = \Carbon\Carbon::now()->subMonths(2)->isoFormat('MMM');
                                $mes3letra = \Carbon\Carbon::now()->subMonths(3)->isoFormat('MMM');

                                $mesactualinicio = \Carbon\Carbon::now()->firstOfMonth()->toDateTimeString();
                                $mesactualfin = \Carbon\Carbon::now()->lastOfMonth()->toDateTimeString();
                                $mes1inicio = \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateTimeString();
                                $mes1fin = \Carbon\Carbon::now()->subMonths(1)->lastOfMonth()->toDateTimeString();
                                $mes2inicio = \Carbon\Carbon::now()->subMonths(2)->firstOfMonth()->toDateTimeString();
                                $mes2fin = \Carbon\Carbon::now()->subMonths(2)->lastOfMonth()->toDateTimeString();
                                $mes3inicio = \Carbon\Carbon::now()->subMonths(3)->firstOfMonth()->toDateTimeString();
                                $mes3fin = \Carbon\Carbon::now()->subMonths(3)->lastOfMonth()->toDateTimeString();

                                $subareas = \Illuminate\Support\Facades\DB::select("SELECT subareas.nombre as subarea, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY subareas.nombre");
                                $control = 0;
                            @endphp

                            @forelse($subareas as $subarea)
                                <div class="row">
                                    <span class="titulos text-center font-weight-bold col t{{str_replace(' ', '_', $subarea->subarea)}}">{{$subarea->subarea}}</span>
                                </div>
                                <hr>
                                <ul class="indicadoresgraf nav">
                                    @php
                                        $problemas = \Illuminate\Support\Facades\DB::select("SELECT problemas.nombre as problema, count(*) as problemas FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$datainicio' AND '$datafin' GROUP BY problemas.nombre");
                                    @endphp
                                    @forelse($problemas as $problema)
                                        @php
                                            $problemas0 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mesactualinicio' AND '$mesactualfin'"));
                                            $problemas1 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mes1inicio' AND '$mes1fin'"));
                                            $problemas2 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mes2inicio' AND '$mes2fin'"));
                                            $problemas3 = count(\Illuminate\Support\Facades\DB::select("SELECT * FROM orden_requermientos INNER JOIN problemas ON orden_requermientos.problema_id = problemas.id INNER JOIN subareas ON problemas.subarea_id = subareas.idsubareas INNER JOIN areas ON subareas.area_id = areas.idareas INNER JOIN entidades ON areas.entidad_id = entidades.identidad WHERE entidades.nombre = '$category' AND problemas.nombre = '$problema->problema' AND subareas.nombre = '$subarea->subarea' AND solicitado BETWEEN '$mes3inicio' AND '$mes3fin'"));
                                        @endphp
                                        <li class="nav-item">
                                            <div class="w-100">
                                                <div class=" text-center">
                                                    <span class="titulos">{{$problema->problema}}</span>
                                                    <hr>
                                                </div>
                                                <div class="text-center">
                                                    <input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{ $problema->problemas }}">
                                                </div>
                                                <div class="text-center">
                                                    <canvas class="lineChartDisp{{$control}}" height="100%"></canvas>
                                                    <script>
                                                        $(document).ready(function() {
                                                            var ctx = $('.lineChartDisp{{$control++}}');
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
                                                                        data: [{{$problemas3}}, {{$problemas2}}, {{$problemas1}}, {{$problemas0}}],
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
                            @if(count($subareas) == 0)
                                <h3 style="text-align: center; padding: 50px;">En los parámetros establecidos no se encuentra información que mostrar</h3>
                            @endif
                        </div>
                    </div>

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
        $(document).ready(function () {
            @if(request('cat') == "comisionistas")
            var Ec_ = '<li class="nav-item"><div class="w-100"><div class=" text-center"><span class="titulos">Estado</span><hr></div><div class="text-center"><input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$porcentajeE!=0?number_format($porcentajeE/$totaldatosverticalesE, 2):0}}"></div><div class="text-center"><canvas class="lineChartE" height="100%"></canvas></div></div></li>';
            $('.lista-estado').prepend(Ec_);
            var ctx = $('.lineChartE');
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
                        data: [
                            {{$porcentajeE3!=0?$porcentajeE3/$totaldatosverticalesE:0}},
                            {{$porcentajeE2!=0?$porcentajeE2/$totaldatosverticalesE:0}},
                            {{$porcentajeE1!=0?$porcentajeE1/$totaldatosverticalesE:0}},
                            {{$porcentajeE0!=0?$porcentajeE0/$totaldatosverticalesE:0}}
                        ],
                        backgroundColor: "transparent",
                        borderColor: "#004e92",
                        borderWidth: 2
                    }]
                }
            });

            var Pc_ = '<li class="nav-item"><div class="w-100"><div class=" text-center"><span class="titulos">Proceso</span><hr></div><div class="text-center"><input class="knob" data-width="50%" data-cursor="false" data-angleoffset="0" data-linecap="round" disabled data-fgcolor="#004e92" value="{{$porcentajeP!=0?number_format($porcentajeP/$totaldatosverticalesP, 2):0}}"></div><div class="text-center"><canvas class="lineChartP" height="100%"></canvas></div></div></li>';
            $('.lista-proceso').prepend(Pc_);
            var ctx = $('.lineChartP');
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
                        data: [
                            {{$porcentajeP3!=0?$porcentajeP3/$totaldatosverticalesP:0}},
                            {{$porcentajeP2!=0?$porcentajeP2/$totaldatosverticalesP:0}},
                            {{$porcentajeP1!=0?$porcentajeP1/$totaldatosverticalesP:0}},
                            {{$porcentajeP0!=0?$porcentajeP0/$totaldatosverticalesP:0}}
                        ],
                        backgroundColor: "transparent",
                        borderColor: "#004e92",
                        borderWidth: 2
                    }]
                }
            });
            @endif

            @if(request('cat') == "rp3")
            $('.tauditorias').html('Auditorias {{ $tproblemas }}');
            @endif

            @if(request('cat') == "lottogame")
            @forelse($subareas as $subarea)
            $('.t{{str_replace(' ', '_', $subarea->subarea)}}').html('{{$subarea->subarea}} - {{$subarea->problemas}}');
            @empty
            @endforelse
            @endif

            $(".knob").knob({
                'readOnly': true,
                'rotation': "anticlockwise",
            });
            $('.loadingc').addClass('hidden');

            @if(request('cat') == "auditoria")
            $('.navsubitemindicadores li').click(function () {
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
            @endif

            $('.selglobal').click(function () {
                $('[name="provincia"]').val(0).trigger('change');
                $('[name="ciudad"]').val(0).trigger('change');
                $('[name="pdssel"]').val(0).trigger('change');

                $('[name="provincia"]').removeAttr('disabled');
                $('[name="ciudad"]').removeAttr('disabled');
                $('[name="pdssel"]').removeAttr('disabled');
            });
            $('#pdssel').on('select2:select', function (e) {
                $('#ciudad').val(0).trigger('change');
            });
            $('#ciudad').on('select2:select', function (e) {
                $('#pdssel').val(0).trigger('change');
            });
            $('#provincia').on('select2:select', function (e) {
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

            $('[name="provincia"]').on('select2:select', function (e) {
                $('[name="ciudad"]').attr('disabled', true);
                $('[name="pdssel"]').attr('disabled', true);
            });

            $('[name="ciudad"]').on('select2:select', function (e) {
                $('[name="provincia"]').attr('disabled', true);
                $('[name="pdssel"]').attr('disabled', true);
            });

            $('[name="pdssel"]').on('select2:select', function (e) {
                $('[name="provincia"]').attr('disabled', true);
                $('[name="ciudad"]').attr('disabled', true);
            });
        });
    </script>
@endsection
