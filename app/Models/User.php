<?php

namespace App\Models;

use App\Models\Administration\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    /**
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
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
     * Checks if user is verified.
     *
     * @return boolean
     */
    public function isVerified(): bool
    {
        return $this->verified === 1;
    }
}
