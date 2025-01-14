<x-app-layout>
    <x-slot name="header">
    <div class="items-center sm:flex sm:justify-between flex gap-x-3">
        <h2 class="grow font-semibold text-xl text-gray-800 leading-tight flex">
            Products
        </h2>

        @if(Auth::check())
            @if(Auth::user()->role === "admin")
            <a 
                href="/products/create"
                style="margin:-10px"
                type="button" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2">
                Add new product
            </a>
            @endif
        @endif
    </div>
    </x-slot>

    <div class="gap-4 flex m-4">
    @foreach ($products as $product)
      <x-product-card :product="$product" />
    @endforeach
        <div>
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>