<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
