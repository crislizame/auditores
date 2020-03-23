<?php

namespace App\Http\Controllers\Permisos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class PermisosController extends Controller
{
    public function permisos(Request $request)
    {
        $pds = DB::table('pdsperfiles')->orderBy('id', 'asc')->get();
        $pds_permisos = null;
        $find_pds = (isset($request->pds) ? $request->pds : null);
        if ($find_pds != null) {
            $pds_permisos = DB::table('permisos')->where('id_pds', $find_pds)->orderBy('id', 'asc')->get();
        } else {
            $pds_id = DB::table('pdsperfiles')->orderBy('id', 'asc')->first()->id;
            $pds_permisos = DB::table('permisos')->where('id_pds', $pds_id)->orderBy('id', 'asc')->get();
        }
        return view('vistas.pages.permisos.permisos')->with('pds', $pds)->with('pds_permisos', $pds_permisos);
    }

    public function perfil()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        return view('vistas.pages.permisos.perfil')->with('user', $user);
    }
}
