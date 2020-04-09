<?php

namespace App\Http\Controllers\Permisos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class PermisosController extends Controller
{
    public function permisos(Request $request)
    {
        $pds = DB::table('pdsperfiles')->orderBy('id', 'asc')->get();
        return view('vistas.pages.permisos.permisos')->with('pds', $pds);
    }

    public function buscarPermisos(Request $request)
    {
        $pds_permisos = DB::table('pdsperfiles_permisos')
            ->where('pds_id', $request->id)
            ->first();

        $html = '';

        if ($pds_permisos->bsenal == 'true') {

            $permiso = DB::table('pdspermisos')
            ->where('id_pds', $request->id)
            ->first();

            $tiempo_restante = 0;
            if( date('Y-m-d') < $permiso->caducidad ){
                $tiempo_restante = Carbon::parse($permiso->caducidad)->diffInDays(\Carbon\Carbon::now());
            }

            $html .= '<div class="row mt-3">
            <form method="post" action="'.url('permisos/guardar').'">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">Señalética</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" @if($row->aplica==1) checked @endif>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;" @if($row->aplica==0) @endif>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input type="date" class="form-control" placeholder="00-00-0000" value="'.($permiso->expedicion!=null?$permiso->expedicion:'').'">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input type="date" class="form-control" placeholder="00-00-0000" value="'.($permiso->caducidad!=null?$permiso->caducidad:'').'">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">'.$tiempo_restante.'</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3">
            </div>
            </form>
        </div>';

        }
        return $html;
    }

    public function perfil()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        return view('vistas.pages.permisos.perfil')->with('user', $user);
    }
}