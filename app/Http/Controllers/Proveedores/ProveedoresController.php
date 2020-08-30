<?php

namespace App\Http\Controllers\Proveedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Calificacion;
use App\Proveedor;

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
            $calificacion = ceil(Calificacion::join('orden_trabajos', 'calificaciones.id_orden_trabajo', 'orden_trabajos.idorden_trabajos')->where('proveedor_id', $proveedor->idproveedores)->avg('calificacion'));
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
                        <td><span class=\"col\">" . $porcentaje . "%</span></td>
                        <td><button class=\"btn btn-sm btn-warning\" onclick=\"verProveedor($proveedor->idproveedores)\"><i class=\"fa fa-lg fa-edit\"></i></button>
                        <button class=\"btn btn-sm btn-danger\" onclick=\"borrarProveedor($proveedor->idproveedores)\"><i class=\"fa fa-lg fa-minus\"></i></button></td>
                    </tr>";
        }
        return $tbody;
    }

    public function guardar(Request $request)
    {
        if(Proveedor::where('ruc_cedula', $request->cedula)->exists()==false){
            $proveedor = new Proveedor();
            $proveedor->nombre = $request->nombre;
            $proveedor->ruc_cedula = $request->cedula;
            $proveedor->telefono = $request->telefono;
            $proveedor->correo = $request->correo;
            $proveedor->direccion = $request->direccion;
            $proveedor->banco = $request->cuentabanco;
            $proveedor->cuenta = $request->cuentanumero;
            $proveedor->tipodecuenta = $request->cuentatipo;
            $proveedor->save();

            return response()->json(['status' => 'Ok']);
        }else{
            return response()->json(['exists'=>true]);
        }
    }

    public function ver(Request $request)
    {
        return Proveedor::find($request->id);
    }

    public function modificar(Request $request)
    {
        $proveedor = Proveedor::find($request->id_edit);
        $proveedor->nombre = $request->nombre_edit;
        $proveedor->ruc_cedula = $request->cedula_edit;
        $proveedor->telefono = $request->telefono_edit;
        $proveedor->correo = $request->correo_edit;
        $proveedor->direccion = $request->direccion_edit;
        $proveedor->banco = $request->cuentabanco_edit;
        $proveedor->cuenta = $request->cuentanumero_edit;
        $proveedor->tipodecuenta = $request->cuentatipo_edit;
        $proveedor->save();

        return response()->json(['status' => 'Ok']);
    }

    public function eliminarComisionistas(){
        $id = \request('id');
        (new Proveedor())->where('id',$id)->delete();
        return md5(1);
    }
}