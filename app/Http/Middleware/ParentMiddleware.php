<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class ParentMiddleware
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

       session_start();
        $role_id = Session::get('role_id');

        if ($role_id == 3) {
            return $next($request);
        }elseif($role_id != ""){
            return redirect('parent-dashboard');
        } else {
            return redirect('login');
        }
    }
}
