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

        $existingProduct = $cart->products()->where('product_id', $productId)->first();


        if ($existingProduct) {
            // If the product exists, update the quantity
            $newQuantity = $existingProduct->pivot->quantity + $quantity;
            $cart->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
        } else {
            // If the product is not in the cart, add it
            $cart->products()->syncWithoutDetaching([
                $productId => ['quantity' => $quantity]
            ]);
        }
       
        return redirect()->route('cart.show')->with('success', 'Product added to cart!');
    
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

    public function updateQuantity(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart;
        
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        
        if ($quantity <= 0) {
            // Remove the product if quantity is zero or less
            $cart->products()->detach($productId);
        } else {
            // Update the product quantity
            $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
        }
    
        return redirect()->route('cart.show')->with('success', 'Cart updated!');
    }


}
