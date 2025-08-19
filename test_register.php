<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;

echo "Testing Registration Process:\n\n";

try {
    // Test data
    $testData = [
        'company_id' => 1,
        'name' => 'Test Register User',
        'email' => 'testregister@example.com',
        'phone' => '081234567890',
        'password' => Hash::make('password123'),
    ];
    
    // Check if user already exists
    $existingUser = MasterUser::where('email', $testData['email'])->first();
    if ($existingUser) {
        echo "User already exists, deleting first...\n";
        $existingUser->delete();
    }
    
    // Create new user
    $user = MasterUser::create($testData);
    
    echo "✅ User created successfully!\n";
    echo "ID: {$user->user_id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Phone: {$user->phone}\n";
    echo "Company ID: {$user->company_id}\n";
    echo "Created at: {$user->created_at}\n";
    
    // Test password verification
    $passwordCheck = Hash::check('password123', $user->password);
    echo "Password check: " . ($passwordCheck ? 'PASS' : 'FAIL') . "\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
