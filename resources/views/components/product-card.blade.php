@props(['product'])
<div class="justify-between relative flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
    <a class="relative mx-3 mt-3 flex justify-center h-60 overflow-hidden rounded-xl" href="/products/{{ $product->id }}">
      <img class="object-cover" src="/{{ $product->image_path}}" alt="product image" />
    </a>

    <div class="mt-4 px-5 pb-5">
      <a href="/products/{{ $product->id }}">
        <h5 class="text-xl tracking-tight text-slate-900">{{ $product->name }}</h5>
      </a>
      <div class="mt-2 mb-5 flex items-center justify-between">
        <p>
          <span class="text-3xl font-bold text-slate-900">{{ $product->price }} Lei</span>
          {{-- <span class="text-sm text-slate-900 line-through">$699</span> --}}
        </p>
      </div>
      <div class="flex flex-col gap-1">
        <div class="flex gap-1">
        <form 
          class="w-full"
          id="addToCart-{{ $product->id }}" 
          method="POST" action="{{ route('cart.addProduct') }}">
          @csrf
          <button
            type="submit"
            href="/products/{{ $product->id }}" 
            class="w-full flex gap-1 items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
            </svg>                  
            Add to cart
          </button>
          <input type="hidden" name="product_id" value="{{ $product->id }}">
        </form>
        @php
          $isWislisted = false;
          if(Auth::check() && Auth::user()->wishlist->products->contains('id', $product->id)) {
            $isWislisted = true;
          }
        @endphp
        <form 
          id="addToWishlist-{{ $product->id }}" 
          method="POST"
          @if($isWislisted)
            action="{{ route('wishlist.removeProduct') }}">
          @else
            action="{{ route('wishlist.add') }}">
          @endif
            
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button
            type="submit"
            class="py-2.5 text-center text-sm font-semibold w-full flex gap-1 items-center justify-center rounded-md bg-gray-200 text-gray-800 px-3 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            @if($isWislisted)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
            </svg>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>        
            @endif
          </button>
        </form>
        </div>
            
        
        @if(Auth::check())
          @if(Auth::user()->role === "admin")
          <a 
              href="/products/{{ $product->id }}/edit"
              type="button" 
              class="flex items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300 mt-1">
              Edit
          </a>
          <div class="flex items-center justify-center mt-1">
              <form class="w-full" method="POST" action="/products/{{ $product->id }}" id="products-delete-{{ $product->id}}">
                  @csrf
                  @method('DELETE')
                  <button 
                      class="flex btn w-full items-center justify-center rounded-md bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">
                      Delete
                  </button>
              </form>
          </div>
          @endif
        @endif
      </div>
    </div>
</div> 
