<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Auth;

echo "Testing Authentication System:\n\n";

// Test kredensial
$credentials = ['email' => 'admin@mail', 'password' => 'admin123'];

echo "1. Testing login attempt...\n";
if (Auth::attempt($credentials)) {
    echo "✅ Login successful!\n";
    echo "Authenticated user: " . Auth::user()->name . "\n";
    echo "User ID: " . Auth::user()->user_id . "\n";
    echo "Email: " . Auth::user()->email . "\n";
    
    // Test logout
    Auth::logout();
    echo "\n2. Testing logout...\n";
    if (Auth::check()) {
        echo "❌ Logout failed\n";
    } else {
        echo "✅ Logout successful!\n";
    }
} else {
    echo "❌ Login failed!\n";
}

echo "\n3. Testing user count: " . MasterUser::count() . " users\n";
echo "\n4. Available test accounts:\n";
foreach (MasterUser::all() as $user) {
    echo "- {$user->email} (ID: {$user->user_id})\n";
}
