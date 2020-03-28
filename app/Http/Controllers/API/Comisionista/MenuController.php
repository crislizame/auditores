<?php

namespace App\Http\Controllers\API\Comisionista;

use App\Area;
use App\Entidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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
        $res = array();
        switch ($tipo){
            case "subarea":
                $subareas =DB::table("subareas")->where("area_id",$request->post("sub_id"))->get();
                $res["data"]=$subareas;


                break;
            case "problema":
                $problemas =DB::table("problemas")->where("subarea_id",$request->post("sub_id"))->get();
                $res["data"]=$problemas;


                break;
        }
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
        $tipo = $id;
        $res = array();
        switch ($tipo){
            case "areas":
                $areas = (new Area())->get();
                foreach ($areas as $area) {
                    $res[] = array(
                        "area"=>$area,
                        "entidad"=>(new Entidade())->where("identidad",$area->entidad_id)->get()
                    );
                }

                break;
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
