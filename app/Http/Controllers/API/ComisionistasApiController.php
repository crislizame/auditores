<?php

namespace App\Http\Controllers\API;

use App\Comisionista;
use App\Comisionistas_attachment;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = array();
        $coms = (new Comisionista())->where('pds_id',$id)->get();
       // $aud_attach_id = (new Comisionistas_attachment())->where('comisionista_id',$id)->value('attachments_id');


        foreach ($coms as $com) {
         //   $com->com_img = $aud_attach_id;
            $aud_attach_id = (new Comisionistas_attachment())->where('comisionista_id',$com->id)->value('attachments_id');

            $res[] = $com;
            $com->com_img = $aud_attach_id;

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
