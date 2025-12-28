<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Pet;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index()
    {
        $cart = null;
        if (auth()->check()) {
            $cart = Cart::where('customer_id', auth()->id())
                ->where('status', 'active')
                ->with('items.itemable')
                ->first();
        } else {
            $token = request()->cookie('cart_token');

            if($token) {
                $cart = Cart::where('token', $token)
                    ->where('status', 'active')
                    ->with('items.itemable')
                    ->first();
            }
        }

        if (!$cart) {
            return view('customer.carts', [
                'items' => collect([]),
            ]);
        }

        $items = $cart->items;

        return view('customer.carts', compact('items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'pet_id' => 'nullable|exists:pets,id',
            'qty' => 'nullable|integer|min:1',
        ]);

        $qty = $request->qty ?? 1;

        DB::transaction(function () use ($request, $qty, &$cart) {

            if ($request->user()) {
                // Member cart
                $cart = Cart::firstOrCreate([
                    'customer_id' => $request->user()->id,
                    'status' => 'active',
                ]);
            } else {
                // Guest cart
                $token = $request->cookie('cart_token') ?? Str::uuid()->toString();

                $cart = Cart::firstOrCreate([
                    'token' => $token,
                    'status' => 'active',
                ]);

                cookie()->queue('cart_token', $token, 60 * 24 * 30);
            }

            if ($request->product_id) {
                $model = Product::findOrFail($request->product_id);
                $itemableType = Product::class;
            } else {
                $model = Pet::findOrFail($request->pet_id);
                $itemableType = Pet::class;
            }

            $cart->items()->updateOrCreate(
                [
                    'itemable_id' => $model->id,
                    'itemable_type' => $itemableType,
                ],
                [
                    'qty' => $qty
                ]
            );
        });

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->check()) {
            $cart = Cart::where('customer_id', auth()->id())
                ->where('status', 'active')
                ->firstOrFail();
        } else {
            $token = request()->cookie('cart_token');

            abort_if(!$token, 404);

            $cart = Cart::where('token', $token)
                ->where('status', 'active')
                ->firstOrFail();
        }

        $item = $cart->items()->where('id', $id)->firstOrFail();

        $item->delete();

        return redirect()->back();
    }
}
