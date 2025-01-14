@auth
<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Cart
                @php
                    $totalSum = 0;
                @endphp
            </h2>
        </x-slot>
        @if (Auth::user()->cart->products->isEmpty())
            <div class="lg:px-40 py-4 sm:px-6">
                <span> Your cart is empty. </span>
            </div>
        @else
            <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
            @foreach (Auth::user()->cart->products as $product)
            @php
                $totalSum += $product->pivot->quantity * $product->price
            @endphp
            <li class="sm:px-8 lg:px-40 py-4 border-b border-gray-200 items-center sm:flex sm:justify-between flex gap-x-3">
                <div class="font-semibold text-l text-gray-800 leading-tight grow">
                    {{ $product->pivot->quantity }} x {{ $product->name }} 
                </div>
                {{ $product->pivot->quantity * $product->price }} lei

                <form method="POST" action="{{ route('cart.updateQuantity') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1">
                    <button type="submit" class="btn btn-primary btn-sm">Update Quantity</button>
                </form>

                <!-- Remove button -->
                <form method="POST" action="{{ route('cart.removeProduct') }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </li>
            @endforeach

            <li class="bg-blue-100 font-semibold text-lg sm:px-8 lg:px-40 py-4 border-b border-gray-200 items-center sm:flex sm:justify-between flex gap-x-3">
                Total: {{ $totalSum }} lei

                <button
                style="margin:-10px"
                type="button" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                    Order
                </button>
            </li>

            </ul>
        @endif
    </x-layout-app>
@else
    @php
    return abort(403, "Unauthorized action.");
    @endphp
@endauth