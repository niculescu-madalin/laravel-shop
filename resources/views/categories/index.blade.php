<x-app-layout>
    <x-slot name="header">
    <div class="items-center sm:flex sm:justify-between flex gap-x-3"> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>

        @if(Auth::check())
            @if(Auth::user()->role === "admin")
            <a 
                href="/categories/create"
                type="button"
                style="margin:-10px"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                Add new category
            </a>
            @endif
        @endif
    </div>
    </x-slot>

    <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
    @foreach ($categories as $category)
        <li class="sm:px-8 lg:px-40 py-4 border-b border-gray-200 items-center sm:flex sm:justify-between flex gap-x-3">
            <div class="w-6/12">
                <div class="font-semibold text-l text-gray-800 leading-tight grow">{{ $category->name }} </div>
                <div class="font-normal">{{ $category->description }}</div>
            </div>

            <div class="w-6/12 justify-end flex gap-1.5 h-full">
                @if(Auth::check())
                    @if(Auth::user()->role === "admin")
                        <form class="h-full" method="POST" action="/categories/{{ $category->id }}" id="category-delete-{{ $category->id}}">
                            @csrf
                            @method('DELETE')
                            <button 
                                class="h-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                Delete
                            </button>
                        </form>
                        <a 
                            href="/categories/{{ $category->id }}/edit"
                            type="button" 
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Edit category
                        </a>    
                    @endif
                @endif
                <a
                    href="/categories/{{ $category->id }}"
                    type="button" 
                    class="gap-1.5 text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                    View
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                    </svg>                  
                </a>
            </div>
        </li>
    @endforeach
    
    </ul>
</x-app-layout>
