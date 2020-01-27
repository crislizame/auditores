<?php

namespace App\Http\Controllers\API;

use App\Auditore;
use App\Auditoria_reporte;
use App\Encaudit;
use App\Encauditdata;
use App\Encauditdataactivo;
use App\Encauditvalue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivosApiController extends Controller
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
        $tipo = $request->post('tipo');
        $auditor_id = $request->post('auditor_id');
        switch ($tipo){
            case "c1":
                $id = $request->post('id');
                $agenda_id = $request->post('agenda_id');
                $idpds = $request->post('idpds');
                $codigo = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$id,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->first();
                return response()->json([$codigo],200,[], JSON_UNESCAPED_UNICODE);

                break;
            case "c":
                $id = $request->post('id');
                $agenda_id = $request->post('agenda_id');
                $idpds = $request->post('idpds');
                $datosverticales = (new Encaudit())->where('categoria',$id)->get();
                $res = array();
                foreach ($datosverticales as $datosverticale) {
                    $thc = (new Encauditvalue())->where('encaudit_id',$datosverticale->idencaudit)->get();
                    $res[] = array('nombre' => $datosverticale->nombre_estado,
                        'categoria' => $datosverticale->categoria,
                        'id'=>$datosverticale->idencaudit,'codigo'=>"",
                            'cantidad'=>"",
                            'modelo'=>"",
                            'color'=>"",
                            'propiedad'=>"0",
                            'marca'=>"");
                    foreach ($thc as $th) {
                        $codigo = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('codigo');
                        $cantidad = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('cantidad');
                        $marca = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('marca');
                        $modelo = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('modelo');
                        $color = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('color');
                        $propiedad = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('propiedad');
                        $observa = (new Encauditdataactivo())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('observa');
                        $res[] = array('nombre' => $th->nombre_val,
                            'id' => $th->idencauditvalues,
                            'categoria'=>'0s','codigo'=>$codigo==null?"":$codigo,
                            'cantidad'=>$cantidad==null?"":$cantidad,
                            'modelo'=>$modelo==null?"":$modelo,
                            'color'=>$color==null?"":$color,
                            'observa'=>$observa==null?"":$observa,
                            'propiedad'=>$propiedad==null?"0":$propiedad,
                            'marca'=>$marca==null?"":$marca
                        );
                    }

                }
                return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
                break;
            case "s":
                $countForm = (new Encauditdataactivo())->where(['agenda_id'=>$request->post('agenda_id'),
                    'encauditvalues_id'=> $request->post('id'),
                    'pds_id'=>$request->post('idpds'),'auditor_id'=>$auditor_id])->count();
                $countreporte = (new Auditoria_reporte())->where(['agenda_id'=>$request->post('agenda_id'),
                    'pds_id'=>$request->post('idpds'),'auditor_id'=>$auditor_id])->count();
                if($countreporte == 0 ){
                    $reporte = (new Auditoria_reporte());
                    $reporte->pds_id = $request->post('idpds');
                    $reporte->agenda_id = $request->post('agenda_id');
                    $reporte->auditor_id = $auditor_id;
                    $reporte->tipo = (new Auditore())->where('id',$auditor_id)->value('auditor_tipo');
                    $reporte->save();
                }
                if ($countForm == 1){
                    $idform = (new Encauditdataactivo())->where(['agenda_id'=>$request->post('agenda_id'),
                        'encauditvalues_id'=> $request->post('id'),
                        'pds_id'=>$request->post('idpds'),'auditor_id'=>$auditor_id])->value('idencauditdataprocesos');
                    $saveForm = (new Encauditdataactivo());
                    $saveForm->exists = true;
                    $saveForm->idencauditdataprocesos =$idform;
                    $saveForm->codigo = $request->post('codigo');
                    $saveForm->cantidad = $request->post('cantidad');
                    $saveForm->marca = $request->post('marca');
                    $saveForm->modelo = $request->post('modelo');
                    $saveForm->color = $request->post('color');
                    $saveForm->propiedad = $request->post('propiedad');
                    $saveForm->observa = $request->post('observa');
                    $saveForm->auditor_id = $auditor_id;
                    $idx = $saveForm->save();
                }else if($countForm == 0){
                    $saveForm = (new Encauditdataactivo());
                    $saveForm->encauditvalues_id = $request->post('id');
                    $saveForm->agenda_id = $request->post('agenda_id');
                    $saveForm->pds_id = $request->post('idpds');
                    $saveForm->codigo = $request->post('codigo');
                    $saveForm->cantidad = $request->post('cantidad');
                    $saveForm->marca = $request->post('marca');
                    $saveForm->modelo = $request->post('modelo');
                    $saveForm->color = $request->post('color');
                    $saveForm->propiedad = $request->post('propiedad');
                    $saveForm->observa = $request->post('observa');
                    $saveForm->auditor_id = $auditor_id;
                    $idx = $saveForm->save();
                }


                return response()->json($idx,200,[], JSON_UNESCAPED_UNICODE);

                break;
        }
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
