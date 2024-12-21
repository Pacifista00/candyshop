<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'name',
        'email',
        'amount',
        'total_price',
        'status',
        'snap_token',
        'candy_id',
    ];

    public function candy()
    {
        return $this->hasMany(Candy::class);
    }
}
