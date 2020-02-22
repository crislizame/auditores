<?php

namespace App\Http\Controllers\API;

use App\Auditoria_reporte;
use App\Encaudit;
use App\Encauditdata;
use App\Encauditdataactivo;
use App\Encauditvalue;
use App\Pdsperfile;
use App\Pdsperfiles_attachment;
use App\Pdsperfiles_permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerfilApiController extends Controller
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
        $tipo = $request->post('tipo');
        switch ($tipo){
            case "s":
                $auditor_id = $request->post('auditor_id');
                $pds_id = $request->post('pds_id');
                $agenda_id = $request->post('agenda_id');
                $auditor_tipo = $request->post('tipo_auditor');
                $reportes_count = (new Auditoria_reporte())->where(['pds_id'=>$pds_id,'agenda_id'=>$agenda_id,'auditor_id'=>$auditor_id,'tipo'=>$auditor_tipo])->count();
                $reportes = new Auditoria_reporte();

                if ($reportes_count == 0){
                    $reportes->pds_id = $pds_id;
                    $reportes->agenda_id = $agenda_id;
                    $reportes->auditor_id = $auditor_id;
                    $reportes->tipo = $auditor_tipo;
                    $reportes->pds_editado = "true";
                    $reportes->save();
                }else{
                    $reportes_id = (new Auditoria_reporte())->where(['pds_id'=>$pds_id,'agenda_id'=>$agenda_id,'auditor_id'=>$auditor_id,'tipo'=>$auditor_tipo])->value('idauditoria_reportes');
                    $reportes->exists = true;
                    $reportes->idauditoria_reportes = $reportes_id;
                    $reportes->pds_id = $pds_id;
                    $reportes->agenda_id = $agenda_id;
                    $reportes->auditor_id = $auditor_id;
                    $reportes->tipo = $auditor_tipo;
                    $reportes->pds_editado = "true";
                    $reportes->save();
                }


                $bsenal = $request->post('bsenal');
                $bextintores = $request->post('bextintores');
                $msuelo = $request->post('msuelo');
                $msalud = $request->post('msalud');
                $mpatente = $request->post('mpatente');
                $mtasa = $request->post('mtasa');
                $mpermisoanterior = $request->post('mpermisoanterior');
                $lpermiso = $request->post('lpermiso');
                $lotros = $request->post('lotros');

                $permisos_count = (new Pdsperfiles_permiso())->where('pds_id',$pds_id)->count();
                $permisos = new Pdsperfiles_permiso();
                if ($permisos_count == 0){
                    $permisos->bsenal = $bsenal;
                    $permisos->bextintores = $bextintores;
                    $permisos->msalud = $msalud;
                    $permisos->msuelo = $msuelo;
                    $permisos->mpatente = $mpatente;
                    $permisos->mtasa = $mtasa;
                    $permisos->mpermisoanterior = $mpermisoanterior;
                    $permisos->lpermiso = $lpermiso;
                    $permisos->lotros = $lotros;
                    $permisos->pds_id = $pds_id;
                    $permisos->auditor_id = $auditor_id;
                    $permisos->save();
                }else{
                    $permisos_id = (new Pdsperfiles_permiso())->where('pds_id',$pds_id)->value('idpdsperfiles_permisos');
                    $permisos->exists = true;
                    $permisos->idpdsperfiles_permisos = $permisos_id;
                    $permisos->bsenal = $bsenal;
                    $permisos->bextintores = $bextintores;
                    $permisos->msuelo = $msuelo;
                    $permisos->msalud = $msalud;
                    $permisos->mpatente = $mpatente;
                    $permisos->mtasa = $mtasa;
                    $permisos->mpermisoanterior = $mpermisoanterior;
                    $permisos->lpermiso = $lpermiso;
                    $permisos->lotros = $lotros;
                    $permisos->auditor_id = $auditor_id;
                    $permisos->save();
                }
                $pds_cod = $request->post('pds_cod');
                $pds_sventas = $request->post('pds_sventas');
                $pds_recaudo = $request->post('pds_recaudo');
                $pds_logistic = $request->post('pds_logistic');
                $pds_direccion = $request->post('pds_direccion');
                $pds_mt2 = $request->post('pds_mt2');
                $pds_arrinicio = $request->post('pds_arrinicio');
                $pds_arrfin = $request->post('pds_arrfin');
                $pds_fapertura = $request->post('pds_fapertura');
                $pds_lvapertura = $request->post('pds_lvapertura');
                $pds_lvcierre = $request->post('pds_lvcierre');
                $pds_sapertura = $request->post('pds_sapertura');
                $pds_scierre = $request->post('pds_scierre');
                $pds_dapertura = $request->post('pds_dapertura');
                $pds_dcierre = $request->post('pds_dcierre');

                $pdsperfiles = new Pdsperfile();
                $pdsperfiles->exists = true;
                $pdsperfiles->id = $pds_id;
                $pdsperfiles->pds_cod = $pds_cod;
                $pdsperfiles->pds_sventas = $pds_sventas;
                $pdsperfiles->pds_recaudo = $pds_recaudo;
                $pdsperfiles->pds_logistic = $pds_logistic;
                $pdsperfiles->pds_direccion = $pds_direccion;
                $pdsperfiles->pds_mt2 = $pds_mt2;
                $pdsperfiles->pds_arrinicio = $pds_arrinicio;
                $pdsperfiles->pds_arrfin = $pds_arrfin;
                $pdsperfiles->pds_fapertura = $pds_fapertura;
                $pdsperfiles->pds_lvapertura = $pds_lvapertura;
                $pdsperfiles->pds_lvcierre = $pds_lvcierre;
                $pdsperfiles->pds_sapertura = $pds_sapertura;
                $pdsperfiles->pds_scierre = $pds_scierre;
                $pdsperfiles->pds_dapertura = $pds_dapertura;
                $pdsperfiles->pds_dcierre = $pds_dcierre;
                $pdsperfiles->save();

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
        $pds = (new Pdsperfile())->where('id',$id)->first();
        $aud_attach_id = (new Pdsperfiles_attachment())->where('pds_id',$id)->value('attachments_id');
        $permisos_count = (new Pdsperfiles_permiso())->where('pds_id',$id)->count();
        if($permisos_count == 0){
            //$permisos = (new Pdsperfiles_permiso())->where('pds_id',$id)->first();
            $pds->bsenal="false";
            $pds->bextintores="false";
            $pds->msuelo="false";
            $pds->msalud="false";
            $pds->mpatente="false";
            $pds->mtasa="false";
            $pds->mpermisoanterior="false";
            $pds->lpermiso="false";
            $pds->lotros="false";
        }else{
            $permisos = (new Pdsperfiles_permiso())->where('pds_id',$id)->first();
            $pds->bsenal=$permisos->bsenal;
            $pds->bextintores=$permisos->bextintores;
            $pds->msuelo=$permisos->msuelo;
            $pds->msalud=$permisos->msalud;
            $pds->mpatente=$permisos->mpatente;
            $pds->mtasa=$permisos->mtasa;
            $pds->mpermisoanterior=$permisos->mpermisoanterior;
            $pds->lpermiso=$permisos->lpermiso;
            $pds->lotros=$permisos->lotros;
        }
        $pds->pds_img = $aud_attach_id;
        return response()->json([$pds],200,[], JSON_UNESCAPED_UNICODE);
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
