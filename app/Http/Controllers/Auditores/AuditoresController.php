<?php

namespace App\Http\Controllers\Auditores;

use App\Auditore;
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
}
