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

    <div class="gap-3 flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 m-4">
        {{-- <div class="p-1 h-fit block max-w-sm rounded-lg shadow-sm bg-gray-800 border-gray-700">
            <h5 class="mx-6 my-4 text-2xl font-bold tracking-tight text-white">Categories</h5>
            <div class="px-6 py-2 rounded hover:bg-gray-700 font-normal text-gray-300"> 
               All products
            </div>
            @foreach ($categories as $category)
                <div class="px-6 py-2 rounded hover:bg-gray-700 font-normal text-gray-300"> 
                    {{ $category->name }}
                </div>
            @endforeach
        </div> --}}
        <div class="gap-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($products as $product)
          <x-product-card :product="$product" />
        @endforeach
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>