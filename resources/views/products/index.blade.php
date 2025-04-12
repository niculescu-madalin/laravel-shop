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
        <div class="flex self-center w-full gap-4 ">
            <!-- Sidebar -->
            <x-sidebar :categories="$categories" />

            <!-- Main Content -->
            <div class="flex-1">
                <div class="gap-4 grid xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3" 
                    x-bind:class="open ? 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4' : 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3'">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>