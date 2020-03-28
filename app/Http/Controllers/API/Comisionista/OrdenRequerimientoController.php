<?php

namespace App\Http\Controllers\API\Comisionista;

use App\Area;
use App\Attachment;
use App\Comisionista;
use App\Orden_Requerimiento;
use App\Orden_trabajo;
use App\Oreque_attachment;
use App\Problema;
use App\Subarea;
use Carbon\Carbon;
use Composer\DependencyResolver\Problem;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdenRequerimientoController extends Controller
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
        $tipo = $request->post("tipo");
        switch ($tipo){
            case "s":
                $ndispositivo = $request->post("ndispositivo");
                $descripcion = $request->post("descripcion");
                $com_id = $request->post("com_id");
                $problema = $request->post("problema");

                $comall = (new Comisionista())->where("id",$com_id)->first();
                $pds_id = $comall->pds_id;

                $oreq = new Orden_Requerimiento();
                $oreq->pds_id = $pds_id;
                $oreq->comisionista_id = $com_id;
                $oreq->problema_id = $problema;
                $oreq->dispositivo = $ndispositivo;
                $oreq->comentario = $descripcion;
                $oreq->save();
                $res = array(
                    "result"=>$oreq->idorden_requermientos
                );
                return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);


                break;
            case "img":
                $image = $request->post("image");
                $com_id = $request->post("com_id");
                $oreq_id = $request->post("oreq_id");

                $comall = (new Comisionista())->where("id",$com_id)->first();
                $pds_id = $comall->pds_id;
                $attach = new Attachment();
                $attach->file = base64_decode($image);
                $attach->save();

                $oreqx = new Oreque_attachment();
                $oreqx->attachment_id = $attach->idattachments;
                $oreqx->orden_requermiento_id = $oreq_id;
                $oreqx->save();


                $res = array(
                    "result"=>$attach->idattachments
                );
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
        $reportes = (new Orden_Requerimiento())->where("comisionista_id",$id)
            ->orderBy("idorden_requermientos","desc")
            ->get();
        $res = array(
            "reportes"=>array(),

        );
        foreach ($reportes as $reporte) {
//            $orden_count = (new Orden_trabajo())->where("orden_requermiento_id",$reporte->id)->count();
            $orden = (new Orden_trabajo())->where("orden_requermiento_id",$reporte->idorden_requermientos)->first();
            $problema = (new Problema())->where("id",$reporte->problema_id)->first();
            $subarea = (new Subarea())->where("idsubareas",$problema->subarea_id)->first();
            $reporte->area = (new Area())->where("idareas",$subarea->area_id)->value("nombre");
            $reporte->subarea = $subarea->nombre;
            $reporte->fecha = Carbon::parse($reporte->solicitado)->toDateString();
            $reporte->nreporte = "C ".str_pad($reporte->idorden_requermientos, 7, "0", STR_PAD_LEFT);
                $res["reportes"][]=array(
                    "reporte"=>$reporte,
                    "orden"=>$orden
                );


        }


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
