<?php

namespace App\Models\Catering;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class, 'cart_dish')->withTimestamps()->withPivot('amount');
    }

    public function getDishPrice($id): float
    {
        return $this->dishes()->find($id)->price * $this->dishes->find($id)->pivot->amount;
    }

    public function getPrice(): float
    {
        return $this->dishes->reduce(function ($price, Dish $dish) {
            return $price + $dish->price * $dish->pivot->amount;
        }, 0);
    }

    public function closeCart()
    {
        $this->update([
            'ordered' => 1
        ]);
    }
}
