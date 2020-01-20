<?php

namespace App\Http\Controllers\API;

use App\Informes_reporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformesApiController extends Controller
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
     * @return String
     */
    public function store(Request $request)
    {
        $tipo = $request->post("tipo");
        switch ($tipo){
            case "s":
                $auditor_id = $request->post("auditor_id");
                $pds_id = $request->post("pds_id");
                $agenda_id = $request->post("agenda_id");
                $informe_id = $request->post("informe_id");
                $informes_count = (new Informes_reporte())->where(['auditor_id'=>$auditor_id,'pds_id'=>$pds_id,'agenda_id'=>$agenda_id,'informes_id'=>$informe_id])->count();
                if($informes_count == 0){
                   $informes = new Informes_reporte();
                   $informes->informes_id = $informe_id;
                   $informes->agenda_id = $agenda_id;
                   $informes->auditor_id = $auditor_id;
                   $informes->pds_id = $pds_id;
                   $informes->value = $request->post('value');
                   $informes->observa = $request->post('observa');
                   $informes->save();
                }else{
                    $informes_idx = (new Informes_reporte())->where(['auditor_id'=>$auditor_id,'pds_id'=>$pds_id,'agenda_id'=>$agenda_id,'informes_id'=>$informe_id])->value("idinformes_reportes");

                    $informes = new Informes_reporte();
                    $informes->exists = true;
                    $informes->idinformes_reportes = $informes_idx;
                    $informes->informes_id = $informe_id;
                    $informes->agenda_id = $agenda_id;
                    $informes->auditor_id = $auditor_id;
                    $informes->pds_id = $pds_id;
                    $informes->value = $request->post('value');
                    $informes->observa = $request->post('observa');

                    $informes->save();
                }
                break;
            case "c":
                $auditor_id = $request->post("auditor_id");
                $pds_id = $request->post("pds_id");
                $agenda_id = $request->post("agenda_id");
                $informe_id = $request->post("informe_id");
                $informes_count = (new Informes_reporte())->where(['auditor_id'=>$auditor_id,'pds_id'=>$pds_id,'agenda_id'=>$agenda_id,'informe_id'=>$informe_id])->count();
                if($informes_count == 0){
                    return response()->json([]);

                }else{

                    $informes = (new Informes_reporte())->where(['auditor_id'=>$auditor_id,'pds_id'=>$pds_id,'agenda_id'=>$agenda_id,'informe_id'=>$informe_id])->first();

                    return response()->json([$informes]);

                }
                break;
        }
        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
