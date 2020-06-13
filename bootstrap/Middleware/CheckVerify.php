<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Envato\Envato;
use HP;

class CheckVerify
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

        $o = Envato::verifyPurchase(HP::set()->purchasecode);
        //isset($o['item']['id']) && $o['item']['id'] == "22885977 21834231"
        if(isset($o['item']) && $o['item']['id'] == "22885977" && $o['buyer'] == HP::set()->envatouser){
            return $next($request);
        }else{
            return redirect('verify');
        }

     }

}
