<?php

namespace App\Http\Controllers\API;

use App\Comisionista;
use App\Comisionistas_attachment;
use App\Comisionistas_reporte;
use App\Pdsperfiles_attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComisionistasApiController extends Controller
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
        $id = $request->post('pds_id');
        $auditor_id = $request->post('auditor_id');
        $agenda_id = $request->post('agenda_id');
        $res = array();
        $coms = (new Comisionista())->where('pds_id',$id)->get();
        // $aud_attach_id = (new Comisionistas_attachment())->where('comisionista_id',$id)->value('attachments_id');

        foreach ($coms as $com) {
            //   $com->com_img = $aud_attach_id;
            $aud_attach_id = (new Comisionistas_attachment())->where('comisionista_id',$com->id)->value('attachments_id');
            $pcom_c = (new Comisionistas_reporte())->where(['comisionista_id'=>$com->id,'agenda_id'=>$agenda_id,'pds_id'=>$id,'auditor_id'=>$auditor_id])->count();
            if ($pcom_c == 0){
                $presente = 'x';
            }else{
                $presente = (new Comisionistas_reporte())->where(['comisionista_id'=>$com->id,'agenda_id'=>$agenda_id,'pds_id'=>$id,'auditor_id'=>$auditor_id])->value('presente');
            }
            $com->com_img = $aud_attach_id;
            $com->presente = $presente;
            $res[] = $com;


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
