<?php

namespace App\Http\Controllers\API;

use App\Agenda;
use App\Auditore;
use App\Encaudit;
use App\Encauditdata;
use App\Encauditdataactivo;
use App\Encauditvalue;
use App\Informes_reporte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContadorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String
     */
    public function store(Request $request)
    {
        $agenda_id = $request->post('agenda_id');
        $pds_id = $request->post('pds_id');
        $auditor_id = $request->post('auditor_id');
        $tipo = (new Auditore())->where('id',$auditor_id)->value('auditor_tipo');
        $estados = (new Encaudit())->where('categoria','estado')->get();
        $count_estados = 0;
        $count_estados_resueltos = 0;
        foreach ($estados as $estado) {
            $count_estado = (new Encauditvalue())->where('encaudit_id',$estado->idencaudit)->count();

            $count_estados = (int)$count_estado + $count_estados;
            $count_estado_f = (new Encauditvalue())->where('encaudit_id',$estado->idencaudit)->get();
            foreach ($count_estado_f as $item) {
                $count_datas = (new Encauditdata())->where(['encauditvalues_id'=>$item->idencauditvalues,
                    'agenda_id'=>$agenda_id,'pds_id'=>$pds_id,'auditor_id'=>$auditor_id])->count();

                $count_estados_resueltos = $count_datas + $count_estados_resueltos;
            }

        }
        $procesos = (new Encaudit())->where('categoria','procesos')->get();
        $count_procesos = 0;
        $count_procesos_resueltos = 0;
        foreach ($procesos as $activo) {
            if ($activo->nombre_estado != "Informes") {
                $count_activo = (new Encauditvalue())->where('encaudit_id', $activo->idencaudit)->count();
                $count_procesos = (int)$count_activo + $count_procesos;
                $count_estado_f = (new Encauditvalue())->where('encaudit_id',$activo->idencaudit)->get();
                foreach ($count_estado_f as $item) {
                    $count_datas = (new Encauditdata())->where(['encauditvalues_id'=>$item->idencauditvalues,
                        'agenda_id'=>$agenda_id,'pds_id'=>$pds_id,'auditor_id'=>$auditor_id])->count();

                    $count_procesos_resueltos = $count_datas + $count_procesos_resueltos;
                }

            }
        }
        $procesos = (new Encaudit())->where('nombre_estado','Informes')->get();
        $count_informes = 0;
        $count_informes_resueltos = 0;
        foreach ($procesos as $activo) {
                $count_activo = (new Encauditvalue())->where('encaudit_id', $activo->idencaudit)->count();

            $count_informes = (int)$count_activo + $count_informes;
            $count_estado_f = (new Encauditvalue())->where('encaudit_id',$activo->idencaudit)->get();
            foreach ($count_estado_f as $item) {
                $count_datas = (new Informes_reporte())->where(['informes_id'=>$item->idencauditvalues,
                    'agenda_id' => $agenda_id, 'pds_id' => $pds_id, 'auditor_id' => $auditor_id])->count();

                $count_informes_resueltos = $count_datas + $count_informes_resueltos;
            }


        }
        $activos = (new Encaudit())->where('categoria','activos')->get();
        $count_activos = 0;
        $count_activos_resueltos = 0;
        foreach ($activos as $activo) {
                $count_activo = (new Encauditvalue())->where('encaudit_id', $activo->idencaudit)->count();
                $count_activos = (int)$count_activo + $count_activos;
            $count_estado_f = (new Encauditvalue())->where('encaudit_id',$activo->idencaudit)->get();

            foreach ($count_estado_f as $item) {
                $count_datas = (new Encauditdataactivo())->where(['encauditvalues_id'=>$item->idencauditvalues,
                    'agenda_id' => $agenda_id, 'pds_id' => $pds_id, 'auditor_id' => $auditor_id])->count();

                $count_activos_resueltos = $count_datas + $count_activos_resueltos;
            }


        }

        $dif_estado = (int)$count_estados - (int)$count_estados_resueltos;
        $dif_proceso = (int)$count_procesos - (int)$count_procesos_resueltos;
        $dif_activo = (int)$count_activos - (int)$count_activos_resueltos;
        $dif_informe = (int)$count_informes - (int)$count_informes_resueltos;
//        echo $count_activos." - ".$count_activos_resueltos;
        if($tipo == "N"){
            $sumatotal = $dif_estado+$dif_activo;

        }else{
            $sumatotal = $dif_proceso+$dif_informe;

        }
        //echo $count_estados_resueltos;
        if($sumatotal <= 0){
            return "1";
        }else{
            if($tipo == "N"){
                $mensaje = "No puede salir hasta completar totalmente la encuesta, Falta Estado: ".$dif_estado." Activos: ".$dif_activo;

            }else{
                $mensaje = "No puede salir hasta completar totalmente la encuesta, Falta Proceso: ".$dif_proceso." Informes: ".$dif_informe;

            }
            return response()->json($mensaje,200,[], JSON_UNESCAPED_UNICODE);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return String
     */
    public function show($id)
    {
        $hoycarbon = (new Carbon())::now();
        $fechahoy = $hoycarbon->year."-".$hoycarbon->month."-".$hoycarbon->day." "."00:00:00";
        $hoy = (new Carbon())::parse($fechahoy);
        $fecha= (new Agenda())->where('id',$id)->value('agenda_date');
        $fechaagenda = (new Carbon())::parse($fecha);
        $diferencia = $hoy->diffInDays($fechaagenda,false);
        if ($diferencia > 0){
            return "0";
        }
        return "1";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
