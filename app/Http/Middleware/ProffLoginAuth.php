<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;

class ProffLoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){

            if(auth::user()->role_id == 3){

                return redirect('pro/dashboard');

            }

            if(auth::user()->role_id == 2){

                return Redirect('dashboard');

            }

            if(auth::user()->role_id == 1){

                return Redirect('admin/dashboard');
            }
        }

        return $next($request);
    }
}
