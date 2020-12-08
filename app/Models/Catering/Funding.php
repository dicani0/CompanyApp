<?php

namespace App\Models\Catering;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'default_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function add($amount)
    {
        $this->update([
            'amount' => $this->amount + $amount
        ]);
    }
}
