<?php

namespace App\Http\Middleware;

use App\Models\ProductCart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareData
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
        if(auth()->check()){
            $productsInCart = ProductCart::where("user_id",auth()->user()->id)->get();
            $cart_count = 0;
            foreach ($productsInCart as $product) {
                $cart_count += $product->quantity;
            }
            View::share('cart_count',$cart_count);
        }

        return $next($request);
    }
}
