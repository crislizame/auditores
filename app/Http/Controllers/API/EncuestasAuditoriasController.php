<?php

namespace App\Http\Controllers\API;

use App\Encauditvalue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EncuestasAuditoriasController extends Controller
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
            case 's':
                $dt = new Encauditvalue();
                $dt->exists = true;
                $dt->idencauditvalues = $request->post('idli');
                $dt->encaudit_id = $request->post('id');
                $dt->nombre_val = $request->post('name');
                $dt->save();
                break;
            case 'n':
                $dt = new Encauditvalue();
                $dt->encaudit_id = $request->post('id');
                $dt->nombre_val = $request->post('name');
                $dt->save();
                break;
            case 'd':
                $dt = (new Encauditvalue())->where('idencauditvalues',$request->post('idli'))->delete();

                break;
        }
        return md5(1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datosverticales = (new Encauditvalue())->where('encaudit_id',$id)->get();
        $res = array();
        foreach ($datosverticales as $datosverticale) {
            $res[] = array('nombre' => $datosverticale->nombre_val,
                'id' => $datosverticale->idencauditvalues);
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
