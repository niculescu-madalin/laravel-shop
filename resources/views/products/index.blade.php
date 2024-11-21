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
    <div class="justify-between relative flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
        <a class="relative mx-3 mt-3 flex justify-center h-60 overflow-hidden rounded-xl" href="/products/{{ $product->id }}">
          <img class="object-cover" src="{{ $product->image_path}}" alt="product image" />
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
          <div>
            <a 
                href="/products/{{ $product->id }}" 
                class="flex gap-1 items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                </svg>                  
              Add to cart</a
            >
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
    @endforeach
        <div>
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>