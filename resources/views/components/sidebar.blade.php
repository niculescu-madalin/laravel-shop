<div x-data="{ open: true }" class="flex flex-col gap-2">
    <div class="w-full" :class="{ 'hidden': !open }">
        <div class="pt-4 pb-4 px-4 rounded-lg bg-gray-800 text-white h-full">
            <form method="GET" action="{{ route('products.index') }}" id="filter" class="max-w-sm mx-auto">
                @csrf
                <label for="categories" class="block mb-2 text-sm">Select an category</label>
                <select id="categories" name="category" class="borders text-sm rounded-md block w-full py-1.5 px-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value=""> All Products </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"  {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <label for="price" class="mt-4 block mb-2 text-sm ">Price</label>
                <div class="relative mb-6">
                    <label for="labels-range-input" class="sr-only">Labels range</label>
                    <input id="price" type="range" value="1000" min="100" max="5000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">0</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">500</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">1000</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">7000</span>
                </div>
            </form>
            
        </div>
        <button
            x-show="open" 
            class="mt-2 w-full text-white font-semibold px-4 py-2 bg-slate-600 rounded-md hover:bg-slate-500"
            form="filter"
            type="submit">
            <span>Filter</span>
        </button>
        
    </div>

    <button  
        @click="open = !open" 
        class="text-white mb-4 px-4 py-2 bg-gray-700 rounded hover:bg-gray-600 block sm:hidden"
    >
        <span x-show="open">Hide filtering options</span>
        <span x-show="!open" class="flex items-center gap-2 w-full justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>  
            Filtering Options
        </span>
    </button>

    
</div>