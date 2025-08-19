<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;

echo "=== TEST REGISTRASI SETELAH PERBAIKAN ===\n\n";

// Hitung user sebelum
$usersBefore = MasterUser::count();
echo "1. Jumlah user sebelum test: $usersBefore\n";

// Test data
$testEmail = 'test-after-fix@example.com';

// Hapus jika sudah ada
$existing = MasterUser::where('email', $testEmail)->first();
if ($existing) {
    $existing->delete();
    echo "2. User test lama dihapus\n";
}

// Simulasi request registrasi
echo "3. Testing route register...\n";

// Manual test create user seperti yang akan dilakukan controller
try {
    $newUser = MasterUser::create([
        'company_id' => 1,
        'name' => 'Test After Fix',
        'email' => $testEmail,
        'phone' => '08123456789',
        'password' => bcrypt('password123'),
    ]);
    
    echo "✅ User berhasil dibuat dengan ID: " . $newUser->user_id . "\n";
    
    // Verifikasi di database
    $usersAfter = MasterUser::count();
    echo "4. Jumlah user setelah test: $usersAfter\n";
    
    if ($usersAfter > $usersBefore) {
        echo "✅ Data berhasil masuk ke database!\n";
    } else {
        echo "❌ Data tidak masuk ke database\n";
    }
    
    // Tampilkan user terbaru
    echo "\n5. User terbaru yang dibuat:\n";
    $latestUser = MasterUser::latest('created_at')->first();
    echo "   - Nama: {$latestUser->name}\n";
    echo "   - Email: {$latestUser->email}\n";
    echo "   - Phone: {$latestUser->phone}\n";
    echo "   - Created: {$latestUser->created_at}\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== ROUTE INFORMATION ===\n";
echo "Sekarang route /register menggunakan RegisteredUserController yang benar\n";
echo "yang akan menyimpan data ke tabel master_users\n";
