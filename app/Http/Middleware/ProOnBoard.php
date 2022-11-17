<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ProOnBoard
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
        if(!(Auth::check())){
        
             return redirect('pro-login');

        }else{

            if(Auth::user()->role_id == 3 && auth::user()->is_listed == 0){

                return $next($request);   
            }else{
                
                return redirect()->route('proff-dashboard');
            }
        }
    }
}
