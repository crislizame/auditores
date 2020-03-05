<?php

namespace App\Http\Controllers\Soporte;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Orden_Requerimiento;
use App\Otrabajo_attachment;
use App\Oreque_attachment;
use App\Orden_trabajo;
use App\Attachment;
use App\User;

class SoporteController extends Controller
{
    public function problemas(Request $request)
    {
        $cat = (isset($request->cat) ? $request->cat : 'loteria');
        $proveedores = DB::table('proveedores')->orderBy('idproveedores', 'asc')->get();
        return view('vistas.pages.soporte.problemas')->with('cat', $cat)->with('proveedores', $proveedores);
    }
}
