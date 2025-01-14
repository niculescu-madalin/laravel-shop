<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('products.index', [ProductController::class, 'index']);
// });

Route::get('/', [ProductController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

Route::get('/wishlist', [WishlistController::class, 'show']);
    

Route::middleware(['auth'])->group(function () {
    # Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// Route::delete('categories/{id}/delete', ['as' => 'categories.delete', 'uses' => 'App\Http\Controllers\CategoryController@destroy']);


Route::get('admin', function() {
    $products = Product::all();  // Retrieve all products
    $categories = Category::all();  // Retrieve all categories
        
    return view('dashboard', compact('products', 'categories'));
})->middleware(['auth', 'verified'])->name('dashboard');

