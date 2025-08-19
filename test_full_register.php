<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

use App\Models\MasterUser;

echo "Testing Full Registration Flow:\n\n";

// Test 1: Check if register route exists
echo "1. Testing route accessibility...\n";
$request = \Illuminate\Http\Request::create('/register', 'GET');
try {
    $response = $kernel->handle($request);
    echo "✅ GET /register - Status: " . $response->getStatusCode() . "\n";
} catch (Exception $e) {
    echo "❌ GET /register failed: " . $e->getMessage() . "\n";
}

// Test 2: Test POST register with valid data
echo "\n2. Testing POST registration...\n";
$testEmail = 'fulltest@example.com';

// Clean up existing user
$existingUser = MasterUser::where('email', $testEmail)->first();
if ($existingUser) {
    $existingUser->delete();
    echo "Cleaned up existing test user\n";
}

$postRequest = \Illuminate\Http\Request::create('/register', 'POST', [
    'name' => 'Full Test User',
    'email' => $testEmail,
    'phone' => '081234567892',
    'password' => 'password123',
    'password_confirmation' => 'password123',
]);

// Add CSRF token
$postRequest->headers->set('X-CSRF-TOKEN', csrf_token());

try {
    $response = $kernel->handle($postRequest);
    echo "✅ POST /register - Status: " . $response->getStatusCode() . "\n";
    
    // Check if user was created
    $createdUser = MasterUser::where('email', $testEmail)->first();
    if ($createdUser) {
        echo "✅ User created in database: " . $createdUser->name . "\n";
        echo "   Email: " . $createdUser->email . "\n";
        echo "   Phone: " . $createdUser->phone . "\n";
    } else {
        echo "❌ User not found in database\n";
    }
    
} catch (Exception $e) {
    echo "❌ POST /register failed: " . $e->getMessage() . "\n";
}

// Test 3: Check total users
echo "\n3. Total users in system: " . MasterUser::count() . "\n";

echo "\nRegistration system is ready for testing!\n";
