<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
        <p>
            {{ $category->description }}
        </p>
    </x-slot>

    <div class="gap-4 flex m-4">
    @foreach ($category->products as $product)
      <x-product-card :product="$product" />
    @endforeach
    </div>
</x-layout-app>