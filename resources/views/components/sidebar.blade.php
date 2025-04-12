<div x-data="{ open: true }" class="hidden md:block">
    <div class="w-64" :class="{ 'hidden': !open }">
        <div class="rounded p-4 bg-gray-800 text-white h-full">
            <h5 class="text-2xl font-bold mb-4">Categories</h5>
            <ul>
                <li class="py-2 px-4 rounded hover:bg-gray-700 cursor-pointer">All Products</li>
                @foreach ($categories as $category)
                    <li class="py-2 px-4 rounded hover:bg-gray-700 cursor-pointer">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button 
        @click="open = !open" 
        class="text-white mb-4 px-4 py-2 bg-gray-700 rounded hover:bg-gray-600"
    >
        <span x-show="open">Hide Sidebar</span>
        <span x-show="!open">Show Sidebar</span>
    </button>
</div>