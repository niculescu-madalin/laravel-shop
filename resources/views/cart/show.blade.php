@auth
<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Cart
            </h2>
        </x-slot>
        @if (Auth::user()->cart->products->isEmpty())
            <div class="lg:px-40 py-4 sm:px-6">
                <span> Your cart is empty. </span>
            </div>
        @else
            @foreach (Auth::user()->cart->products as $product)
            <li>
                {{ $product->pivot->quantity }} x {{ $product->name }} - ${{ $product->pivot->quantity * $product->price }}

                <!-- Remove button -->
                <form method="POST" action="{{ route('cart.removeProduct') }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </li>
            @endforeach
        @endif
    </x-layout-app>
@else
    @php
    return abort(403, "Unauthorized action.");
    @endphp
@endauth