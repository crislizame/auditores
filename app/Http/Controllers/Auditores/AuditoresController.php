<?php

namespace App\Http\Controllers\Auditores;

use App\Auditore;
use App\Auditores_attachment;
use App\Comisionista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditoresController extends Controller
{
    public function index()
    {
        return view('vistas.pages.admin.auditores.auditores');
    }

    public function cargarauditores()
    {
        $datos_auditores = Auditore::all();
        $td = "";
        foreach ($datos_auditores as $auditor) {
            $td .= "<tr>
                        <th scope=\"row\">" . $auditor->id . "</th>
                        <td>" . ($auditor->auditor_tipo == "N" ? "NORMAL" : "PROCESO") . "</td>
                        <td>" . mb_strimwidth(strtoupper($auditor->aud_nombre), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($auditor->aud_apellidos), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($auditor->aud_cedula), '0', '15', '...') . "</td>
                        <td><button class=\"btn btn-sm btn-warning btnEditarComisionista\" data-id=\"$auditor->id\"><i class=\"fa fa-lg fa-edit\"></i></button> | <button class=\"btn btn-sm btn-danger btnEliminarComisionista\" data-id=\"$auditor->id\"><i class=\"fa fa-lg fa-trash\"></i></button></td>
                    </tr>";
        }
        return $td;
    }
    public function guardarAuditores(){
        $datos = \request('datos');
        //$comisionista = (new Comisionista())->where('id',$comi_id)->first();

        //$result = $comisionista;
        //var_dump($datos);
        $insert = [];
        for ($i = 0; $i < count($datos);$i++){
            if($datos[$i]['name'] == "password"){
                if($datos[$i]['value'] != ""){
                    $insert[$datos[$i]['name']] = bcrypt($datos[$i]['value']);

                }else{
                    $insert[$datos[$i]['name']] = bcrypt("1234");
                }
            }else{
                $insert[$datos[$i]['name']] = $datos[$i]['value'];

            }



        }
        //var_dump($insert);
        (new Auditore())->insert($insert);
        return md5(1);

    }
    public function guardarPDS(){
        $datos = \request('datos');

        //$comisionista = (new Comisionista())->where('id',$comi_id)->first();

        //$result = $comisionista;
        //var_dump($datos);
        $insert = [];
        for ($i = 0; $i < count($datos);$i++){
            $insert[$datos[$i]['name']] = $datos[$i]['value'];

        }
        //var_dump($insert);
        (new Comisionista())->insert($insert);
        return md5(1);

    }
    public function eliminarAuditores(){
        $comi_id = \request('comi_id');
        (new Auditore())->where('id',$comi_id)->delete();
        return md5(1);
    }
    public function mostrarAuditores(){
        $comi_id = \request('comi_id');


        $comisionista = (new Auditore())->where('id',$comi_id)->first();
        $attach = (new Auditores_attachment())->where('auditor_id',$comi_id)->value("attachments_id");
        $comisionista->attach = $attach;

        $result = $comisionista;

        return json_encode($result);

    }
    public function editarAuditores(){
        $comi_id = \request('comi_id');
        $datos = \request('datos');

        //$comisionista = (new Comisionista())->where('id',$comi_id)->first();

        //$result = $comisionista;
        //var_dump($datos);
        $insert = [];
        for ($i = 0; $i < count($datos);$i++){
            if($datos[$i]['name'] == "password"){
                if($datos[$i]['value'] != ""){
                    $insert[$datos[$i]['name']] = bcrypt($datos[$i]['value']);

                }
            }else{
                $insert[$datos[$i]['name']] = $datos[$i]['value'];

            }



        }
        //var_dump($insert);
        (new Auditore())->where('id',$comi_id)->update($insert);
        return md5(1);

    }
}
