<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

class AuthCustomers
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if (false == Auth::guard('customer')->check()) {
            return redirect()->route('customer.login'); //redirect User to login page
        }

        return $next($request);
    }
}
