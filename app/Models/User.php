<?php

namespace App\Models;

use App\Models\Administration\Role;
use App\Models\Catering\Cart;
use App\Models\Catering\Funding;
use App\Models\Catering\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')->withTimestamps();
    }

    public function funding()
    {
        return $this->hasOne(Funding::class);
    }

    /**
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Checks if user is verified.
     *
     * @return boolean
     */
    public function isVerified(): bool
    {
        return $this->verified === 1;
    }

    /**
     * Checks if user has specified role.
     * 
     * @param string $name
     * @return boolean
     */
    public function hasRole(string $name): bool
    {
        return $this->roles()->pluck('name')->contains($name);
    }



    /**
     * @return HasMany
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        $cart = $this->carts->last();

        if (!$cart || $cart->ordered) {
            $cart = new Cart;
            $cart->user_id = $this->id;
            $cart->save();
        }

        return $cart;
    }

    public function hasUnfinishedOrder()
    {
        $order = $this->orders->filter(function (Order $order) {
            return $order->order_state_id === 1;
        });

        return $order->count() === 1;
    }

    public function getUnfinishedOrder(): Order
    {
        $order = $this->orders->filter(function (Order $order) {
            return $order->order_state_id === 1;
        })->first();

        return $order;
    }
}
