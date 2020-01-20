<?php

namespace App\Http\Controllers\API;

use App\Attachment;
use App\Auditores_attachment;
use App\Pdsperfiles_attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdsApiController extends Controller
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
        $pds_id = $request->post('pds_id');
        switch ($tipo){
            case 'simg':
                $imagen = base64_decode($request->post('image'));

                $aud_attach_count = (new Pdsperfiles_attachment())->where('pds_id',$pds_id)->count();


                if ($aud_attach_count == 0){
                    $attach = new Attachment();
                    $attach->file = $imagen;
                    $attach->save();
                    $idattach = $attach->idattachments;
                    $aud_attach = new Pdsperfiles_attachment();
                    $aud_attach->pds_id = $pds_id;
                    $aud_attach->attachments_id = $idattach;
                    $aud_attach->save();
                    $aud_attach_id = $idattach;
                }else{
                    $aud_attach_id = (new Pdsperfiles_attachment())->where('pds_id',$pds_id)->value('attachments_id');

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
