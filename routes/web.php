<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Hapus atau nonaktifkan route dashboard bawaan Laravel
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/cart', 'cart')->name('cart');
Route::get('/products', function () {
    return view('products');
});
Route::get('/products/{id}', function ($id) {
    return view('product-detail');
})->name('product.detail');
Route::get('/categories', function () {
    return view('categories');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

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
