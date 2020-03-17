<?php

namespace App\Http\Controllers\Permisos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class PermisosController extends Controller
{
    public function problemas(Request $request)
    {
        $pds = DB::table('pdsperfiles')->orderBy('id', 'asc')->get();
        return view('vistas.pages.permisos.permisos')->with('pds', $pds);
    }

    public function cargarProblemas(Request $request)
    {
        
    }

    public function perfil()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        return view('vistas.pages.permisos.perfil')->with('user', $user);
    }
}
