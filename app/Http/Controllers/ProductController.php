<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $products = Product::with('category')->latest()->simplePaginate(20);
        return view( 'products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        request()->validate([
            'name' => ['required', 'min: 3'],
            'price' =>  ['required'],
            'description' => ['required'],
            'specifications'=> ['required'],
            'amount' => ['required'],
            'discount' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Store the file in storage\app\public folder
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Product::create([
            'name' => request('name'),
            'description' => request('description'),
            'specifications' => request('specifications'),
            'price' => request('price'),
            'amount' => request('amount'),
            'discount' => request('discount'),
            'image_path' => 'images/'.$imageName,
            'category_id' => $request->category_id,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product) {
        $categories = Category::all();
        return view('products.edit', [
            'product' => $product, 
            'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product) {
        request()->validate([
            'name' => ['required', 'min: 3'],
            'price' =>  ['required'],
            'description' => ['required'],
            'specifications'=> ['required'],
            'amount' => ['required'],
            'discount' => ['required'],
            'category_id' => 'required|exists:categories,id',
        ]);

        // Store the file in storage\app\public folder
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        
        $product->update([
            'name' => request('name'),
            'description' => request('description'),
            'specifications' => request('specifications'),
            'price' => request('price'),
            'amount' => request('amount'),
            'discount' => request('discount'),
            'category_id' => $request->category_id,
        ]);
    
        return redirect('/products/'. $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) {
        $product->delete();
        return redirect('/products');
    }
}
