<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Calificacion;
use App\Mantenimiento_user;
use App\Proveedor;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        return view('vistas.pages.admin.perfil.perfil')->with('user', $user);
    }

    public function modificar(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->nombre;
        $user->email = $request->correo;
        $user->password = Hash::make($request->clave);

        if (!empty($request->profileImg)) {
            $profileImg = 'perfiles/' . time() . "." . $request->file('profileImg')->clientExtension();
            Storage::disk('local')->put($profileImg, file_get_contents($request->profileImg));
            $user->avatar = $profileImg;
        }
        $user->save();

        $flight = Mantenimiento_user::firstOrCreate(
            ['user_id' => $user->id],
            ['cedula' => $request->cedula, 'direccion' => $request->direccion]
        );

        return redirect('perfil');
    }

    public function getImage($type, $image)
    {
        return Storage::disk('local')->get($type . "/" . $image);
    }
}
