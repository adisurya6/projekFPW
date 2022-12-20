<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cekHome
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
        if (aldLogin()) {
            if (getAuthUser()->role == "user") {
                return redirect('/user/home');
            } else if (getAuthUser()->role == "company") {
                return redirect('/company/home');
            } else if (getAuthUser()->role == "owner") {
                return redirect('/owner');
            }
        } else {
            return $next($request);
        }
    }
}
