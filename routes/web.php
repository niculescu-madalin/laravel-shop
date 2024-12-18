<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
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
// Route::delete('categories/{id}/delete', ['as' => 'categories.delete', 'uses' => 'App\Http\Controllers\CategoryController@destroy']);


Route::get('admin', function() {
    $products = Product::all();  // Retrieve all products
    $categories = Category::all();  // Retrieve all categories
        
    return view('dashboard', compact('products', 'categories'));
})->middleware(['auth', 'verified'])->name('dashboard');

