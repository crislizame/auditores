<?php

namespace App\Http\Controllers\Mantenimiento;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MantenimientoController extends Controller
{
    public function problemas(Request $request)
    {
        dd($request->all());
        return view('vistas.pages.mantenimiento.problemas')->with('cat', $request->cat);
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
            $estado = null;
            if ($orden->estado_orden != null) {
                $estado = mb_strimwidth(strtoupper($orden->estado_orden), '0', '15', '...');
                switch ($estado) {
                    case 'S':
                        $estado .= ' <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        break;
                    case 'E':
                        $estado .= ' <span style="background-color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        break;
                    case 'F':
                        $estado .= ' <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        break;
                }
            } else {
                $estado = 'Sin orden de trabajo';
                $estado .= ' <span style="background-color: black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
            }

            $rfinicio = ($orden->rfinicio != null ? mb_strimwidth(strtoupper($orden->rfinicio), '0', '15', '...') : '------');

            $tiempo_estimado = '------';
            if ($orden->finicio != null && $orden->ffin != null) {
                $finicio = Carbon::parse($orden->finicio);
                $ffin = Carbon::parse($orden->ffin);
                $tiempo_estimado = $finicio->diffForHumans($ffin);
            }

            $tbody .= "<tr>
                        <th scope=\"row\"><a href=\"#\">" . 'C-' . str_pad($orden->idorden_requermientos, 7, "0", STR_PAD_LEFT) . "</a></th>
                        <td>" . mb_strimwidth(strtoupper($orden->area), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->subarea), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->problema), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->cliente), '0', '15', '...') . "</td>
                        <td>" . $rfinicio . "</td>
                        <td>" . $tiempo_estimado . "</td>
                        <td>" . $estado . "</td>
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
