<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareCartQty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cartItems = collect();

        if (auth()->check()) {
            $cart = Cart::where('customer_id', auth()->user()->id)
                ->where('status', 'active')
                ->with('items')
                ->first();
        } else {
            $token = $request->cookie('cart_token');

            $cart = $token
                ? Cart::where('token', $token)
                    ->where('status', 'active')
                    ->with('items')
                    ->first()
                : null;
        }

        if ($cart) {
            $cartItems = $cart->items;
        }

        view()->share('cartItems', $cartItems);

        return $next($request);
    }
}
