<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function show() {
        return view('wishlist.show');
    }

    public function addProduct(Request $request) {
        $wishlist = $request->user()->wishlist;

        $productId = $request->product_id;
        if (!$productId) {
            return redirect()->back()->withErrors(['product_id' => 'Product ID is required.']);
        }

        $wishlist->products()->syncWithoutDetaching($productId);
       
        return redirect()->route('wishlist.show')->with('success', 'Product added to wishlist!');
    }


    public function removeProduct(Request $request) {
        $wishlist = $request->user()->wishlist;
        $productId = $request->product_id;
        
        if (!$productId) {
            return redirect()->back()->withErrors(['product_id' => 'Product ID is required.']);
        }

        // Detach the product from the wishlist
        $wishlist->products()->detach($productId);

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}
