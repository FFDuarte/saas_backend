<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
    return $next($request)
    //Acrescente as 3 linhas abaixo
    ->header('Access-Control-Allow-Origin', "*")
    ->header('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS")
    ->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");
    }
}
