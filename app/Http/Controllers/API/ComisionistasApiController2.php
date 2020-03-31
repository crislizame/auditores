<?php

namespace App\Http\Controllers\API;

use App\Attachment;
use App\Auditores_attachment;
use App\Comisionista;
use App\Comisionistas_attachment;
use App\Pdsperfiles_attachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Scalar\String_;

class ComisionistasApiController2 extends Controller
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
        $com_id = $request->post('com_id');

        switch ($tipo){
            case 's':
                $nombres = $request->post('nombres');
                $apellidos = $request->post('apellidos');
                $celular = $request->post('celular');
                $telef_domicilio = $request->post('telef_domicilio');
                $direccion = $request->post('direccion');
                $h_ingreso = Carbon::parse($request->post('h_ingreso'))->format("H:i");
                $h_salida = Carbon::parse($request->post('h_salida'))->format("H:i");
                $hfds_ingreso = Carbon::parse($request->post('hfds_ingreso'))->format("H:i");
                $hfds_salida = Carbon::parse($request->post('hfds_salida'))->format("H:i");
                $rs_ventas = $request->post('rs_ventas');
                $rs_cartera = $request->post('rs_cartera');
                $email = $request->post('email');
                $estudios = $request->post('estudios');
                $fecha_apertura = $request->post('fecha_apertura');
                $cedula = $request->post('cedula');
                $edad = $request->post('edad');
                $tipo_comisionista = $request->post('tipo_comisionista');
                $comisionista = new Comisionista();
                $comisionista->exists = true;
                $comisionista->id = $com_id;
                $comisionista->nombres = $nombres;
                $comisionista->apellidos = $apellidos;
                $comisionista->celular = $celular;
                $comisionista->telef_domicilio = $telef_domicilio;
                $comisionista->direccion = $direccion;
                $comisionista->h_ingreso = $h_ingreso;
                $comisionista->h_salida = $h_salida;
                $comisionista->hfds_ingreso = $hfds_ingreso;
                $comisionista->hfds_salida = $hfds_salida;
                $comisionista->rs_ventas = $rs_ventas;
                $comisionista->rs_cartera = $rs_cartera;
                $comisionista->cedula = $cedula;
                $comisionista->email = $email;
                $comisionista->edad = $edad;
                $comisionista->estudios = $estudios;
                $comisionista->fecha_apertura = $fecha_apertura;
                $comisionista->tipo_comisionista = $tipo_comisionista;
                $comisionista->save();
                break;
            case 'simg':
                $imagen = base64_decode($request->post('image'));

                $aud_attach_count = (new Comisionistas_attachment())->where('comisionista_id',$com_id)->count();


                if ($aud_attach_count == 0){
                    $attach = new Attachment();
                    $attach->file = $imagen;
                    $attach->save();
                    $idattach = $attach->idattachments;
                    $aud_attach = new Comisionistas_attachment();
                    $aud_attach->comisionista_id = $com_id;
                    $aud_attach->attachments_id = $idattach;
                    $aud_attach->save();
                    $aud_attach_id = $idattach;
                }else{
                    $aud_attach_id = (new Comisionistas_attachment())->where('comisionista_id',$com_id)->value('attachments_id');

                    $attach = new Attachment();
                    $attach->exists = true;
                    $attach->idattachments = $aud_attach_id;
                    $attach->file = $imagen;
                    $attach->save();

                }
                return  $aud_attach_id;
                break;
        }
        return '1';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coms = (new Comisionista())->where('id',$id)->first();
        $aud_attach_id = (new Comisionistas_attachment())->where('comisionista_id',$id)->value('attachments_id');
        $coms->com_img = $aud_attach_id;

        return response()->json([$coms],200,[], JSON_UNESCAPED_UNICODE);

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
