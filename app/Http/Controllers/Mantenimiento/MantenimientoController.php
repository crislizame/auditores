<?php

namespace App\Http\Controllers\Mantenimiento;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Orden_Requerimiento;
use App\Otrabajo_attachment;
use App\Oreque_attachment;
use App\Orden_trabajo;
use App\Calificacion;
use App\Attachment;
use App\User;

class MantenimientoController extends Controller
{
    public function problemas(Request $request)
    {
        $cat = (isset($request->cat) ? $request->cat : 'loteria');
        $proveedores = DB::table('proveedores')->orderBy('idproveedores', 'asc')->get();
        return view('vistas.pages.mantenimiento.problemas')->with('cat', $cat)->with('proveedores', $proveedores);
    }

    public function cargarProblemas(Request $request)
    {
        if ($request->cat == 'loteria') {
            $ordenes = DB::table('orden_requermientos')
                ->select(
                    'orden_requermientos.idorden_requermientos',
                    'problemas.tiempo',
                    DB::raw('problemas.nombre as problema'),
                    DB::raw('subareas.nombre as subarea'),
                    DB::raw('areas.nombre as area'),
                    DB::raw('entidades.nombre as entidad'),
                    DB::raw('pdsperfiles.pds_name as cliente'),
                    'orden_requermientos.solicitado',
                    'orden_requermientos.enproceso',
                    'orden_requermientos.finalizado',
                    DB::raw('entidades.nombre as entidad')
                )
                ->join('problemas', 'orden_requermientos.problema_id', 'problemas.id')
                ->join('subareas', 'problemas.subarea_id', 'subareas.idsubareas')
                ->join('areas', 'subareas.area_id', 'areas.idareas')
                ->join('entidades', 'entidades.identidad', 'areas.entidad_id')
                ->join('pdsperfiles', 'orden_requermientos.pds_id', 'pdsperfiles.id')
                ->leftJoin('orden_trabajos', 'orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
                ->where(function ($query) {
                    $query->whereNull('orden_requermientos.enproceso')
                        ->orWhereNotNull('orden_requermientos.enproceso');
                })
                ->whereNull('orden_requermientos.finalizado')
                ->get();

            $tbody = "";
            foreach ($ordenes as $orden) {
                $id = 'C-' . str_pad($orden->idorden_requermientos, 7, "0", STR_PAD_LEFT);

                $estado = 'Solicitado <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';

                if ($orden->enproceso != null) {
                    $estado = 'En proceso <span style="background-color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }
                if ($orden->finalizado != null) {
                    $estado = 'Finalizado <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }

                $taux = new \DateTime(date('Y-m-d'));
                $taux->setTime($orden->tiempo, 0, 0);

                $tbody .= "<tr>
                        <th scope=\"row\"><a href=\"#\" onclick=\"modalAsignarOrdenDeTrabajo(" . $orden->idorden_requermientos . ", '" . $id . "', '" . $orden->entidad . "')\">" . $id . "</a></th>
                        <td>" . mb_strimwidth(strtoupper($orden->area), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->subarea), '0', '15', '...') . "</td>
                        <td>" . $orden->problema . "</td>
                        <td>" . $orden->cliente . "</td>
                        <td>" . Carbon::parse($orden->solicitado)->format('d/m/Y') . "</td>
                        <td>" . date_format($taux, 'H:i') . "</td>
                        <td>" . $estado . "</td>
                    </tr>";
            }
            return $tbody;
        } else if ($request->cat == 'proveedores') {
            $ordenes = DB::table('orden_requermientos')
                ->select(
                    'orden_requermientos.idorden_requermientos',
                    'problemas.tiempo',
                    DB::raw('problemas.nombre as problema'),
                    DB::raw('subareas.nombre as subarea'),
                    DB::raw('areas.nombre as area'),
                    DB::raw('entidades.nombre as entidad'),
                    DB::raw('pdsperfiles.pds_name as cliente'),
                    'orden_requermientos.solicitado',
                    'orden_requermientos.enproceso',
                    'orden_requermientos.finalizado',
                    DB::raw('entidades.nombre as entidad')
                )
                ->join('problemas', 'orden_requermientos.problema_id', 'problemas.id')
                ->join('subareas', 'problemas.subarea_id', 'subareas.idsubareas')
                ->join('areas', 'subareas.area_id', 'areas.idareas')
                ->join('entidades', 'entidades.identidad', 'areas.entidad_id')
                ->join('pdsperfiles', 'orden_requermientos.pds_id', 'pdsperfiles.id')
                ->leftJoin('orden_trabajos', 'orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
                ->where(function ($query) {
                    $query->whereNull('orden_requermientos.enproceso')
                        ->orWhereNotNull('orden_requermientos.enproceso');
                })
                ->whereNull('orden_requermientos.finalizado')
                ->where(function ($query) {
                    $query->where('entidades.nombre', 'Lotto Game')
                        ->orWhere('entidades.nombre', 'RP3');
                })
                ->get();

            $tbody = "";
            foreach ($ordenes as $orden) {
                $id = 'C-' . str_pad($orden->idorden_requermientos, 7, "0", STR_PAD_LEFT);

                $estado = 'Solicitado <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';

                if ($orden->enproceso != null) {
                    $estado = 'En proceso <span style="background-color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }
                if ($orden->finalizado != null) {
                    $estado = 'Finalizado <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }

                $taux = new \DateTime(date('Y-m-d'));
                $taux->setTime($orden->tiempo, 0, 0);

                $tbody .= "<tr>
                        <th scope=\"row\"><a href=\"#\" onclick=\"modalAsignarOrdenDeTrabajo(" . $orden->idorden_requermientos . ", '" . $id . "', '" . $orden->entidad . "')\">" . $id . "</a></th>
                        <td>" . mb_strimwidth(strtoupper($orden->entidad), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->subarea), '0', '15', '...') . "</td>
                        <td>" . $orden->problema . "</td>
                        <td>" . $orden->cliente . "</td>
                        <td>" . $orden->solicitado . "</td>
                        <td>" . date_format($taux, 'H:i') . "</td>
                        <td>" . $estado . "</td>
                    </tr>";
            }
            return $tbody;
        }
    }

    public function cargarOrdenes(Request $request)
    {
        if ($request->cat == 'loteria') {
            $ordenes = DB::table('orden_requermientos')
                ->select(
                    'orden_requermientos.idorden_requermientos',
                    'problemas.tiempo',
                    DB::raw('problemas.nombre as problema'),
                    DB::raw('subareas.nombre as subarea'),
                    DB::raw('areas.nombre as area'),
                    DB::raw('entidades.nombre as entidad'),
                    DB::raw('pdsperfiles.pds_name as cliente'),
                    'orden_requermientos.solicitado',
                    'orden_requermientos.enproceso',
                    'orden_requermientos.finalizado',
                    DB::raw('entidades.nombre as entidad'),
                    'orden_trabajos.idorden_trabajos'
                )
                ->join('problemas', 'orden_requermientos.problema_id', 'problemas.id')
                ->join('subareas', 'problemas.subarea_id', 'subareas.idsubareas')
                ->join('areas', 'subareas.area_id', 'areas.idareas')
                ->join('entidades', 'entidades.identidad', 'areas.entidad_id')
                ->join('pdsperfiles', 'orden_requermientos.pds_id', 'pdsperfiles.id')
                ->leftJoin('orden_trabajos', 'orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
                ->whereNotNull('orden_requermientos.enproceso')
                ->where(function ($query) {
                    $query->whereNull('orden_requermientos.finalizado')
                        ->orWhereNotNull('orden_requermientos.finalizado');
                })
                ->get();

            $tbody = "";
            foreach ($ordenes as $orden) {
                $id = 'C-' . str_pad($orden->idorden_requermientos, 7, "0", STR_PAD_LEFT);

                $estado = 'Solicitado <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';

                if ($orden->enproceso != null) {
                    $estado = 'En proceso <span style="background-color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }
                if ($orden->finalizado != null) {
                    $calificado = Calificacion::where('id_orden_trabajo', $orden->idorden_trabajos)->exists();
                    if ($calificado) {
                        $estado = 'Finalizado <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    } else {
                        $estado = '<a href="#" onclick="modalCalificar(' . $orden->idorden_trabajos . ')">Finalizado</a> <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    }
                }

                $taux = new \DateTime(date('Y-m-d'));
                $taux->setTime($orden->tiempo, 0, 0);

                $tbody .= "<tr>
                        <th scope=\"row\"><a href=\"#\" onclick=\"modalAsignarOrdenDeTrabajo(" . $orden->idorden_requermientos . ", '" . $id . "', '" . $orden->entidad . "')\">" . $id . "</a></th>
                        <td>" . mb_strimwidth(strtoupper($orden->area), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->subarea), '0', '15', '...') . "</td>
                        <td>" . $orden->problema . "</td>
                        <td>" . $orden->cliente . "</td>
                        <td>" . Carbon::parse($orden->solicitado)->format('d/m/Y') . "</td>
                        <td>" . date_format($taux, 'H:i') . "</td>
                        <td>" . $estado . "</td>
                    </tr>";
            }
            return $tbody;
        } else if ($request->cat == 'proveedores') {
            $ordenes = DB::table('orden_requermientos')
                ->select(
                    'orden_requermientos.idorden_requermientos',
                    'problemas.tiempo',
                    DB::raw('problemas.nombre as problema'),
                    DB::raw('subareas.nombre as subarea'),
                    DB::raw('areas.nombre as area'),
                    DB::raw('entidades.nombre as entidad'),
                    DB::raw('pdsperfiles.pds_name as cliente'),
                    'orden_requermientos.solicitado',
                    'orden_requermientos.enproceso',
                    'orden_requermientos.finalizado',
                    DB::raw('entidades.nombre as entidad')
                )
                ->join('problemas', 'orden_requermientos.problema_id', 'problemas.id')
                ->join('subareas', 'problemas.subarea_id', 'subareas.idsubareas')
                ->join('areas', 'subareas.area_id', 'areas.idareas')
                ->join('entidades', 'entidades.identidad', 'areas.entidad_id')
                ->join('pdsperfiles', 'orden_requermientos.pds_id', 'pdsperfiles.id')
                ->leftJoin('orden_trabajos', 'orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
                ->where('entidades.nombre', 'Lotto Game')
                ->orWhere('entidades.nombre', 'RP3')
                ->whereNotNull('orden_requermientos.enproceso')
                ->where(function ($query) {
                    $query->whereNull('orden_requermientos.finalizado')
                        ->orWhereNotNull('orden_requermientos.finalizado');
                })
                ->get();

            $tbody = "";
            foreach ($ordenes as $orden) {
                $id = 'C-' . str_pad($orden->idorden_requermientos, 7, "0", STR_PAD_LEFT);

                $estado = 'Solicitado <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';

                if ($orden->enproceso != null) {
                    $estado = 'En proceso <span style="background-color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }
                if ($orden->finalizado != null) {
                    $estado = 'Finalizado <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                }

                $taux = new \DateTime(date('Y-m-d'));
                $taux->setTime($orden->tiempo, 0, 0);

                $tbody .= "<tr>
                        <th scope=\"row\"><a href=\"#\" onclick=\"modalAsignarOrdenDeTrabajo(" . $orden->idorden_requermientos . ", '" . $id . "', '" . $orden->entidad . "')\">" . $id . "</a></th>
                        <td>" . mb_strimwidth(strtoupper($orden->entidad), '0', '15', '...') . "</td>
                        <td>" . mb_strimwidth(strtoupper($orden->subarea), '0', '15', '...') . "</td>
                        <td>" . $orden->problema . "</td>
                        <td>" . $orden->cliente . "</td>
                        <td>" . $orden->solicitado . "</td>
                        <td>" . date_format($taux, 'H:i') . "</td>
                        <td>" . $estado . "</td>
                    </tr>";
            }
            return $tbody;
        }
    }

    public function verOrden(Request $request)
    {
        $orden = DB::table('orden_requermientos')
            ->select(
                'orden_requermientos.idorden_requermientos',
                'problemas.tiempo',
                DB::raw('problemas.nombre as problema'),
                DB::raw('subareas.nombre as subarea'),
                DB::raw('areas.nombre as area'),
                DB::raw('entidades.nombre as entidad'),
                DB::raw('pdsperfiles.pds_name as cliente'),
                DB::raw('orden_requermientos.comentario as rcomentario'),
                DB::raw('orden_requermientos.observa as robservacion'),
                'orden_requermientos.solicitado',
                'orden_requermientos.enproceso',
                'orden_requermientos.finalizado',
                'orden_trabajos.idorden_trabajos',
                'orden_trabajos.proveedor_id',
                'orden_trabajos.estado',
                'orden_trabajos.presupuesto',
                'orden_trabajos.garantia',
                'orden_trabajos.encargado',
                'orden_trabajos.extra',
                'orden_trabajos.comentario'
            )
            ->join('problemas', 'orden_requermientos.problema_id', 'problemas.id')
            ->join('subareas', 'problemas.subarea_id', 'subareas.idsubareas')
            ->join('areas', 'subareas.area_id', 'areas.idareas')
            ->join('entidades', 'entidades.identidad', 'areas.entidad_id')
            ->join('pdsperfiles', 'orden_requermientos.pds_id', 'pdsperfiles.id')
            ->leftJoin('orden_trabajos', 'orden_requermientos.idorden_requermientos', 'orden_trabajos.orden_requermiento_id')
            ->where('orden_requermientos.idorden_requermientos', $request->input('id'))
            ->get();
        return $orden;
    }

    public function asignarOrden(Request $request)
    {
        $ordenreq = Orden_Requerimiento::where('idorden_requermientos', $request->req_num_orden)->first();
        $ordenreq->observa = $request->req_observacion;
        $ordenreq->enproceso = Carbon::now();
        $ordenreq->save();

        $orden = new Orden_trabajo();
        $orden->orden_requermiento_id = $request->req_num_orden;
        $orden->proveedor_id = $request->ot_proveedor;
        $orden->estado = $request->ot_estado;
        $orden->presupuesto = $request->ot_presupuesto;
        $orden->garantia = $request->ot_garantia;
        $orden->encargado = $request->ot_encargado;
        $orden->extra = $request->ot_extra;
        $orden->comentario = $request->ot_comentario;
        $orden->save();

        if ($request->has('ot_ccotizacion')) {
            $cimagen = new Attachment();
            $cimagen->file = file_get_contents($request->file('ot_ccotizacion')->getRealPath());
            $cimagen->user_id = Auth::user()->id;
            $cimagen->save();

            $otcimage = new Otrabajo_attachment();
            $otcimage->orden_trabajos_id = $orden->idorden_trabajos;
            $otcimage->attachment_id = $cimagen->idattachments;
            $otcimage->tipo = 'C';
            $otcimage->save();
        }

        if ($request->has('ot_cgarantia')) {
            $cimagen = new Attachment();
            $cimagen->file = file_get_contents($request->file('ot_cgarantia')->getRealPath());
            $cimagen->user_id = Auth::user()->id;
            $cimagen->save();

            $otcimage = new Otrabajo_attachment();
            $otcimage->orden_trabajos_id = $orden->idorden_trabajos;
            $otcimage->attachment_id = $cimagen->idattachments;
            $otcimage->tipo = 'G';
            $otcimage->save();
        }

        return redirect('mantenimiento/problemas');
    }

    public function imagenesRequerimiento(Request $request)
    {
        $res = "";
        $imgs = (new Oreque_attachment())->where('orden_requermiento_id', $request->input('id'))->get();
        for ($i = 0; $i < count($imgs); $i++) {
            $active = '';
            if ($i == 0) {
                $active = 'active';
            }
            $res .= "<div class=\"carousel-item " . $active . "\"><img class=\"d-block w-100\" src=\"" . url('imagen/' . $imgs[$i]->attachment_id) . "\"></div>";
        }
        return response()->json(['images' => $res, 'count' => count($imgs)]);
    }

    public function imagenesTrabajo(Request $request)
    {
        $img = (new Otrabajo_attachment())->select('attachment_id')->where([['orden_trabajos_id', '=', $request->input('id')], ['tipo', '=', $request->tipo]])->first();
        return $img;
    }

    public function ordenes(Request $request)
    {
        $cat = (isset($request->cat) ? $request->cat : 'loteria');
        $proveedores = DB::table('proveedores')->orderBy('idproveedores', 'asc')->get();
        return view('vistas.pages.mantenimiento.ordenes')->with('cat', $cat)->with('proveedores', $proveedores);
    }

    public function proveedores()
    {
        return view('vistas.pages.mantenimiento.proveedores');
    }

    public function cargarProveedores(Request $request)
    {
        $proveedores = DB::table('proveedores')->orderBy('idproveedores', 'asc')->get();
        $tbody = "";
        foreach ($proveedores as $proveedor) {
            $calificacion = Calificacion::join('orden_trabajos', 'calificaciones.id_orden_trabajo', 'orden_trabajos.idorden_trabajos')->where('proveedor_id', $proveedor->idproveedores)->avg('calificacion');

            switch($calificacion){
                case 1:
                    $porcentaje = 0;
                    break;
                case 2:
                    $porcentaje = 25;
                    break;
                case 3:
                    $porcentaje = 50;
                    break;
                case 4:
                    $porcentaje = 75;
                    break;
                case 5:
                    $porcentaje = 100;
                    break;
            }
    
            $tbody .= "<tr>
                        <th scope=\"row\">" . strtoupper($proveedor->nombre) . "</th>
                        <td>" . strtoupper($proveedor->ruc_cedula) . "</td>
                        <td>" . strtoupper($proveedor->direccion) . "</td>
                        <td>" . strtoupper($proveedor->telefono) . "</td>
                        <td>" . strtoupper($proveedor->correo) . "</td>
                        <td><span class=\"col\">".$porcentaje."%</span><img style=\"width: 80px;height: 80px;\" src=\"".url('/img/cara')."$calificacion.jpg\"></td>
                    </tr>";
        }
        return $tbody;
    }

    public function perfil()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        $calificacion = Calificacion::where('id_user_calificado', $user->id)->avg('calificacion');
        return view('vistas.pages.mantenimiento.perfil')->with('user', $user)->with('calificacion', $calificacion);
    }

    public function finalizarOrdenDeRequerimiento(Request $request)
    {

        $orden = Orden_Requerimiento::find($request->input('id'));
        $orden->finalizado = Carbon::now();
        $orden->save();
    }

    public function calificar(Request $request)
    {
        $calificacion = new Calificacion();
        $calificacion->id_user_calificador = Auth::user()->id;
        $calificacion->id_orden_trabajo = $request->orden;
        $calificacion->calificacion = ($request->precio + $request->disponibilidad + $request->rapidez + $request->calidad + $request->garantia) / 5;
        $calificacion->save();

        return redirect('mantenimiento/ordenes')->with('cat', 'proveedores');
    }
}
