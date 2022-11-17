<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use App\Models\ProDetail;


class ProffCheck
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
        if (!Auth::check()) {
            
            return redirect('pro-login');

        }else{

            if(Auth::user()->role_id == 3 && auth::user()->is_listed == 1){
                
                if(Auth::user()->status == 0){
                
                    Auth::logout();
                    Session::flush();
                    return redirect('pro-login');
                
                }
                
                $payment = ProDetail::where('pro_id',Auth::user()->id)->first();
               
                if(Auth::user()->is_payment == 0){
                    
                    return redirect('pro-payment');
                }
                
                if(Auth::user()->state == 0){
                    
                    return redirect('pro-approval');
                }
                
                
                return $next($request);
                
            }else{

                return redirect()->route('pro-onboarding');
            }
            
        }
    
    }
}
?>