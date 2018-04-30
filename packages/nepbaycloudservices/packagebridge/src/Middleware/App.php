<?php

namespace Nepbaycloudservices\PackageBridge\Middleware;

use Closure;
use Session;

class App
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

        //dump(Session::get('locale'));
        if(\Session::has('locale'))
        {
             app()->setLocale(\Session::get('locale'));
        }   

        return $next($request);
    }
}
