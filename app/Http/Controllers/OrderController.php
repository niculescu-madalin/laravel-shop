<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        // Fetch all orders for the authenticated user
        $orders = $request->user()->orders()->orderBy('ordered_at', 'desc')->get();

        // Return the view with the list of orders
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Find the order with its products or fail if not found
        $order = Order::with('products')->findOrFail($id);

        // Ensure the authenticated user owns the order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Return the view with the order details
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        // Validate the request
        $request->validate([
            'adresa_livrare' => 'required|string|max:255',
        ]);

        // Fetch the cart and its products
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        // Calculate total price
        $totalPrice = $cart->products->sum(function ($product) {
            return $product->pivot->quantity * $product->price;
        });

        $delivery_adress = $request->input('adresa_livrare');

        // Create the order
        $order = $user->orders()->create([
            'total_price' => $totalPrice,
            'adresa_livrare' => $delivery_adress, // Pass the address here
            'status' => 'pending',
            'ordered_at' => now(),
        ]);

        // Attach the products to the order
        foreach ($cart->products as $product) {
            $order->products()->attach($product->id, [
                'quantity' => $product->pivot->quantity,
                'price' => $product->price,
            ]);
        }

        // Clear the cart
        $cart->products()->detach();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

}
