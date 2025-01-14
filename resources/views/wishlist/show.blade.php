@auth
<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            </h2>
        </x-slot>
        @foreach (Auth::user()->wishlist->products as $product)
        {{ $product->name }} <br>
        @endforeach
    </x-layout-app>
@else
    @php
    return abort(403, "Unauthorized action.");
    @endphp
@endauth