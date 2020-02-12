<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
            if($user_type == 'M'){
                return redirect('problemas')->with('cat','loteria');
            }else{
                return redirect('agenda/crear-agenda');
            }
        }

        return $next($request);
    }
}
