<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index() {
        # $wishlist = Auth::user()->wishlist->products;
        # return view('wishlist.index', compact('wishlist'));
    }

    public function show(Wishlist $wishlist) {

        return view('wishlist.show', ['wishlist' => $wishlist]);
    }

    public function add(Request $request) {
        $wishlist = $request->user()->wishlist;

        $productId = $request->product_id;
        if (!$productId) {
            return redirect()->back()->withErrors(['product_id' => 'Product ID is required.']);
        }

        $wishlist->products()->attach($productId);

       
        return view('wishlist.show')->with('success', 'Product added to wishlist!');

    }


    public function remove(Request $request)
    {
        $wishlist =  $request->user()->wishlist;
        $product = Product::findOrFail($request->product_id);

        if ($wishlist) {
            $wishlist->products()->detach($product);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}
