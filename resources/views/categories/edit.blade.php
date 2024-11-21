@if(Auth::check() && Auth::user()->role === "admin" )
<x-app-layout>
    <x-slot name="header">
        <h2 class="grow font-semibold text-xl text-gray-800 leading-tight flex">
            Edit: {{ $category->name }}
        </h2>
    </x-slot name="header">

<form class="px-40" method="POST" action="/categories/{{ $category->id }}"  autocomplete="off">
    @csrf
    @method('PATCH')

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    autocomplete="off" 
                    value="{{ $category->name }}" 
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                    required>
              </div>

              @error('name')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input 
                    type="text" 
                    name="description" 
                    id="description"
                    value="{{ $category->description }}"
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6"  
                    required>
              </div>
              @error('description')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
              @enderror
            </div>
          </div>  
        </div>

      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a 
        href={{ url()->previous() }}
        class="text-sm/6 font-semibold text-gray-900">
        Cancel
      </a>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>
    
</x-app-layout>

@else
  @php
    return abort(403, "Unauthorized action.");
  @endphp
@endif