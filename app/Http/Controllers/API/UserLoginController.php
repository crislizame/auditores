<?php

namespace App\Http\Controllers\API;

use App\Auditore;
use App\Auditores_attachment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
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
        $cedula = $request->post('user');
        $password =$request->post('pass');
        $result = array('result'=>false,'data'=>'');
        $count = (new Auditore())->where('aud_cedula',$cedula)->count();
        if ($count > 0){

            $user = (new Auditore())->where('aud_cedula',$cedula)->first();
            $aud_attach_id = (new Auditores_attachment())->where('auditor_id',$user->id)->value('attachments_id');
            $user->img_id = $aud_attach_id;
            if (password_verify($password,$user->password)){
                unset($user->deleted_at);
                $result['result'] = true;
                $result['data'] = json_encode($user);
            }

        }
        $ress[] = $result;
        return \Response::json($ress);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
