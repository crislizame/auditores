<?php

namespace App\Http\Controllers\Admin;

use App\Comisionista;
use App\Comisionistas_attachment;
use App\Pdsperfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComisionistasController extends Controller
{
    public function listas(){
        return view('vistas.pages.admin.comisionistas.comisionistas');
    }
    public function obtenertodos(){
        $provinciasx = public_path('provincias.json');
        $abierto = file_get_contents($provinciasx);
        $provincias = json_decode($abierto);

        foreach ($provincias as $provincia) {


            foreach ($provincia->cantones as $canton) {
                echo $canton->canton.'<br>';
            }


        }
    }
    public function ciudadpds(){
        $pds_id = \request('pds_id');

        $pdssql = (new Pdsperfile())->where('id',$pds_id)->first();
        return $pdssql->pds_ciudad;
    }
    public function cargarcomisionistas(){
        $comisionistas = (new \App\Comisionista())->orderBy('id','desc')->get();
        $td = "";
        foreach ($comisionistas as $comisionista) {
            if ($comisionista->pds_id == null){
                $pdsname = "";
                $ciudad = "";
            }else{
                $pds = (new \App\Pdsperfile())->where('id',$comisionista->pds_id)->first();

                $pdsname = $pds->pds_name;
                $ciudad = $pds->pds_ciudad;

            }
            $td .= "<tr>
                        <th scope=\"row\">".$comisionista->id."</th>
                        <td>".mb_strimwidth(strtoupper($comisionista->nombres),'0','15','...')."</td>
                        <td>".mb_strimwidth(strtoupper($comisionista->apellidos),'0','15','...')."</td>
                        <td data-toggle='tooltip' title='$pdsname' data-placement='top'>".strtoupper($pdsname)."</td>
                        <td>".strtoupper($ciudad)."</td>                       
                        <td>$comisionista->calificacion</td>
                        <td><button class=\"btn btn-sm btn-warning btnEditarComisionista\" data-id=\"$comisionista->id\"><i class=\"fa fa-lg fa-edit\"></i></button> | <button class=\"btn btn-sm btn-danger btnEliminarComisionista\" data-id=\"$comisionista->id\"><i class=\"fa fa-lg fa-trash\"></i></button></td>
                    </tr>";
        }
        return $td;
    }
    public function mostrarComisionistas(){
    $comi_id = \request('comi_id');


    $comisionista = (new Comisionista())->where('id',$comi_id)->first();
    $attach = (new Comisionistas_attachment())->where('comisionista_id',$comi_id)->value("attachments_id");
        $comisionista->attach = $attach;

    $result = $comisionista;

    return json_encode($result);

    }
    public function editarComisionistas(){
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
    public function guardarComisionistas(){
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
    public function eliminarComisionistas(){
        $comi_id = \request('comi_id');
        (new Comisionista())->where('id',$comi_id)->delete();
        return md5(1);
    }
}
