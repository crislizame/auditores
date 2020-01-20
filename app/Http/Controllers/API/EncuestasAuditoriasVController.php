<?php

namespace App\Http\Controllers\API;

use App\Auditore;
use App\Auditoria_reporte;
use App\Encaudit;
use App\Encauditdata;
use App\Encauditvalue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EncuestasAuditoriasVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosverticales = (new Encaudit())->get();
        $res = array();
        foreach ($datosverticales as $datosverticale) {
            $thc = (new Encauditvalue())->where('encaudit_id',$datosverticale->idencaudit)->get();
            $res[] = array('nombre' => $datosverticale->nombre_estado,
                'categoria' => $datosverticale->categoria,
                'id'=>$datosverticale->idencaudit);
            foreach ($thc as $th) {
                $res[] = array('nombre' => $th->nombre_val,
                    'id' => $th->idencauditvalues);
            }

        }
        return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
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
                        'id'=>$datosverticale->idencaudit,'carita'=>0,'observa'=>'','idencauditdata'=>"");
                    foreach ($thc as $th) {
                        $carita = (new Encauditdata())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('carita');
                       // $image = (new Encauditdata())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds])->value('image');
                        $observa = (new Encauditdata())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('observa');
                        $idencauditdatas = (new Encauditdata())->where(['agenda_id'=>$agenda_id,'encauditvalues_id'=>$th->idencauditvalues,'pds_id'=>$idpds,'auditor_id'=>$auditor_id])->value('idencauditdatas');
                        $res[] = array('nombre' => $th->nombre_val,
                            'id' => $th->idencauditvalues,
                            'categoria'=>'0s','carita'=>$carita==null?0:$carita,'observa'=>$observa==null?"":$observa,'idencauditdata'=>$idencauditdatas);
                    }

                }
                return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
                break;
            case "s":
                $countreporte = (new Auditoria_reporte())->where(['agenda_id'=>$request->post('agenda_id'),
                    'pds_id'=>$request->post('idpds')])->count();
                if($countreporte == 0 ){
                    $reporte = (new Auditoria_reporte());
                    $reporte->pds_id = $request->post('idpds');
                    $reporte->agenda_id = $request->post('agenda_id');
                    $reporte->auditor_id = $auditor_id;
                    $reporte->tipo = (new Auditore())->where('id',$auditor_id)->value('auditor_tipo');
                    $reporte->save();
                }
                $countForm = (new Encauditdata())->where(['agenda_id'=>$request->post('agenda_id'),
                    'encauditvalues_id'=> $request->post('id'),
                    'pds_id'=>$request->post('idpds'),'auditor_id'=>$auditor_id])->count();
                if ($countForm == 1){
                    $idform = (new Encauditdata())->where(['agenda_id'=>$request->post('agenda_id'),
                        'encauditvalues_id'=> $request->post('id'),
                        'pds_id'=>$request->post('idpds'),'auditor_id'=>$auditor_id])->value('idencauditdatas');
                    $saveForm = (new Encauditdata());
                    $saveForm->exists = true;
                    $saveForm->idencauditdatas =$idform;
                    $saveForm->carita = $request->post('carita');
                    //$saveForm->image = base64_decode($request->post('imagen'));
                    $saveForm->observa = $request->post('observa');
                    $saveForm->auditor_id =$auditor_id;
                     $saveForm->save();
                     $idx =$idform;
                }else if($countForm == 0){
                    $saveForm = (new Encauditdata());
                    $saveForm->encauditvalues_id = $request->post('id');
                    $saveForm->agenda_id = $request->post('agenda_id');
                    $saveForm->pds_id = $request->post('idpds');
                    $saveForm->carita = $request->post('carita');
                    //  $saveForm->image = base64_decode($request->post('imagen'));
                    $saveForm->observa = $request->post('observa');
                    $saveForm->auditor_id =$auditor_id;

                    $saveForm->save();
                    $idx = $saveForm->idencauditdatas;
                }


                return $idx;
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
