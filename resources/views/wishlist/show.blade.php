@auth
<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Wishlist
            </h2>
        </x-slot>
        @if (Auth::user()->wishlist->products->isEmpty())
        <div class="mt-20 text-gray-400 text-3xl flex-col gap-2 w-full h-full flex items-center lg:px-40 py-4 sm:px-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-24">
                <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
            </svg>                 
            <div> Your wishlist is empty. </div>
        </div>
        @else
        <ul>
            @foreach (Auth::user()->wishlist->products as $product)
            <li class="sm:px-8 lg:px-40 py-4 border-b border-gray-200 items-center sm:flex sm:justify-between flex gap-x-3">
                <div class="w-1/12 aspect-square border-white border-4 ">
                    <img class="" src="{{ $product->image_path }}">
                </div>
                <div class="w-6/12">
                    <a href="/products/{{ $product->id }}" class="hover:underline">
                        <div class="font-semibold text-l text-gray-800 leading-tight grow">
                            {{ $product->name }}
                        </div>
                    </a>
                    <div class="font-normal"> {{ $product->price }} lei</div>
                </div>
                <!-- Add to Cart button -->
                <form 
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
                <!-- Remove button -->
                <form method="POST" action="{{ route('wishlist.removeProduct') }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-sm hover:underline">Remove</button>
                </form>
            </li>
            @endforeach
        </ul>
        @endif
    </x-layout-app>
@else
    @php
    return abort(403, "Unauthorized action.");
    @endphp
@endauth