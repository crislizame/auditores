<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Attachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Oreque_attachment;
use App\Orden_Requerimiento;
use App\Orden_trabajo;
use App\Otrabajo_attachment;
use App\User;

class MantenimientoController extends Controller
{
    public function problemas(Request $request)
    {
        $cat = (isset($request->cat) ? $request->cat : 'loteria');
        return view('vistas.pages.mantenimiento.problemas')->with('cat', $cat);
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
            $id = 'C-' . str_pad($orden->idorden_requermientos, 7, "0", STR_PAD_LEFT);

            $estado = null;
            if ($orden->estado_orden != null) {
                $estado = mb_strimwidth(strtoupper($orden->estado_orden), '0', '15', '...');
                switch ($estado) {
                    case 'S':
                        $estado = 'Solicitado <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        break;
                    case 'E':
                        $estado = 'En proceso <span style="background-color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        break;
                    case 'F':
                        $estado .= 'Finalizado <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
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
                        <th scope=\"row\"><a href=\"#\" onclick=\"modalAsignarOrdenDeTrabajo(" . $orden->idorden_requermientos . ", '" . $id . "')\">" . $id . "</a></th>
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

    public function verOrden(Request $request)
    {
        $orden = DB::table('orden_requermientos')
            ->select(
                'orden_requermientos.idorden_requermientos',
                DB::raw('areas.name as area'),
                DB::raw('subareas.name as subarea'),
                'orden_requermientos.problema',
                DB::raw('pdsperfiles.pds_name as cliente'),
                DB::raw('orden_requermientos.finicio as rfinicio'),
                DB::raw('orden_requermientos.ffin as rffin'),
                DB::raw('orden_requermientos.comentario as rcomentario'),
                DB::raw('orden_requermientos.observa as robservacion'),
                'orden_trabajos.idorden_trabajos',
                'orden_trabajos.proveedor_id',
                'orden_trabajos.estado',
                'orden_trabajos.finicio',
                'orden_trabajos.ffin',
                'orden_trabajos.presupuesto',
                'orden_trabajos.garantia',
                'orden_trabajos.encargado',
                'orden_trabajos.tresolver',
                'orden_trabajos.extra',
                'orden_trabajos.comentario',
                'orden_trabajos.estado_orden'
            )
            ->join('areas', 'orden_requermientos.area_id', 'areas.idareas')
            ->join('subareas', 'orden_requermientos.subarea_id', 'subareas.idsubareas')
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
        $ordenreq->save();

        $orden = new Orden_trabajo();
        $orden->orden_requermiento_id = $request->req_num_orden;
        $orden->proveedor_id = $request->ot_proveedor;
        $orden->estado = $request->ot_estado;
        $orden->presupuesto = $request->ot_presupuesto;
        $orden->garantia = $request->ot_garantia;
        $orden->encargado = $request->ot_encargado;
        $orden->tresolver = $request->ot_tiempo;
        $orden->extra = $request->ot_extra;
        $orden->comentario = $request->ot_comentario;
        $orden->save();

        if ($request->has('ot_ccotizacion')) {
            $cimagen = new Attachment();
            $cimagen->file = base64_decode(file_get_contents($request->file('ot_ccotizacion')));
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
            $cimagen->file = base64_decode(file_get_contents($request->file('ot_cgarantia')));
            $cimagen->user_id = Auth::user()->id;
            $cimagen->save();
            
            $otcimage = new Otrabajo_attachment();
            $otcimage->orden_trabajos_id = $orden->idorden_trabajos;
            $otcimage->attachment_id = $cimagen->idattachments;
            $otcimage->tipo = 'G';
            $otcimage->save();
        }

        $cat = (isset($request->cat) ? $request->cat : 'loteria');
        return view('vistas.pages.mantenimiento.problemas')->with('cat', $cat);
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
        $img = (new Otrabajo_attachment())->select('attachment_id')->where([['orden_trabajos_id', '=', $request->input('id')], ['tipo', '=', 'C']])->first();
        return $img;
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
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        return view('vistas.pages.mantenimiento.perfil')->with('user', $user);
    }
}
