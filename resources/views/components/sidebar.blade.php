<div x-data="{ open: true }" class="flex flex-col gap-2">
    <div class="w-full" :class="{ 'hidden': !open }">
        <div class="rounded-md  bg-gray-800 text-white h-full">
            <form method="GET" action="{{ route('products.index') }}" id="filter" class="p-4 max-w-sm mx-auto">
                @csrf
                <label for="categories" class="block mb-2 text-sm font-medium text-white">Select an category</label>
                <select id="categories" name="category" class="borders text-sm rounded-md block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value=""> All Products </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"  {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <button
                x-show="open" 
                class="w-full text-white font-semibold px-4 py-2 bg-sky-600 rounded-b-md hover:bg-sky-500"
                form="filter"
                type="submit">
                <span>Filter</span>
            </button>
        </div>
        
    </div>

    <button  
        @click="open = !open" 
        class="text-white mb-4 px-4 py-2 bg-gray-700 rounded hover:bg-gray-600" :class="{ 'w-full': open, 'w-fit': !open }"
    >
        <span x-show="open">Hide Sidebar</span>
        <span x-show="!open" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>  
        </span>
    </button>

    
</div>