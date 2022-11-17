<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;
class WebLoginAuth
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

            if(auth::user()->role_id == 2){

                return Redirect::intended('dashboard');

            }elseif(auth::user()->role_id == 3){

                return Redirect('pro/dashboard');
                
            }else{

                return Redirect('admin/dashboard');
            }
        }

        return $next($request);
    }
}
