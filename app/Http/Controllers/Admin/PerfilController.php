<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Calificacion;
use App\Proveedor;
use Carbon\Carbon;
use App\User;

class PerfilController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        $calificacion = Calificacion::where('id_user_calificado', $user->id)->avg('calificacion');

        $cumplimiento_datos = Proveedor::select('problemas.tiempo', 'orden_requermientos.enproceso', 'orden_requermientos.finalizado')
            ->join('orden_trabajos', 'proveedores.idproveedores', 'orden_trabajos.proveedor_id')
            ->join('orden_requermientos', 'orden_trabajos.orden_requermiento_id', 'orden_requermientos.idorden_requermientos')
            ->join('problemas', 'orden_requermientos.problema_id', 'problemas.id')
            ->where('proveedores.nombre', 'Mantenimiento')
            ->get();

        $cumplido = 0;
        $nocumplido = 0;

        foreach ($cumplimiento_datos as $datos) {
            $diff = new Carbon($datos->enproceso);
            $diff = $diff->diffInHours($datos->finalizado);
            switch (($diff > $datos->tiempo) ? 0 : 1) {
                case 0;
                    $nocumplido++;
                    break;
                case 1;
                    $cumplido++;
                    break;
            }
        }

        $cumple = $cumplido >= $nocumplido ? '1 (Dentro del rango)' : '0 (Fuera del rango)';

        return view('vistas.pages.admin.perfil')->with('user', $user)->with('calificacion', $calificacion)->with('cumple', $cumple);
    }
}
