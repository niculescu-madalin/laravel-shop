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

    <div class="m-2">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 lg:grid-cols-10 self-center w-full gap-2">
            <!-- Sidebar -->
            <div class="md:col-span-2 lg:col-span-2">
                <x-sidebar :categories="$categories"/>
            </div>
            <!-- Main Content -->
            <div class="md:col-span-4 lg:col-span-8">
                <div class="gap-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3" 
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