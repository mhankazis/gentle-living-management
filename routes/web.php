<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Hapus atau nonaktifkan route dashboard bawaan Laravel
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Order Routes - Public (track order)
Route::get('/track/{orderNumber}', [OrderController::class, 'track'])->name('orders.track');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/categories/{id}', [ProductController::class, 'getByCategory'])->name('products.category');

// Backward compatibility - alias for products route
Route::redirect('/produk', '/products')->name('products');

// Admin Routes - Hanya admin dan super_admin yang bisa akses
Route::prefix('admin')->middleware(['auth', 'role:admin,super_admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminOrderController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [App\Http\Controllers\AdminOrderController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{orderId}', [App\Http\Controllers\AdminOrderController::class, 'orderDetail'])->name('admin.orders.detail');
    Route::post('/orders/{orderId}/status', [App\Http\Controllers\AdminOrderController::class, 'updateOrderStatus'])->name('admin.orders.status');
    Route::post('/orders/{orderId}/approve-cancellation', [App\Http\Controllers\AdminOrderController::class, 'approveCancellation'])->name('admin.orders.approve-cancellation');
    Route::post('/orders/{orderId}/reject-cancellation', [App\Http\Controllers\AdminOrderController::class, 'rejectCancellation'])->name('admin.orders.reject-cancellation');
});

Route::get('/categories', function () {
    return view('categories');
});

// History Routes (Protected)
Route::middleware('auth:master_users')->group(function () {
    Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [App\Http\Controllers\HistoryController::class, 'show'])->name('history.show');
    Route::patch('/history/{id}/cancel', [App\Http\Controllers\HistoryController::class, 'cancel'])->name('history.cancel');
});

// Fallback untuk backward compatibility
Route::get('/riwayat', function () {
    return redirect()->route('history.index');
})->name('history');

Route::get('/about', function () {
    return view('about');
});

// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// Protected Routes - Semua authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    })->name('profile');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // User Order Management Routes - Hanya user yang bisa akses
    Route::middleware('role:user')->group(function () {
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{orderId}/success', [OrderController::class, 'success'])->name('orders.success');
        Route::post('/orders/{orderId}/cancel', [OrderController::class, 'cancelRequest'])->name('orders.cancel');
    });
    
    // Cart Routes - Semua authenticated users bisa akses cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/{cartId}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartId}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
});

// Route bawaan Laravel untuk profile (edit, update, destroy) dihapus agar tidak bentrok dengan route custom
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route register yang lama (simulasi) dihapus karena sudah ada yang benar di atas
// yang menggunakan RegisteredUserController

// Hapus atau nonaktifkan Auth::routes() atau route login bawaan Laravel
// Auth::routes(); // Dihapus jika ada

require __DIR__.'/auth.php';
