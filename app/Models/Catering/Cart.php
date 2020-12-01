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

    public function getDishPrice($id): int
    {
        return $this->dishes()->find($id)->price * $this->dishes->find($id)->pivot->amount;
    }

    public function getPrice(): int
    {
        $price = 0;
        foreach ($this->dishes as $dish) {
            $price += $dish->price * $this->dishes->find($dish->id)->pivot->amount;
        }
        return $price;
    }
}
