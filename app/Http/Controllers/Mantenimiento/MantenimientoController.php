<?php

namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MantenimientoController extends Controller
{
    public function problemas(){
        return view('vistas.pages.mantenimiento.problemas');
    }

    public function cargar(){
        $ordenes = DB::table('orden_requermientos')
        ->select(
            'orden_requermientos.idorden_requermientos',
            'areas.name',
            'subareas.name',
            'orden_requermientos.problema',
            'pdsperfiles.pds_name',
            'orden_requermientos.finicio',
            'orden_trabajos.finicio',
            'orden_trabajos.ffin',
            'orden_trabajos.estado_orden'
            )
        ->join('areas','orden_requermientos.area_id','areas.idareas')
        ->join('subareas','orden_requermientos.subarea_id','subareas.idsubareas')
        ->join('pdsperfiles','orden_requermientos.pds_id','pdsperfiles.id')
        ->leftJoin('orden_trabajos','orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
        ->get();

        dd($ordenes);
    }

    public function ordenes(){
        return view('vistas.pages.mantenimiento.ordenes');
    }

    public function proveedores(){
        return view('vistas.pages.mantenimiento.provedores');
    }

    public function perfil(){
        return view('vistas.pages.mantenimiento.perfil');
    }
}
