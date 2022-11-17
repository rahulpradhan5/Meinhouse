<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Request;

class AdminLoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if(session()->get('admin-login-id')){
            if(session()->get('urlref')!= "NotFound")
            {
                return redirect(url(session()->get('urlref')));
            }
            else
            {
                return redirect(url('admin/dashboard'));
            }
       }
 
            return $next($request);
    }
}