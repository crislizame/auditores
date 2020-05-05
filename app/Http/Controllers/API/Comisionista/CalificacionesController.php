<?php

namespace App\Http\Controllers\API\Comisionista;

use App\Calificacione;
use App\Orden_Requerimiento;
use App\Orden_trabajo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalificacionesController extends Controller
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
        $id_orden_trabajo = $request->post("id_orden_trabajo");
        $id_user_calificador = $request->post("id_user_calificador");
        $calificacion = $request->post("calificacion");
        (new Orden_Requerimiento())->where("idorden_requermientos",$id_orden_trabajo)->update(["isencuestado"=>1]);

        $calificacionx = new Calificacione();
        $calificacionx->id_user_calificador = $id_user_calificador;
        $calificacionx->tipo = 'C';
        $calificacionx->id_orden_trabajo = (new Orden_trabajo())->where("orden_requermiento_id",$id_orden_trabajo)->idorden_trabajos;
        $calificacionx->calificacion = $calificacion;
        $calificacionx->save();

        $res[] = array(
            "result"=>true
        );

        return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reportes = (new Orden_Requerimiento())->where(["comisionista_id"=>$id,"noti"=>"1"])
            ->count();
        $res[] = array(
            "result"=>$reportes
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
