<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show() {
        return view('cart.show');
    }

    public function addProduct(Request $request) {
        $cart = $request->user()->cart;

        $productId = $request->product_id;
        $quantity = $request->input('quantity', 1);

        if (!$productId) {
            return redirect()->back()->withErrors(['product_id' => 'Product ID is required.']);
        }

        $cart->products()->syncWithoutDetaching([
            $productId => ['quantity' => $quantity]
        ]);
       
        return redirect()->route('cart.show')->with('success', 'Product added to wishlist!');
    }


    public function removeProduct(Request $request) {
        $cart = $request->user()->cart;
        $productId = $request->product_id;
        
        if (!$productId) {
            return redirect()->back()->withErrors(['product_id' => 'Product ID is required.']);
        }

        // Detach the product from the wishlist
        $cart->products()->detach($productId);

        return redirect()->route('cart.show')->with('success', 'Product removed from wishlist!');
    }

}
