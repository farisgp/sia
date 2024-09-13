<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Peran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $peran): Response
    {
        // if(Auth::check() && Auth::user()->role == 'peran'){
        // return $next($request);
        // }

        if(auth()->check()){
            $perans = explode('-', $peran);
            foreach ($perans as $group){
                if(auth()->user()->role == $group ){
                    return $next($request); 
                } 
            }
        }
        // return $next('/access-denied');
        return redirect('/access-denied');
    }
}
