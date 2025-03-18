<div x-data="{ isOpen: false, results: [] }" class="relative w-full" @click.away="isOpen = false">  
    <input 
        type="text" 
        placeholder="Search products..."
        x-model="searchTerm"
        @input.debounce.300ms="
            if (searchTerm.length > 2) {
                fetch(`/search?q=${encodeURIComponent(searchTerm)}`)
                    .then(response => response.json())
                    .then(data => {
                        results = data;
                        isOpen = true;
                    });
            } else {
                results = [];
                isOpen = false;
            }
        "
        @focus="searchTerm.length > 2 && (isOpen = true)"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
    
    <!-- Results Dropdown -->
    <div 
        x-show="isOpen" 
        class="absolute w-full mt-1 bg-white border rounded-lg shadow-lg z-50 max-h-96 overflow-auto"
    >
        <template x-for="result in results" :key="result.id">
            <a 
                :href="`/products/${result.id}`"
                class="block px-4 py-3 hover:bg-gray-100 transition-colors duration-200"
                x-text="result.name"
            >
            </a>
        </template>
        
        <div 
            x-show="!results.length && searchTerm.length > 2" 
            class="px-4 py-3 text-gray-500"
        >
            No results found for "<span x-text="searchTerm"></span>"
        </div>
    </div>
</div>