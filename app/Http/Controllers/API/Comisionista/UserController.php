<?php

namespace App\Http\Controllers\API\Comisionista;

use App\Comisionista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "s";
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
            case "c":
                $comcon = (new Comisionista())->where(["cedula"=>$request->cedula])->count();
                if($comcon > 0){

                    $com = (new Comisionista())->where(["cedula"=>$request->cedula])->first();
                    if (password_verify($request->pass,$com->password)){



                    $user = $com;
                    $success['user'] = $user;
                    $success['status'] = 'success';
                    $success['msg'] = 'Bienvenido '.$user->nombres.'!';
                    $success['token'] =  $user->password;
                    $res= $success;
                        return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);

                    }
                    else{
                        $res = array('status'=>'error','msg'=>'Contraseña errónea.','error'=>'Unauthorised', 'request'=>$request->all());
                        return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);

                    }
                } else{
                    $res = array('status'=>'error','msg'=>'Usuario no existe.','error'=>'Unauthorised', 'request'=>$request->all());
                    return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);

                }
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
