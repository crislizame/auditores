<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'agenda/crear-agenda';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function home()
    {
        return redirect()->route('login');
    }
    public function login(Request $request)
    {
        $credentials = $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = new User();

        $du = $user::where(['email' => $credentials['email']])->get();
        $duc = $user::where(['email' => $credentials['email']])->count();
        if ($duc == 0) {
            return back()
                ->withErrors(['email' => '¡Correo ingresado no se encuentra registrado!'])
                ->withInput(request(['email']));
        }

        if (!empty($du)) {
            if (Hash::check($credentials['password'], $du[0]->password)) {
                if (Auth::attempt($credentials)) {
                    $user_type = Auth::user()->user_type;
                    if ($user_type == 'M') {
                        return redirect('mantenimiento/problemas')->with('cat', 'loteria');
                    } else if ($user_type == 'S') {
                        return redirect('soporte/problemas')->with('cat', 'loteria');
                    } else if ($user_type == 'R') {
                        return redirect('rp3/problemas')->with('cat', 'loteria');
                    } else if ($user_type == 'L') {
                        return redirect('lottogame/problemas')->with('cat', 'loteria');
                    } else if ($user_type == 'P') {
                        return redirect('permisos/permisos');
                    } else if ($user_type == "A") {
                        return redirect('crear-agenda');
                    } else if ($user_type == "G") {
                        return redirect('superadmin/usuarios');
                    }
                }
            } else {
                return back()
                    ->withErrors(['email' => '¡Contraseña incorrecta!'])
                    ->withInput(request(['email']));
            }
        }
    }
}
