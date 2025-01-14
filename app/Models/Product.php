<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected  $guarded = [];

    protected $fillable = [
        'wishlist_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function wishlists() {
        return $this->belongsToMany(Wishlist::class, 'product_wishlist');
    }
}
