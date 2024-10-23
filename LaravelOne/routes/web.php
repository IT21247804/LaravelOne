<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // Import the ProductController
use App\Http\Controllers\CategoryController; // Import the CategoryController
use App\Models\Product; // Import the Product model
use App\Models\Category; // Import the Category model
use App\Http\Controllers\PurchaseController; // Import the PurchaseController

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->user_type === 'admin') {
        // Change to paginate products, for example 5 per page
        $products = Product::with('category')->paginate(5);
        $categories = Category::all();
        return view('dashboard', compact('products', 'categories')); // Admin dashboard
    } else {
        return redirect()->route('user-dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Products routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // User Products route
    Route::get('/user/products', [ProductController::class, 'userProducts'])->name('user-dashboard');

    // Purchases routes
   //Route::get('/purchases', [PurchaseController::class, 'index'])->name('products.show'); 
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store'); // Create a new purchase
});

require __DIR__.'/auth.php';

