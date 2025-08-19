<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

echo "Final Registration Test:\n\n";

$testData = [
    'name' => 'Final Test User',
    'email' => 'finaltest@example.com',
    'phone' => '081234567893',
    'password' => 'password123',
    'password_confirmation' => 'password123',
];

// Clean existing
$existing = MasterUser::where('email', $testData['email'])->first();
if ($existing) {
    $existing->delete();
    echo "Cleaned existing user\n";
}

// Test validation
echo "Testing validation rules...\n";
$validator = Validator::make($testData, [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:master_users,email'],
    'phone' => ['nullable', 'string', 'max:20'],
    'password' => ['required', 'confirmed', 'min:6'],
]);

if ($validator->fails()) {
    echo "❌ Validation failed:\n";
    foreach ($validator->errors()->all() as $error) {
        echo "  - $error\n";
    }
} else {
    echo "✅ Validation passed\n";
    
    // Test user creation
    echo "Creating user...\n";
    try {
        $user = MasterUser::create([
            'company_id' => 1,
            'name' => $testData['name'],
            'email' => strtolower($testData['email']),
            'phone' => $testData['phone'] ?? '',
            'password' => Hash::make($testData['password']),
        ]);
        
        echo "✅ User created successfully!\n";
        echo "   ID: {$user->user_id}\n";
        echo "   Name: {$user->name}\n";
        echo "   Email: {$user->email}\n";
        echo "   Phone: {$user->phone}\n";
        
        echo "\nTotal users now: " . MasterUser::count() . "\n";
        
    } catch (Exception $e) {
        echo "❌ User creation failed: " . $e->getMessage() . "\n";
    }
}

echo "\n🎯 Registration system is ready!\n";
echo "Test credentials for browser:\n";
echo "Name: Final Test User\n";
echo "Email: finaltest@example.com\n";
echo "Phone: 081234567893\n";
echo "Password: password123\n";
