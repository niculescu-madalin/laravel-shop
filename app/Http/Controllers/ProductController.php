<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;




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
            'specs_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Store the file in storage\app\public folder

        if($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFileName = time() . '_img.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images'), $imageFileName);
        }

        if ($request->hasFile('specs_file')) {
            $specsFile = $request->file('specs_file');
            $specsFileName = time() . '_specs.' . $specsFile->getClientOriginalExtension();
            $specsFile->move(public_path('specs'), $specsFileName);
        }
    
        Product::create([
            'category_id' => $request->category_id,
            'name' => request('name'),
            'description' => request('description'),
            'specifications' => request('specifications'),
            'price' => request('price'),
            'amount' => request('amount'),
            'discount' => request('discount'),
            'image_path' => 'images/'.$imageFileName,
            'specs_file' =>'specs/'.$specsFileName
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
        // Delete the image file
        if (File::exists(public_path($product->image_path))) {
            File::delete(public_path($product->image_path));
        }

        // Delete the specs file (if it exists)
        if ($product->specs_file && File::exists(public_path($product->specs_file))) {
            File::delete(public_path($product->specs_file));
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function showWishlistStatus(Request $request) {
        $user = $request->user();
        $productId = $request->product_id;
    
        // Check if the product is already in the user's wishlist
        $productInWishlist = $user->wishlist()->where('product_id', $productId)->exists();
    
        if ($productInWishlist) {
            // Product is already wishlisted
            return redirect()->route('wishlist.show')->with('info', 'This product is already in your wishlist!');
        } else {
            // Product is not in wishlist
            return redirect()->route('wishlist.show')->with('success', 'This product has been added to your wishlist!');
        }
    }
    
}
