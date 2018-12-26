<?php

namespace App\Http\Middleware;

use Closure;
use Session;


class UserAccess
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
        if(empty(Session::has('userSession'))){
            return redirect( route('Login_register'));
        }
        return $next($request);
    }
}
