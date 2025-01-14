<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 sm:px-4 lg:px-40 ">
      <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Product Images -->
          <div class="flex items-center w-full md:w-1/2 px-4 mb-8">
            <img 
              src="/{{ $product->image_path }}" 
              alt="{{ $product->name }}"
              class="w-auto h-full rounded-lg shadow-md mb-4" id="mainImage">
          </div>
      
          <!-- Product Details -->
          <div class="w-full md:w-1/2 px-4">
            <h2 class="text-3xl font-bold mb-2">{{ $product->name }}</h2>
            <div class="mb-4">
              <span class="text-2xl font-bold mr-2">{{ $product->price }} RON </span>
              {{-- <span class="text-gray-500 line-through">$399.99</span> --}}
          </div>
              
          <p class="text-gray-700 mb-6">
            {{ $product->description}}
          </p>
          <div class="mb-6">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
            <input
              form="addToCart"
              type="number" 
              id="quantity" 
              name="quantity" 
              min="1" 
              value="1"
              class="w-20 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
          </div>
      
          <div class="flex space-x-4 mb-6">
            <button
                form="addToCart"
                type="submit"
                class="bg-slate-900 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                  <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                </svg> 
                Add to Cart
            </button>
            <button
              form="addToWishlist" 
              type="submit"
              class="bg-gray-200 flex gap-2 items-center  text-gray-800 px-6 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
              </svg>
              Wishlist
            </button>
          </div>
      
          <div>
            <h3 class="text-lg font-semibold mb-2">Specifications:</h3>
            <div class="list-disc list-inside text-gray-700">
              {{ $product->specifications }}
            </div>
          </div>
        </div>
      </div>
    </div>
@auth
<form id="addToWishlist" method="POST" action="{{ route('wishlist.add') }}">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
</form>

<form id="addToCart" method="POST" action="{{ route('cart.addProduct') }}">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
</form>
@endauth
</x-app-layout>