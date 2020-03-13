<?php

namespace App\Http\Controllers\API;

use App\Comisionistas_reporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComisionistaReporte extends Controller
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
        $pds_id = $request->post('pds_id');
        $auditor_id = $request->post('auditor_id');
        $agenda_id = $request->post('agenda_id');
        $com_id = $request->post('com_id');
        $presente = $request->post('presente');
        $comc = (new Comisionistas_reporte())->where(['comisionista_id'=>$com_id,'agenda_id'=>$agenda_id,'pds_id'=>$pds_id,'auditor_id'=>$auditor_id])->count();

        $comreportes = new Comisionistas_reporte();
        if($comc == 0){
            $comreportes->presente = $presente;
            $comreportes->agenda_id = $agenda_id;
            $comreportes->auditor_id = $auditor_id;
            $comreportes->pds_id = $pds_id;

            $comreportes->comisionista_id = $com_id;
            $comreportes->save();
        }else{
            $comc_id = (new Comisionistas_reporte())->where(['comisionista_id'=>$com_id,'agenda_id'=>$agenda_id,'pds_id'=>$pds_id,'auditor_id'=>$auditor_id])->value('id');

            $comreportes->exists = true;
            $comreportes->id = $comc_id;
            $comreportes->presente = $presente;
            $comreportes->agenda_id = $agenda_id;
            $comreportes->pds_id = $pds_id;
            $comreportes->auditor_id = $auditor_id;
            $comreportes->comisionista_id = $com_id;
            $comreportes->save();
        }
        return response()->json("as",200,[], JSON_UNESCAPED_UNICODE);
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
