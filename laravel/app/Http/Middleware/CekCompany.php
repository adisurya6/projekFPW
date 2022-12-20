<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(aldLogin() == false){
            abort(403);
        }
        if(getAuthUser()->role == 'company'){
            return $next($request);
        }
        abort(403);
    }
}
