<?php

namespace App\Http\Controllers\API;

use App\Arqueo_attachment;
use App\Attachment;
use App\Encauditdata_attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagenController extends Controller
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
            case "arqueoimg":
                $res = [];
                $arqueo_id = $request->post('encauditdatas_id');
                $images = (new Arqueo_attachment())->where(['arqueo_id'=>$arqueo_id])->get();
                foreach ($images as $image) {
                    $attach = (new Attachment())->where(['idattachments'=>$image->attachments_id])->first();
                    $res[] = array(
                        'idimage'=> $attach->idattachments,
                        'image'=> "",
                        'user_id'=> $attach->user_id
                    );
                }
                return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
                break;
            case 's':
                $imagen = base64_decode($request->post('image'));
                $auditor_id = $request->post('auditor_id');
                $attach = new Attachment();
                $attach->file = $imagen;
                $attach->user_id = $auditor_id;
                $attach->save();

                $enc_image = new Encauditdata_attachment();
                $enc_image->encauditdatas_id = $request->post('encauditdatas_id');
                $enc_image->attachments_id = $attach->idattachments;
                $enc_image->save();
                return (string)$enc_image->idencauditdata_attachments;
                break;
            case 'c':
                $res = [];
                $encauditdatas_id = $request->post('encauditdatas_id');
                $images = (new Encauditdata_attachment())->where(['encauditdatas_id'=>$encauditdatas_id])->get();
                foreach ($images as $image) {
                    $attach = (new Attachment())->where(['idattachments'=>$image->attachments_id])->first();
                    $res[] = array(
                        'idimage'=> $attach->idattachments,
                        'image'=> "",
                        'user_id'=> $attach->user_id
                    );
                }
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
        $image = (new Attachment())->where('idattachments',$id)->value('file');
        return base64_encode($image);
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
        (new Attachment())->where('idattachments',$id)->delete();
        (new Encauditdata_attachment())->where('attachments_id',$id)->delete();
        return md5('1');
    }
}
