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
</style>
@endsection
@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <!-- Start Row principal -->
        @php
        $activar = array("activar"=>array("","","active"));
        @endphp
        @include("vistas.submenu.agenda.submenu",$activar)
        <div class="col-lg-10 mt-3">
            <div class="card m-0">
                <div class="card-body pb-3 pt-3">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav lmhreporte mb-4">
                                <a href="{{route('agenda/reportes')}}?cat=todos">
                                    <li class="nav-item @if(request('cat') == "todos") active @endif">Todos</li>
                                </a>
                                <a href="{{route('agenda/reportes')}}?cat=estados">
                                    <li href="#" class="nav-item @if(request('cat') == "estados") active @endif">Estados</li>
                                </a>
                                <a href="{{route('agenda/reportes')}}?cat=procesos">
                                    <li class="nav-item @if(request('cat') == "procesos") active @endif">Procesos</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <table class="table table-bordered tabla-reportes ">
                        <thead>
                            <tr>
                                <th>Número de Reporte</th>
                                <th>Fecha</th>
                                {{-- <th>Auditor</th>--}}
                                <th>PDS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            switch (request('cat')) {
                            case "todos":
                            $auditreport = (new \App\Auditoria_reporte())->orderBy('idauditoria_reportes','desc')->get();
                            break;
                            case "estados":
                            $auditreport = (new \App\Auditoria_reporte())->where('tipo','N')->orderBy('idauditoria_reportes','desc')->get();
                            break;
                            case "procesos":
                            $auditreport = (new \App\Auditoria_reporte())->where('tipo','P')->orderBy('idauditoria_reportes','desc')->get();
                            break;
                            }
                            @endphp
                            @forelse($auditreport as $aure)
                            <tr>
                                <td><a href="{{route("agenda/reportes-item")}}?cat=auditoria&id={{$aure->idauditoria_reportes}}">#{{$aure->tipo.'-'.str_pad($aure->idauditoria_reportes, 7, "0", STR_PAD_LEFT)}}</a></td>
                                <td>{{(new \App\Agenda())->where(['id'=>$aure->agenda_id])->value("agenda_date")}}</td>
                                {{-- <td>--}}
                                {{-- @php--}}
                                {{-- $agendaaudits = (new \App\AgendaAuditore())->where(['agenda_id'=>$aure->agenda_id])->get();--}}
                                {{-- @endphp--}}
                                {{-- @forelse($agendaaudits as $audit)--}}
                                {{-- {{(new \App\Auditore())->where('id',$audit->auditor_id)->value("aud_nombre")}} /--}}
                                {{-- @empty--}}
                                {{-- @endforelse--}}
                                {{-- </td>--}}
                                <td>{{(new \App\Pdsperfile())->where(['id'=>$aure->pds_id])->value("pds_name")}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
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
@endsection