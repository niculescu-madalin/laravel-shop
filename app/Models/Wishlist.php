<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistFactory> */
    use HasFactory;

    protected $guarded = [];

    public function products() {
        return $this->belongsToMany(Product::class, 'product_wishlist');
    }
}
