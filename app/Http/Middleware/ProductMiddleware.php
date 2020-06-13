<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\SmGeneralSettings;
use App\Envato\Envato;
use GuzzleHttp\Client;
use App\User;
class ProductMiddleware
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


       $client = new Client();
        if (\Schema::hasTable('users')) {
            $value = SmGeneralSettings::first();
            $UserData = Envato::verifyPurchase($value);
            if (!empty($UserData['verify-purchase']['item_id']) && (User::$item == $UserData['verify-purchase']['item_id'])) {  
                Session::put('url', $request->path());
                \Session::flash("message-danger", "Ops! Purchase Code is not vaild. Please try again.");
                return redirect('verified-code');
            }
            return $next($request);
        }else{
            return redirect('install');
        }
        
        

    }
}
