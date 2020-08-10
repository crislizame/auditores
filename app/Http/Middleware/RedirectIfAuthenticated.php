<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user_type = Auth::user()->user_type;
            if ($user_type == 'M') {
                return Redirect::to('mantenimiento/problemas')->with('cat', 'loteria');
            } else if ($user_type == 'S') {
                return Redirect::to('soporte/problemas')->with('cat', 'loteria');
            } else if ($user_type == 'R') {
                return Redirect::to('rp3/problemas')->with('cat', 'loteria');
            } else if ($user_type == 'L') {
                return Redirect::to('lottogame/problemas')->with('cat', 'loteria');
            } else if ($user_type == 'P') {
                return Redirect::to('permisos/permisos');
            } else if ($user_type == "A") {
                return Redirect::to('agenda/crear-agenda');
            }
        }
        return $next($request);
    }
}
