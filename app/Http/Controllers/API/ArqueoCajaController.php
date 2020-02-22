<?php

namespace App\Http\Controllers\API;

use App\Arqueo_attachment;
use App\Arqueocaja;
use App\Attachment;
use App\Auditore;
use App\Auditoria_reporte;
use App\Comisionistas_attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArqueoCajaController extends Controller
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
        switch ($tipo){
            case "simg":
                $arqueo_id = $request->post('arqueo_id');
                $imagen = base64_decode($request->post('image'));
                $aud_attach_count = (new Arqueo_attachment())->where('arqueo_id',$arqueo_id)->count();
//                if ($aud_attach_count == 0){

                    $attach = new Attachment();
                    $attach->file = $imagen;
                    $attach->user_id = $arqueo_id;
                    $attach->save();
                    $idattach = $attach->idattachments;
                    $aud_attach = new Arqueo_attachment();
                    $aud_attach->arqueo_id = $arqueo_id;
                    $aud_attach->attachments_id = $idattach;
                    $aud_attach->save();
                    $aud_attach_id = $idattach;

//                }else{
//                    $aud_attach_id = (new Arqueo_attachment())->where('arqueo_id',$arqueo_id)->value('attachments_id');
//
//                    $attach = new Attachment();
//                    $attach->exists = true;
//                    $attach->idattachments = $aud_attach_id;
//                    $attach->file = $imagen;
//                    $attach->save();
//
//                }
                break;
            case "s":
                //variables
                $m001 = $request->post('m001');
                $m005 = $request->post('m005');
                $m010 = $request->post('m010');
                $m025 = $request->post('m025');
                $m050 = $request->post('m050');
                $m100 = $request->post('m100');
                $b100 = $request->post('b100');
                $b500 = $request->post('b500');
                $b1000 = $request->post('b1000');
                $b2000 = $request->post('b2000');
                $b5000 = $request->post('b5000');
                $b10000 = $request->post('b10000');
                $observa = $request->post('observa');
                $sumapos = $request->post('sumapos');
                $depositosparciales = $request->post('depositosparciales');
                $agenda_id = $request->post('agenda_id');
                $pds_id = $request->post('pds_id');
                $auditor_id = $request->post('auditor_id');
                $countreporte = (new Auditoria_reporte())->where(['agenda_id'=>$request->post('agenda_id'),
                    'pds_id'=>$request->post('idpds')])->count();
                if($countreporte == 0 ){
                    $reporte = (new Auditoria_reporte());
                    $reporte->pds_id = $request->post('pds_id');
                    $reporte->agenda_id = $request->post('agenda_id');
                    $reporte->auditor_id = $auditor_id;
                    $reporte->tipo = (new Auditore())->where('id',$auditor_id)->value('auditor_tipo');
                    $reporte->save();
                }
                //endvariables
            $count =(new Arqueocaja())->where(['agenda_id'=>$agenda_id,'pds_id'=>$pds_id])->count();
            if ($count == 0) {
                $monedas = new Arqueocaja();
                $monedas->m001 = $m001;
                $monedas->m005 = $m005;
                $monedas->m010 = $m010;
                $monedas->m025 = $m025;
                $monedas->m050 = $m050;
                $monedas->m100 = $m100;
                $monedas->b100 = $b100;
                $monedas->b500 = $b500;
                $monedas->b1000 = $b1000;
                $monedas->b2000 = $b2000;
                $monedas->b5000 = $b5000;
                $monedas->b10000 = $b10000;
                $monedas->observacion = $observa;
                $monedas->sumapos = $sumapos;
                $monedas->pds_id = $pds_id;
                $monedas->depositosparciales = $depositosparciales;
                $monedas->auditor_id = $auditor_id;
                $monedas->agenda_id = $agenda_id;
                $monedas->save();
            }else{
                $id =(new Arqueocaja())->where(['agenda_id'=>$agenda_id,'pds_id'=>$pds_id])->value('idarqueocajas');
                $monedas = new Arqueocaja();
                $monedas->exists = true;
                $monedas->idarqueocajas = $id;
                $monedas->m001 = $m001;
                $monedas->m005 = $m005;
                $monedas->m010 = $m010;
                $monedas->m025 = $m025;
                $monedas->m050 = $m050;
                $monedas->m100 = $m100;
                $monedas->b100 = $b100;
                $monedas->b500 = $b500;
                $monedas->b1000 = $b1000;
                $monedas->b2000 = $b2000;
                $monedas->b5000 = $b5000;
                $monedas->b10000 = $b10000;
                $monedas->observacion = $observa;
                $monedas->depositosparciales = $depositosparciales;
                $monedas->sumapos = $sumapos;
                $monedas->pds_id = $pds_id;
                $monedas->auditor_id = $auditor_id;
                $monedas->agenda_id = $agenda_id;
                $monedas->save();
            }
                return $monedas->idarqueocajas;
                break;
            case "c":
                $agenda_id = $request->post('agenda_id');
                $pds_id = $request->post('pds_id');
                $auditor_id = $request->post('auditor_id');
                $count =(new Arqueocaja())->where(['agenda_id'=>$agenda_id,'pds_id'=>$pds_id,'auditor_id'=>$auditor_id])->count();
                $res = array();

                if ($count > 0){
                    $arq =(new Arqueocaja())->where(['agenda_id'=>$agenda_id,'pds_id'=>$pds_id,'auditor_id'=>$auditor_id])->first();
                    $res[] = $arq;
                }
                return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);


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
        //
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
