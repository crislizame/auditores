<?php

namespace App\Http\Controllers\superadmin;

use App\Entidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mantenimiento_user;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;

class SuperAdminController extends Controller
{
    public function index(){
        return view('vistas.pages.superadmin.index');
    }

public function list(Request $request){
    $users = User::where('user_type', '!=', 'G')->get();

        $tbody = "";
        foreach ($users as $user) {
            
$type=null;
switch($user->user_type){
    case 'A':
        $type = 'Administrador';
    break;
    case 'M':
        $type = 'Mantenimiento';
    break;
    case 'S':
        $type = 'Soporte';
    break;
    case 'R':
        $type = 'RP3';
    break;
    case 'L':
        $type = 'Lotto Game';
    break;
    case 'P':
        $type = 'Permisos';
    break;
}
            $tbody .= "<tr>
                        <th scope=\"row\">" . strtoupper($user->name) . "</th>
                        <td>" . strtoupper($user->email) . "</td>
                        <td>" . strtoupper($type) . "</td>
                        <td><button class=\"btn btn-sm btn-warning\" onclick=\"verUsuario($user->id)\"><i class=\"fa fa-lg fa-edit\"></i></button>
                        <button class=\"btn btn-sm btn-danger\" onclick=\"borrarUsuario($user->id)\"><i class=\"fa fa-lg fa-minus\"></i></button></td>
                    </tr>";
        }
        return $tbody;
}

    public function store(Request $request){

        $role = $request->cuentatipo == 'A' ? Role::where('name', 'admin')->first()->id : Role::where('name', 'user')->first()->id;

        $entidad = null;
        switch($request->cuentatipo){
            case 'M':
                $entidad = Entidad::where('nombre','Mantenimiento')->first()->identidad;
            break;
            case 'S':
                $entidad = Entidad::where('nombre','Soporte')->first()->identidad;
            break;
            case 'R':
                $entidad = Entidad::where('nombre','RP3')->first()->identidad;
            break;
            case 'L':
                $entidad = Entidad::where('nombre','Lotto Game')->first()->identidad;
            break;
        }

        $user = User::create([
            'role_id' => $role,
            'name' => $request->nombre,
            'email' => $request->correo,
            'avatar' => 'users/default.png',
            'user_type' => $request->cuentatipo,
            'password' => Hash::make(Str::random(10)),
            'entidad_id' => $entidad
        ]);

        $m_user = Mantenimiento_user::create([
            'user_id' => $user->id,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
            'telefono' => $request->telefono,
            'cedula' => $request->cedula
        ]);
    }

    public function show($id){
return User::select(
    'users.name',
    'users.email',
    'users.user_type',
    'mantenimiento_users.cedula',
    'mantenimiento_users.direccion',
    'mantenimiento_users.celular',
    'mantenimiento_users.telefono'
)
->where('id', $id)
->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')
->first();
    }

    public function update(Request $request){

        $role = $request->cuentatipo_edit == 'A' ? Role::where('name', 'admin')->first()->id : Role::where('name', 'user')->first()->id;
        
        $entidad = null;
        switch($request->cuentatipo_edit){
            case 'M':
                $entidad = Entidad::where('nombre','Mantenimiento')->first()->identidad;
            break;
            case 'S':
                $entidad = Entidad::where('nombre','Soporte')->first()->identidad;
            break;
            case 'R':
                $entidad = Entidad::where('nombre','RP3')->first()->identidad;
            break;
            case 'L':
                $entidad = Entidad::where('nombre','Lotto Game')->first()->identidad;
            break;
        }

$user = User::find($request->id);
$user->role_id = $role;
$user->name = $request->nombre_edit;
$user->email = $request->correo_edit;
//$user->password = Hash::make($request->pass);
$user->user_type = $request->cuentatipo_edit;
$user->entidad_id = $entidad;
$user->save();

if($m_user = Mantenimiento_user::where('user_id', $user->id)->first()){
$m_user->user_id = $user->id;
            $m_user->direccion = $request->direccion_edit;
            $m_user->celular = $request->celular_edit;
            $m_user->telefono = $request->telefono_edit;
            $m_user->cedula = $request->cedula_edit;
            $m_user->save();
}else{
    $m_user = new Mantenimiento_user();
    $m_user->user_id = $user->id;
            $m_user->direccion = $request->direccion_edit;
            $m_user->celular = $request->celular_edit;
            $m_user->telefono = $request->telefono_edit;
            $m_user->cedula = $request->cedula_edit;
            $m_user->save();
}
    }

    public function destroy($id){
        $user = User::find($id);
if($m_user = Mantenimiento_user::where('user_id', $user->id)->first()){
    $m_user->delete();
}
$user->delete();
}
}
