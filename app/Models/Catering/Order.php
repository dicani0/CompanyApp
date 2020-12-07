<?php

namespace App\Models\Catering;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function getPrice()
    {
        $price = null;
        $this->orderItems->each(function (OrderItem $item) use (&$price) {
            $price += $item->price * $item->amount;
        });
        return $price;
    }
}
