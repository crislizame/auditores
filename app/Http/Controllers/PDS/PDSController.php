<?php

namespace App\Http\Controllers\PDS;

use App\Arqueocaja;
use App\Comisionista;
use App\Encauditdata;
use App\Encauditdataactivo;
use App\Encauditdataproceso;
use App\Http\Controllers\API\PerfilApiController;
use App\Informes_reporte;
use App\Pdsperfile;
use App\Pdsperfiles_attachment;
use App\Pdsperfiles_permiso;
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
                        <td width='30%'>" . strtoupper($pds->pds_name) . "</td>
                        <td >" . strtoupper($pds->pds_provincia). "</td>
                        <td>" . strtoupper($pds->pds_ciudad). "</td>
                        <td>" . strtoupper($pds->pds_sventas) . "</td>
                        <td><button class=\"btn btn-sm btn-warning btnEditarComisionista\" data-id=\"$pds->id\"><i class=\"fa fa-lg fa-edit\"></i></button> | <button class=\"btn btn-sm btn-danger btnEliminarComisionista\" data-id=\"$pds->id\"><i class=\"fa fa-lg fa-trash\"></i></button></td>
                    </tr>";
        }
        return $td;
    }
    public function mostrarpds(){
        $comi_id = \request('comi_id');


        $comisionista = (new Pdsperfile())->where('id',$comi_id)->first();
        $permisos_c = (new Pdsperfiles_permiso())->where('pds_id',$comi_id)->count();
        $attach = (new Pdsperfiles_attachment())->where('pds_id',$comi_id)->value("attachments_id");
        if($permisos_c == 0){
            $p_array = array();
            $array_permisos = ['bsenal','bextintores','msuelo','mpatente','mtasa','mpermisoanterior','lpermiso','lotros'];
            for ($i = 0;$i < count($array_permisos);$i++){
                $p_array[$array_permisos[$i]]="false";

            }

        }else{
            $permisos = (new Pdsperfiles_permiso())->where('pds_id',$comi_id)->first();
            $p_array = json_decode(json_encode($permisos),true);



        }
        $comisionista->attach = $attach;
        $c_array = json_decode(json_encode($comisionista),true);

        $result = array($c_array,$p_array);

        return json_encode($result);

    }
    public function editarPDS(){
        $comi_id = \request('comi_id');
        $datos = \request('datos');

        //$comisionista = (new Comisionista())->where('id',$comi_id)->first();

        //$result = $comisionista;
        //var_dump($datos);
        $array_permisos = ['bsenal','bextintores','msuelo','msalud','mpatente','mtasa','mpermisoanterior','lpermiso','lotros'];
        $ap = array(
            'bsenal'=>'false',
            'msalud'=>'false',
            'bextintores'=>'false',
            'msuelo'=>'false',
            'mpatente'=>'false',
            'mtasa'=>'false',
            'mpermisoanterior'=>'false',
            'lpermiso'=>'false',
            'lotros'=>'false'
        );
        $insert = [];
        for ($i = 0; $i < count($datos);$i++){
            if (in_array($datos[$i]['name'],$array_permisos)){
                $ap[$datos[$i]['name']] = $datos[$i]['value'] == "on" ? 'true' : 'false';
            }else{
                $insert[$datos[$i]['name']] = $datos[$i]['value'];

            }

        }
        //var_dump($insert);
        (new Pdsperfile())->where('id',$comi_id)->update($insert);
        $count = (new Pdsperfiles_permiso())->where('pds_id',$comi_id)->count();
        if($count == 0){
            $ap['pds_id'] = $comi_id;
            (new Pdsperfiles_permiso())->insert($ap);

        }else{
            (new Pdsperfiles_permiso())->where('pds_id',$comi_id)->update($ap);

        }

        return md5(1);

    }
    public function guardarPDS(){
        $datos = \request('datos');

        //$comisionista = (new Comisionista())->where('id',$comi_id)->first();

        //$result = $comisionista;
        //var_dump($datos);
        $array_permisos = ['bsenal','bextintores','msuelo','msalud','mpatente','mtasa','mpermisoanterior','lpermiso','lotros'];
        $ap = array(
            'bsenal'=>'false',
            'msalud'=>'false',
            'bextintores'=>'false',
            'msuelo'=>'false',
            'mpatente'=>'false',
            'mtasa'=>'false',
            'mpermisoanterior'=>'false',
            'lpermiso'=>'false',
            'lotros'=>'false'
        );

        $insert = [];
        for ($i = 0; $i < count($datos);$i++){
            if (in_array($datos[$i]['name'],$array_permisos)){
                $ap[$datos[$i]['name']] = $datos[$i]['value'] == "on" ? 'true' : 'false';
            }else{
                $insert[$datos[$i]['name']] = $datos[$i]['value'];

            }

        }
      //  var_dump($array_permisos_insert);
       $pds_id = (new Pdsperfile())->insertGetId($insert);
        $ap['pds_id'] = $pds_id;
        (new Pdsperfiles_permiso())->insert($ap);

        return md5(1);

    }
    public function eliminarPDS(){
        $comi_id = \request('comi_id');
        (new Encauditdata())->where('pds_id',$comi_id)->delete();
        (new Encauditdataactivo())->where('pds_id',$comi_id)->delete();
        (new Arqueocaja())->where('pds_id',$comi_id)->delete();
        (new Informes_reporte())->where('pds_id',$comi_id)->delete();
        (new Pdsperfiles_permiso())->where('pds_id',$comi_id)->delete();
        (new Pdsperfiles_attachment())->where('pds_id',$comi_id)->delete();
        (new Pdsperfile())->where('id',$comi_id)->delete();
        return md5(1);
    }
}
