<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Hapus atau nonaktifkan route dashboard bawaan Laravel
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/{cartId}/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cartId}/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Order Routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{orderId}/success', [OrderController::class, 'success'])->name('orders.success');
Route::get('/track/{orderNumber}', [OrderController::class, 'track'])->name('orders.track');
Route::post('/orders/{orderId}/cancel', [OrderController::class, 'cancelRequest'])->name('orders.cancel');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/categories/{id}', [ProductController::class, 'getByCategory'])->name('products.category');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{orderId}', [AdminController::class, 'orderDetail'])->name('admin.orders.detail');
    Route::post('/orders/{orderId}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
    Route::post('/orders/{orderId}/approve-cancellation', [AdminController::class, 'approveCancellation'])->name('admin.orders.approve-cancellation');
    Route::post('/orders/{orderId}/reject-cancellation', [AdminController::class, 'rejectCancellation'])->name('admin.orders.reject-cancellation');
});

Route::get('/categories', function () {
    return view('history');
});
Route::get('/history', function () {
    return view('history');
})->name('history');
Route::get('/about', function () {
    return view('about');
});

// LOGIN GET
Route::get('/login', function () {
    // Cek session benar-benar ada dan true
    if (session('isLoggedIn') === true) {
        return redirect('/profile');
    }
    return view('login');
})->name('login');

// LOGIN POST
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');
    // Validasi sederhana, bisa diganti autentikasi sebenarnya
    if ($email && $password) {
        session(['isLoggedIn' => true, 'userEmail' => $email]);
        return redirect('/'); // Redirect ke home setelah login
    } else {
        return redirect('/login')->with('error', 'Email dan password harus diisi');
    }
});

// LOGOUT
Route::post('/logout', function () {
    session()->forget(['isLoggedIn', 'userEmail']);
    return redirect('/login');
})->name('logout');

// PROFILE
Route::get('/profile', function () {
    // Cek session benar-benar ada dan true
    if (session('isLoggedIn') !== true) {
        return redirect('/login');
    }
    $userEmail = session('userEmail', '');
    return view('profile', ['userEmail' => $userEmail]);
});

// Route bawaan Laravel untuk profile (edit, update, destroy) dihapus agar tidak bentrok dengan route custom
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// REGISTER GET
Route::get('/register', function () {
    if (session('isLoggedIn')) {
        return redirect('/profile');
    }
    return view('register');
})->name('register');

// REGISTER POST
Route::post('/register', function (\Illuminate\Http\Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $confirm = $request->input('confirm_password');
    if (!$name || !$email || !$password || !$confirm) {
        return redirect('/register')->with('error', 'Semua field harus diisi');
    }
    if ($password !== $confirm) {
        return redirect('/register')->with('error', 'Password dan konfirmasi password tidak sama');
    }
    if (strlen($password) < 6) {
        return redirect('/register')->with('error', 'Password minimal 6 karakter');
    }
    // Simulasi sukses (bisa disimpan ke DB jika perlu)
    return redirect('/login')->with('success', 'Akun Anda telah berhasil dibuat. Silakan login.');
});

// Hapus atau nonaktifkan Auth::routes() atau route login bawaan Laravel
// Auth::routes(); // Dihapus jika ada

require __DIR__.'/auth.php';
