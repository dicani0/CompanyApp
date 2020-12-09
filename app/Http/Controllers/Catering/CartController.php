<?php

namespace App\Http\Controllers\Catering;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catering\Dish;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasCart');
    }

    /**
     * Adds dish to cart.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id)
    {
        $dish = Dish::find($id);
        $cart = Auth::user()->getCart();
        $cartContainsDish = $cart->dishes->pluck('id')->contains($dish->id);
        if ($cartContainsDish) {
            $cart->dishes()->updateExistingPivot(
                $dish->id,
                [
                    'amount' => $cart->dishes->find($dish->id)->pivot->amount + 1,
                ]
            );
        } else {
            $cart->dishes()->attach(
                $dish->id,
                [
                    'amount' => 1,
                ]
            );
        }
    }

    public function deleteFromCart($id)
    {
        $cart = Auth::user()->getCart();
        $cart->dishes()->detach($id);
    }

    public function clearCart()
    {
        $cart = Auth::user()->getCart();
        $cart->dishes()->detach();
        flash('Cart cleared');
        return redirect()->back();
    }

    public function getCartPrice()
    {
        $cart = Auth::user()->getCart();
        return response()->json($cart->getPrice());
    }

    public function getCartItems()
    {
        $cart = Auth::user()->getCart()->load(['dishes']);
        return response()->json(array('data' => $cart));
    }
}
