<?php

namespace App\Http\Controllers\API;

use App\Attachment;
use App\Auditore;
use App\Auditores_attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Scalar\String_;

class PerfilAuditorController extends Controller
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
        $auditor_id = $request->post('auditor_id');
        switch ($tipo){
            case 's':
            //variables
                $auditor_nombre = $request->post('auditor_nombre');
                $auditor_apellidos = $request->post('auditor_apellidos');
                $auditor_direccion = $request->post('auditor_direccion');
                $auditor_email = $request->post('auditor_email');
                $auditor_cuentatipo = $request->post('auditor_cuentatipo');
                $auditor_cuentanumero = $request->post('auditor_cuentanumero');
                $auditor_cuentabanco= $request->post('auditor_cuentabanco');
                $auditor_cedula= $request->post('auditor_cedula');
                $auditor = new Auditore();
                $auditor->exists = true;
                $auditor->id =$auditor_id;
                if (!empty($auditor_nombre)){
                    $auditor->aud_nombre = $auditor_nombre;
                }
                if (!empty($auditor_direccion)){
                    $auditor->aud_direccion = $auditor_direccion;
                }
                if (!empty($auditor_email)){
                    $auditor->aud_correo = $auditor_email;
                }
                if (!empty($auditor_cuentatipo)){
                    $auditor->aud_cuentatipo = $auditor_cuentatipo;
                }
                if (!empty($auditor_cuentanumero)){
                    $auditor->aud_cuentanumero = $auditor_cuentanumero;
                }
                if (!empty($auditor_cuentabanco)){
                    $auditor->aud_cuentabanco = $auditor_cuentabanco;
                }
                if (!empty($auditor_apellidos)){
                    $auditor->aud_apellidos = $auditor_apellidos;
                }
                if (!empty($auditor_cedula)){
                    $contarcedula = (new Auditore())->where('aud_cedula',$auditor_cedula)->count();
                    if($contarcedula == 0){
                        $auditor->aud_cedula = $auditor_cedula;

                    }
                }
                $auditor->save();
                break;
            case 'simg':
                $imagen = base64_decode($request->post('image'));

                $aud_attach_count = (new Auditores_attachment())->where('auditor_id',$auditor_id)->count();


                if ($aud_attach_count == 0){
                    $attach = new Attachment();
                    $attach->file = $imagen;
                    $attach->user_id = $auditor_id;
                    $attach->save();
                    $idattach = $attach->idattachments;
                    $aud_attach = new Auditores_attachment();
                    $aud_attach->auditor_id = $auditor_id;
                    $aud_attach->attachments_id = $idattach;
                    $aud_attach->save();
                    $aud_attach_id = $idattach;
                }else{
                    $aud_attach_id = (new Auditores_attachment())->where('auditor_id',$auditor_id)->value('attachments_id');

                    $attach = new Attachment();
                    $attach->exists = true;
                    $attach->idattachments = $aud_attach_id;
                    $attach->file = $imagen;
                    $attach->save();

                }
                return  $aud_attach_id;
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
