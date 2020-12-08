<?php

namespace App\Http\Middleware;

use App\Models\Catering\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class hasCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $cart = $user->carts->last();
        if (!$cart || $cart->ordered) {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
        }
        $user->load('carts');
        return $next($request);
    }
}
