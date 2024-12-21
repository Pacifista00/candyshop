<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'stock', 'is_active', 'image_path'
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
