<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductSearchController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.show');
    Route::post('/wishlist/add', [WishlistController::class, 'addProduct'])->name('wishlist.add');
    Route::post('/wishlist/remove-product', [WishlistController::class, 'removeProduct'])->name('wishlist.removeProduct');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add-product', [CartController::class, 'addProduct'])->name('cart.addProduct');
    Route::post('/cart/remove-product', [CartController::class, 'removeProduct'])->name('cart.removeProduct');
    Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
});



Route::middleware('auth')->group(function () {
    Route::get('orders/admin', [OrderController::class, 'adminIndex'])->name('orders.adminIndex');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::get('admin', function() {
    $products = Product::all();  // Retrieve all products
    $categories = Category::all();  // Retrieve all categories
        
    return view('dashboard', compact('products', 'categories'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search-results', [ProductSearchController::class, 'showResults'])->name('search.results');
Route::get('/search', [ProductSearchController::class, 'search'])->name('search');

