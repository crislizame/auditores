<?php

namespace App\Http\Controllers\API\Comisionista;

use App\Area;
use App\Calificacione;
use App\Orden_Requerimiento;
use App\Orden_trabajo;
use App\Problema;
use App\Subarea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reporte = (new Orden_Requerimiento())->where("idorden_requermientos",$id)
            ->first();
        (new Orden_Requerimiento())->where("idorden_requermientos",$id)->update(["noti"=>0]);
        $res = array(

        );
        $orden = (new Orden_trabajo())->where("orden_requermiento_id",$reporte->idorden_requermientos)->first();
        $calificacion = (new Calificacione())->where("id_orden_trabajo",$reporte->idorden_requermientos)->first();
        $problema = (new Problema())->where("id",$reporte->problema_id)->first();
        $subarea = (new Subarea())->where("idsubareas",$problema->subarea_id)->first();
        $reporte->area = (new Area())->where("idareas",$subarea->area_id)->value("nombre");
        $reporte->subarea = $subarea->nombre;
        $reporte->problema = $problema->nombre;
        $reporte->fecha = Carbon::parse($reporte->solicitado)->toDateString();
        $reporte->nreporte = "C ".str_pad($reporte->idorden_requermientos, 7, "0", STR_PAD_LEFT);
        $res[] = array(
            "reporte"=>$reporte,
            "orden"=>$orden,
            "calificacion"=>$calificacion
        );

        return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
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
