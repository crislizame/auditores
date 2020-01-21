<?php

namespace App\Http\Controllers\PDS;

use App\Comisionista;
use App\Pdsperfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDSController extends Controller
{
    public function index()
    {
        return view('vistas.pages.admin.pds.pds');
    }

    public function cargarpds()
    {
        $datos_pds = Pdsperfile::all();
        $td = "";
        foreach ($datos_pds as $pds) {
            $td .= "<tr>
                        <th scope=\"row\">" . $pds->id . "</th>
                        <td>" . mb_strimwidth(strtoupper($pds->pds_name), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($pds->pds_provincia), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($pds->pds_ciudad), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($pds->pds_sventas), '0', '15', '...') . "</td>
                        <td><button class=\"btn btn-sm btn-warning btnEditarComisionista\" data-id=\"$pds->id\"><i class=\"fa fa-lg fa-edit\"></i></button> | <button class=\"btn btn-sm btn-danger btnEliminarComisionista\" data-id=\"$pds->id\"><i class=\"fa fa-lg fa-trash\"></i></button></td>
                    </tr>";
        }
        return $td;
    }
    public function mostrarpds(){
        $comi_id = \request('comi_id');


        $comisionista = (new Comisionista())->where('id',$comi_id)->first();

        $result = $comisionista;

        return json_encode($result);

    }
    public function editarPDS(){
        $comi_id = \request('comi_id');
        $datos = \request('datos');

        //$comisionista = (new Comisionista())->where('id',$comi_id)->first();

        //$result = $comisionista;
        //var_dump($datos);
        $insert = [];
        for ($i = 0; $i < count($datos);$i++){
            $insert[$datos[$i]['name']] = $datos[$i]['value'];

        }
        //var_dump($insert);
        (new Comisionista())->where('id',$comi_id)->update($insert);
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
    public function eliminarPDS(){
        $comi_id = \request('comi_id');
        (new Comisionista())->where('id',$comi_id)->delete();
        return md5(1);
    }
}
