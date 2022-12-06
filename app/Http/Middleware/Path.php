<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Path
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
        $id=session()->get("login_id");
        $path=$request->path();
        if((($path=="admin/login") || ($path=="register")) && ($id!=null)){
            return redirect()->route("dashboard");
        }else{
            return $next($request);
        }
        
    }
}
