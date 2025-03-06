@if(Auth::check() && Auth::user()->role === "admin" )

<x-app-layout>
    <x-slot name="header">
        <h2 class="grow font-semibold text-xl text-gray-800 leading-tight flex">
            Add a new product
        </h2>
    </x-slot name="header">

<form class="px-40" method="POST" action="/products" enctype="multipart/form-data">
    @csrf
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="title" class="block text-sm/6 font-medium text-gray-900">Name</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input 
                  type="text" 
                  name="name" 
                  id="name" 
                  autocomplete="off" 
                  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                  placeholder="Product Name" >
              </div>

              @error('name')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="price" class="block text-sm/6 font-medium text-gray-900">Price</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input 
                  type="text" 
                  name="price" 
                  id="price" 
                  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                  placeholder="Price">
              </div>
              @error('price')
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
                    autocomplete="description" 
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                    placeholder="description">
                </div>
    
                @error('description')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="specifications" class="block text-sm/6 font-medium text-gray-900">specifications</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <input 
                    type="specifications" 
                    name="specifications" 
                    id="specifications" 
                    autocomplete="specifications" 
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                    placeholder="specifications">
                </div>
    
                @error('specifications')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="amount" class="block text-sm/6 font-medium text-gray-900">amount</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <input 
                  type="amount" 
                  name="amount" 
                  id="amount" 
                  autocomplete="amount" 
                  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                  placeholder="amount" >
                </div>
    
                @error('amount')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="discount" class="block text-sm/6 font-medium text-gray-900">discount</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <input 
                  type="discount" 
                  name="discount" 
                  id="discount" 
                  autocomplete="discount" 
                  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" 
                  placeholder="discount">
                </div>
    
                @error('discount')
                  <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
                @enderror
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="category_id" class="block text-sm/6 font-medium text-gray-900">Category</label>
            <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option selected>Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                @endforeach
            </select>
          </div>

          <div class="sm:col-span-4">
            <label for="image">Product Image:</label>
            <input type="file" name="image" id="image">
          </div>

          @error('image')
            <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror

          <div>
            <label for="specs_file">Product Specifications (PDF/DOCX):</label>
            <input type="file" name="specs_file" id="specs_file">
          </div>

          @error('specs_file')
            <p class="ml-1 mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror

          </div>  
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a 
        href={{ url()->previous() }}
        type="button" 
        class="text-sm/6 font-semibold text-gray-900">
        Cancel
      </a>
      <button 
        type="submit" 
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Save
      </button>
    </div>

    <div class="mt-10">
        @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-600 italic">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

  </form>
    
</x-app-layout>

@else
  @php
    return abort(403, "Unauthorized action.");
  @endphp
@endif
