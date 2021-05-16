<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (auth()->check()) {
            if (!$request->user()->isAdmin()) {
                abort(403, 'You are not authorized');
            }
        }
        return $next($request);


        //Menyra e Edwinit
//        if (Auth::check()){
//            if(Auth::user()->isAdmin()){
//                return $next($request);
//            }
//        }
//        return redirect('/');
    }
}
