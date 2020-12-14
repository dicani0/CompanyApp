<?php

namespace App\Models\Catering;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function getCostAttribute()
    {
        return $this->amount * $this->price;
    }
}
