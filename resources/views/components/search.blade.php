<div x-data="{ 
    isOpen: false, 
    results: [], 
    searchTerm: '{{ request('q') }}' 
}" 
class="relative" 
@click.away="isOpen = false"
>

<div x-data="{ isOpen: false, results: [] }" class="relative" @click.away="isOpen = false">
    <form method="GET" action="{{ route('search.results') }}">
        <input
            class="border-2 border-slate-400 rounded-lg px-4 py-2 w-full focus:shadow-lg" 
            type="text" 
            name="q"
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
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-10 focus:ring-slate-500"
        >
        
        <!-- Add a hidden submit button for accessibility -->
        <button type="submit" class="hidden">Search</button>
    </form>
    
    <!-- Existing dropdown results -->
    <div x-show="isOpen" class="absolute w-full mt-1 bg-white/50 backdrop-blur-xl border rounded-lg shadow-lg z-50 max-h-96 overflow-auto">
        <div class="boder-b">
            <template x-for="result in results" :key="result.id">
                <a 
                    :href="`/products/${result.id}`"
                    class="block px-4 py-3 hover:bg-gray-200/50 transition-colors duration-200 "
                    x-text="result.name"
                >
                </a>
            </template>
        </div>

        <!-- Add "View all results" link -->
        <div x-show="searchTerm.length > 2" class="border-t">
            <a 
                href="{{ route('search.results') }}?q=" 
                x-bind:href="`/search-results?q=${encodeURIComponent(searchTerm)}`"
                class="block px-4 py-3 text-slate-600 bg-slate-100/50 hover:bg-slate-200/50 font-medium"
            >
                View all results for "<span x-text="searchTerm"></span>"
            </a>
        </div>
    </div>
</div>
</div>