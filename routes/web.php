<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Routes d'authentification
require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index']);

// Routes pour les produits
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Routes pour le panier
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/validate', function () {
    return view('cart.validate'); 
})->name('cart.validate');
Route::post('/validate', [CartController::class, 'validateCart']);



// Routes pour la partie admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware pour les routes d'administration

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.dashboard');

        // Routes pour la gestion des produits
        Route::get('products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::delete('products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::post('products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::patch('products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');

        // Routes pour la gestion des catégories
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::patch('categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

        // Routes pour la gestion des commandes
        Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::patch('orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
        
    });
});

require __DIR__.'/auth.php';
