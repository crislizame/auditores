<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }else{
            if (Auth::guard($guard)->check()) {
                $user_type = Auth::user()->user_type;
                if($user_type == 'M'){
                    return redirect('problemas')->with('cat','loteria');
                }else{
                    return redirect('agenda/crear-agenda');
                }
            }
        }
    }
}
