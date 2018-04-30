<?php

namespace Nepbaycloudservices\Backendcp\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class NcsAdmin
{
    

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next    
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {

        /*if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect('/backend/login');
        } else {
            return redirect('/');           
        }*/

       /* if(!empty(auth()->guard('admin')->id())){
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect('/backend/login');
        } else {
            return redirect('/');           
        }*/


        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role== 1) {
            return $next($request);
        }

        if (!Auth::guard('admin')->check()) {
            return redirect('/backend/login');
        } else {
            return redirect('/');           
        }



    }

}
