<?php

namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MantenimientoController extends Controller
{
    public function problemas()
    {
        return view('vistas.pages.mantenimiento.problemas');
    }

    public function cargar()
    {
        $ordenes = DB::table('orden_requermientos')
            ->select(
                'orden_requermientos.idorden_requermientos',
                DB::raw('areas.name as area'),
                DB::raw('subareas.name as subarea'),
                'orden_requermientos.problema',
                DB::raw('pdsperfiles.pds_name as cliente'),
                DB::raw('orden_requermientos.finicio as rfinicio'),
                'orden_trabajos.finicio',
                'orden_trabajos.ffin',
                'orden_trabajos.estado_orden'
            )
            ->join('areas', 'orden_requermientos.area_id', 'areas.idareas')
            ->join('subareas', 'orden_requermientos.subarea_id', 'subareas.idsubareas')
            ->join('pdsperfiles', 'orden_requermientos.pds_id', 'pdsperfiles.id')
            ->leftJoin('orden_trabajos', 'orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
            ->get();

        $tbody = "";
        foreach ($ordenes as $orden) {
            $tbody .= "<tr>
                        <th scope=\"row\">" . $orden->idorden_requermientos . "</th>
                        <td>" . $orden->area . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->subarea), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->problema), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->cliente), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->rfinicio), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->finicio), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->ffin), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->estado_orden), '0', '15', '...') . "</td>
                    </tr>";
        }
        return $tbody;
    }

    public function ordenes()
    {
        return view('vistas.pages.mantenimiento.ordenes');
    }

    public function proveedores()
    {
        return view('vistas.pages.mantenimiento.provedores');
    }

    public function perfil()
    {
        return view('vistas.pages.mantenimiento.perfil');
    }
}
