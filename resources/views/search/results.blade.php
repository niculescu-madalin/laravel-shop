<x-app-layout>
<div class="container px-4 py-4 md:px-6 md:mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results for <span class="font-bold">"{{ $searchTerm }}"</span>
        </h2>
    </x-slot>
    @if($products->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                <x-product-card :product="$product"></x-product-card>
                
            @endforeach
        </div>

    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No products found for "{{ $searchTerm }}"</p>
            <a href="/" class="mt-4 inline-block text-blue-600 hover:underline">
                Return to homepage
            </a>
        </div>
    @endif
</div>
</x-app-layout>