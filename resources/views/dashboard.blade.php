<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <body class="bg-gray-100">

        <!-- Admin Dashboard Container -->
        <div class="max-w-7xl mx-auto p-6">

            <!-- Products Section -->
            <section class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">All Products</h2>
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full table-auto bg-white rounded-lg border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Price</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Category</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $product->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $product->price }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 flex gap-1">
                                        <a href="/products/{{ $product->id }}" class="text-blue-500 hover:text-blue-700">View</a> |
                                        <a href="/products/{{ $product->id }}/edit" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                        <span>
                                            <form method="POST" action="/products/{{ $product->id }}" id="products-delete-{{ $product->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    class="text-red-500 hover:text-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
    
            <!-- Categories Section -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">All Categories</h2>
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full table-auto bg-white rounded-lg border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Category Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $category->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 flex gap-1">
                                        <a href="/categories/{{ $category->id }}" class="text-blue-500 hover:text-blue-700">View</a> |
                                        <a href="/categories/{{ $category->id }}/edit" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                        <span>
                                            <form method="POST" action="/categories/{{ $category->id }}" id="category-delete-{{ $category->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    class="text-red-500 hover:text-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
    
        </div>


</x-app-layout>
