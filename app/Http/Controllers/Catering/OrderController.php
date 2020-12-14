<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use App\Models\Catering\Cart;
use App\Models\Catering\Dish;
use App\Models\Catering\Order;
use App\Models\Catering\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasCart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cart $cart)
    {
        if (Auth::user()->hasUnfinishedOrder()) {
            $order = Auth::user()->getUnfinishedOrder();
            $order->orderItems()->delete();
        } else {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'cart_id' => $cart->id,
                'order_state_id' => 1,
                'message' => '',
            ]);
        }

        $dishes = $cart->dishes->filter(function (Dish $dish) {
            return !$dish->trashed();
        });

        $dishes->each(function (Dish $dish) use ($order) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $dish->id,
                'order_item_state_id' => 1,
                'amount' => $dish->pivot->amount,
                'price' => $dish->price
            ]);
        });
        return view('catering.orders.summary', ['order' => $order]);
    }

    public function finalize(Order $order)
    {
        $order->update([
            'order_state_id' => 2
        ]);
        $order->cart->update([
            'ordered' => 1
        ]);

        if (Auth::user()->funding->amount < $order->getPrice()) {
            flash('Not enough credits')->warning();
            return redirect()->back();
        }

        Auth::user()->funding->decrement('amount', $order->getPrice());

        flash('Order sent');
        return view('catering.orders.finalize', ['order' => $order]);
    }

    public function getUserOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        // $orderstmp = $orders->pluck('orderItems')->flatten()->map(function (OrderItem $orderItem) {
        //     return $orderItem->amount * $orderItem->
        // });
        return view('catering.orders.history', ['orders' => $orders]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catering\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->cart->dishes()->detach();
        $order->orderItems()->delete();
        $order->delete();
        $order->cart()->delete();
        flash('Order #' . $order->id . ' deleted');
        return redirect()->route('catering');
    }

    public function getOrder($id)
    {
        $order = Order::find($id)->load(['orderItems.dish']);
        return response()->json(array('data' => $order));
    }
}
