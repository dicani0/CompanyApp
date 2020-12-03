<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use App\Models\Catering\Cart;
use App\Models\Catering\Dish;
use App\Models\Catering\Order;
use App\Models\Catering\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cart $cart)
    {
        $dishes = $cart->dishes->filter(function (Dish $dish) {
            return !$dish->trashed();
        });
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'cart_id' => $cart->id,
            'order_state_id' => 1,
            'message' => ''
        ]);

        $dishes->each(function (Dish $dish) use ($order) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $dish->id,
                'order_item_state_id' => 1,
                'amount' => $dish->pivot->amount,
                'price' => $dish->price
            ]);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catering\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catering\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catering\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catering\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
