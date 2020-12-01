<?php

namespace App\Http\Controllers\Catering;

use App\Models\Catering\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catering\Dish;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /**
     * Adds dish to cart.
     *
     * @param  \App\Models\Catering\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Dish $dish)
    {
        $cart = Auth::user()->getCart();
        $cartContainsDish = $cart->dishes->pluck('id')->contains($dish->id);
        if ($cartContainsDish) {
            $cart->dishes()->updateExistingPivot($dish->id, [
                'amount' => $cart->dishes->find($dish->id)->pivot->amount + 1,
            ]);
        } else {
            $cart->dishes()->attach(
                $dish->id,
                [
                    'amount' => 1,
                ]
            );
        }

        flash($dish->name . ' added to cart');
        return redirect()->back();
    }

    public function clearCart()
    {
        $cart = Auth::user()->getCart();
        $cart->dishes()->detach();
        flash('Cart cleared');
        return redirect()->back();
    }
}
