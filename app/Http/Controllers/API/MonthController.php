<?php

namespace App\Http\Controllers\API;

use App\Agenda;
use App\AgendaAuditore;
use App\AgendaPd;
use App\PdsAuditore;
use App\Pdsperfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonthController extends Controller
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
        $date = $request->post('date');
        $tipo = $request->post('tipo');
        $res = array();
        switch ($tipo){
            case 'getAgendas':
                $idauditor = $request->post('idauditor');
                $dateult = Carbon::parse($date)->format("Y-m");

                $agendasAll = (new PdsAuditore())->where(['auditor_id'=>$idauditor])->get();

                foreach ($agendasAll as $item) {
                    unset($item->updated_at);
                    unset($item->created_at);
                    unset($item->deleted_at);
                    $busquedas = (new Agenda())->where('id',$item->agenda_id)->where('agenda_date','LIKE',$dateult."%")->get();

                    foreach ($busquedas as $busqueda) {

                        $fecha = Carbon::parse($busqueda->agenda_date)->day;
                        $item->dia = $fecha;
                        $res[] = $item;
                    }
                }

                break;
            case 'getPdsAgenda':

                    $idagenda = $request->post('idagenda');
                $idauditor = $request->post('idauditor');

                $agendasAll = (new PdsAuditore())->where(['auditor_id'=>$idauditor,'agenda_id'=>$idagenda])->get();

                foreach ($agendasAll as $item) {
                    $busquedas = (new Agenda())->where('agendas.id',$item->agenda_id)->get();

                    foreach ($busquedas as $busqueda) {
                            $pds_name  = (new Pdsperfile())->where('id',$item->pds_id)->value('pds_name');
                            $res[]= array('pds_name'=>$pds_name,'id'=>$item->pds_id,'agenda_id'=>$busqueda->id,'sql'=>$idauditor);




                    }



                }
                break;
                case 'getHoyPdsAgenda':
                    $idauditor = $request->post('idauditor');

                    $hoy = Carbon::now()->toDateString();
                    $agendasAll = (new PdsAuditore())->where(['auditor_id'=>$idauditor])->get();

                foreach ($agendasAll as $item) {
                    $busquedas = (new Agenda())->where('agenda_date','LIKE',$hoy)->where('agendas.id',$item->agenda_id)->get();

                    foreach ($busquedas as $busqueda) {
                        $pds_id  = (new AgendaPd())->where('agenda_id',$busqueda->id)->value('pds_id');
                        $pds  = (new AgendaPd())->where('agenda_id',$busqueda->id)->get();
                            $pds_name  = (new Pdsperfile())->where('id',$item->pds_id)->value('pds_name');
                            $res[]= array('pds_name'=>$pds_name,'id'=>$item->pds_id,'agenda_id'=>$busqueda->id,'sql'=>$idauditor);

                    }



                }
                break;

        }
        $ress[] = $res;
        return response()->json($res);

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
