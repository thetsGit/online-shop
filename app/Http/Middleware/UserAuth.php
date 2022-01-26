<?php

namespace App\Http\Middleware;

use App\Models\ProductCart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserAuth
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
        if(!auth()->guard('web')->check()){
            return redirect("/signin");
         }
        if(auth()->guard("web")->user()->role !== "user"){
            return redirect("/signin");
        }
        return $next($request);
    }
}
