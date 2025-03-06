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
        'name',
        'price',
        'description',
        'specifications',
        'amount',
        'discount',
        'category_id',
        'image_path',
        'specs_file',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function wishlists() {
        return $this->belongsToMany(Wishlist::class, 'product_wishlist');
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

}
