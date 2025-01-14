@auth
<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Wishlist
            </h2>
        </x-slot>
        @foreach (Auth::user()->wishlist->products as $product)
        <li>
            {{ $product->name }} - ${{ $product->price }}
            
            <!-- Remove button -->
            <form method="POST" action="{{ route('wishlist.removeProduct') }}" style="display: inline;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
            </form>
        </li>
        @endforeach
    </x-layout-app>
@else
    @php
    return abort(403, "Unauthorized action.");
    @endphp
@endauth