<?php

namespace App\Http\Controllers\Proveedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Calificacion;

class ProveedoresController extends Controller
{
    public function index()
    {
        return view('vistas.pages.admin.proveedores.proveedores');
    }

    public function mostrar()
    {
        $proveedores = DB::table('proveedores')->orderBy('idproveedores', 'asc')->where('nombre', '!=', 'Mantenimiento')->get();
        $tbody = "";
        foreach ($proveedores as $proveedor) {
            $calificacion = Calificacion::join('orden_trabajos', 'calificaciones.id_orden_trabajo', 'orden_trabajos.idorden_trabajos')->where('proveedor_id', $proveedor->idproveedores)->avg('calificacion');
            $porcentaje = 0;
            switch ($calificacion) {
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
                        <td><span class=\"col\">" . $porcentaje . "%</span><img style=\"width: 40px;height: 40px;\" src=\"" . url('/img/cara') . "$calificacion.jpg\"></td>
                    </tr>";
        }
        return $tbody;
    }

    public function guardar(Request $request)
    {
        //
    }
}
