<?php

namespace App\Http\Controllers\API;

use App\Agenda;
use App\AgendaAuditore;
use App\AgendaPd;
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
                $agendasAll = (new Agenda())->where('agenda_date','LIKE',$dateult.'%')->join('agenda_auditores','agenda_auditores.agenda_id','=','agendas.id')
                    ->where('agenda_auditores.auditor_id',$idauditor)
                    ->get();
                foreach ($agendasAll as $item) {
                    unset($item->updated_at);
                    unset($item->created_at);
                    unset($item->deleted_at);
                    $fecha = Carbon::parse($item->agenda_date)->day;
                    $item->dia = $fecha;
                    $res[]= $item;
                }

                break;
            case 'getPdsAgenda':

                    $idagenda = $request->post('idagenda');
                $agendasAll = (new AgendaPd())->where('agenda_id','=',$idagenda)
                    ->get();
                foreach ($agendasAll as $item) {
                    $pds  = (new Pdsperfile())->where('id',$item->pds_id)->get();
                    foreach ($pds as $pd) {
                        unset($item->updated_at);
                        unset($item->created_at);
                        unset($item->deleted_at);

                        $res[]= array('pds_name'=>$pd->pds_name,'id'=>$pd->id,'agenda_id'=>$idagenda);
                    }

                }
                break;
                case 'getHoyPdsAgenda':
                    $idauditor = $request->post('idauditor');

                    $hoy = Carbon::now()->toDateString();
                    $agendasAll = (new Agenda())->where('agenda_date','LIKE',$hoy.'%')->join('agenda_pds','agenda_pds.agenda_id','=','agendas.id')
                        ->join('agenda_auditores','agenda_auditores.agenda_id','=','agendas.id')
                        ->where(['agenda_auditores.auditor_id'=>$idauditor])
                        ->get();
                foreach ($agendasAll as $item) {
                    $pds  = (new Pdsperfile())->where('id',$item->pds_id)->get();
                    foreach ($pds as $pd) {
                        unset($item->updated_at);
                        unset($item->created_at);
                        unset($item->deleted_at);

                        $res[]= array('pds_name'=>$pd->pds_name,'id'=>$pd->id,'agenda_id'=>$item->agenda_id);
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
