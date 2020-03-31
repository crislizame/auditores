<?php

namespace App\Http\Controllers\API\Comisionista;

use App\Attachment;
use App\Comisionista;
use App\Comisionistas_attachment;
use App\Oreque_attachment;
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
            case "img":
                $image = $request->post("image");
                $com_id = $request->post("com_id");
                $attach = new Attachment();
                $attach->file = base64_decode($image);
                $attach->save();
                $count = (new Comisionistas_attachment())->where("comisionista_id",$com_id)->count();
                if ($count === 0){
                    $oreqx = new Comisionistas_attachment();
                    $oreqx->attachments_id = $attach->idattachments;
                    $oreqx->comisionista_id = $com_id;
                    $oreqx->save();
                }else{
                   (new Comisionistas_attachment())->where("comisionista_id",$com_id)->update(["attachments_id"=>$attach->idattachments]);

                }

                $res = array(
                    "result"=>$attach->idattachments
                );
                return response()->json($res,200,[], JSON_UNESCAPED_UNICODE);
                break;
            case "c":
                $comcon = (new Comisionista())->where(["cedula"=>$request->cedula])->count();
                if($comcon > 0){

                    $com = (new Comisionista())->where(["cedula"=>$request->cedula])->first();

                    $img = (new Comisionistas_attachment())->where(["comisionista_id"=>$com->id])->get();
                    if (password_verify($request->pass,$com->password)){


                    $com->img= $img ;
                    $user = $com;

                    $success['user'] = $user;
                    $success['password'] = $request->pass;
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
