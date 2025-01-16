@auth
<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Cart
                @php
                    $totalSum = 0;
                @endphp
            </h2>
        </x-slot>
        @if (Auth::user()->cart->products->isEmpty())
            <div class="lg:px-40 py-4 sm:px-6">
                <span> Your cart is empty. </span>
            </div>
        @else
            <ul class="w-full text-sm font-medium text-gray-900 rounded-lg">
            @foreach (Auth::user()->cart->products as $product)
            @php
                $totalSum += $product->pivot->quantity * $product->price
            @endphp
            <li class="sm:px-8 lg:px-40 py-4 border-b border-gray-200 items-center sm:flex sm:justify-between flex gap-x-3">
                <div class ="font-bold text-lg">{{ $product->pivot->quantity }} x </div>
                <div class="w-1/12 aspect-square flex gap-1 items-center">
                    <img src="{{ $product->image_path }}">
                </div>
                <div class="w-7/12">
                    <a href="/products/{{ $product->id }}" class="hover:underline">
                        <div class="font-semibold text-l text-gray-800 leading-tight grow">
                            {{ $product->name }}
                        </div>
                    </a>
                    <div class="font-normal">
                        {{ $product->pivot->quantity }} x {{ $product->price }} lei = {{ $product->pivot->quantity * $product->price }} lei
                    </div>
                </div>
                <form method="POST" action="{{ route('cart.updateQuantity') }}" class="update-quantity-form" data-product-id="{{ $product->id }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1"
                        class="w-20 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        onkeypress="checkForEnter(event, this)"
                        onchange="submitForm(this)">
                    <button type="submit" class="btn hover:underline" style="display:none;"></button>
                </form>

                <!-- Remove button -->
                <form method="POST" action="{{ route('cart.removeProduct') }}" style="display: inline;" class="w-1/12">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="font-semibold text-red-800 hover:underline">Remove</button>
                </form>
            </li>
            @endforeach

            <li class="bg-gray-200 font-semibold text-lg sm:px-8 lg:px-40 py-4 border-y border-gray-300 ">
                <!-- Order form -->
                <form id="orderProducts" method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="adresa_livrare" class="block text-lg font-medium text-gray-800">
                            Adresa de livrare:
                        </label>
                        <input
                            form="orderProducts"
                            type="text"
                            name="adresa_livrare" 
                            id="adresa_livrare"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                            required
                            placeholder="Introduceți adresa de livrare">
                    </div>

                    <div class="flex justify-between">
                        Total: {{ $totalSum }} lei
                        <button
                            type="submit" 
                            class="flex gap-1 items-center justify-center rounded-lg bg-slate-900 px-5 py-2.5 text-center text-sm font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                            </svg> 
                            Order Products
                        </button>
                    </div>
                </form>
            </li>

            </ul>
        @endif
    </x-layout-app>
@else
    @php
    return abort(403, "Unauthorized action.");
    @endphp
@endauth

<script>
    function checkForEnter(event, inputField) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default form submission behavior
            const form = inputField.closest('form'); // Find the closest form to the input field
            form.submit(); // Submit the form
        }
    }

    function submitForm(inputField) {
        const form = inputField.closest('form');
        form.submit();
    }
</script>
