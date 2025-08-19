<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;

echo "=== DIAGNOSA MASALAH REGISTRASI ===\n\n";

// Test 1: Check database connection
echo "1. Testing database connection...\n";
try {
    $count = MasterUser::count();
    echo "✅ Database connected. Current users: $count\n";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit;
}

// Test 2: Check model fillable
echo "\n2. Checking MasterUser model...\n";
$user = new MasterUser();
echo "✅ Fillable fields: " . implode(', ', $user->getFillable()) . "\n";
echo "✅ Table name: " . $user->getTable() . "\n";
echo "✅ Primary key: " . $user->getKeyName() . "\n";

// Test 3: Manual user creation test
echo "\n3. Testing manual user creation...\n";
$testEmail = 'diagnose-test@example.com';

// Clean existing
$existing = MasterUser::where('email', $testEmail)->first();
if ($existing) {
    $existing->delete();
    echo "Cleaned existing test user\n";
}

try {
    $newUser = MasterUser::create([
        'company_id' => 1,
        'name' => 'Diagnose Test',
        'email' => $testEmail,
        'phone' => '08123456789',
        'password' => Hash::make('password123'),
    ]);
    
    echo "✅ Manual creation successful!\n";
    echo "   ID: " . $newUser->user_id . "\n";
    echo "   Name: " . $newUser->name . "\n";
    
    // Verify in database
    $verify = MasterUser::where('email', $testEmail)->first();
    if ($verify) {
        echo "✅ Verified in database\n";
    } else {
        echo "❌ Not found in database after creation\n";
    }
    
} catch (Exception $e) {
    echo "❌ Manual creation failed: " . $e->getMessage() . "\n";
}

// Test 4: Check table structure
echo "\n4. Checking table structure...\n";
try {
    $columns = \Schema::getColumnListing('master_users');
    echo "✅ Table columns: " . implode(', ', $columns) . "\n";
} catch (Exception $e) {
    echo "❌ Failed to get table structure: " . $e->getMessage() . "\n";
}

// Test 5: Check events and observers
echo "\n5. Checking model events...\n";
$events = ['creating', 'created', 'saving', 'saved'];
foreach ($events as $event) {
    $listeners = \Event::getListeners("eloquent.$event: " . MasterUser::class);
    if (!empty($listeners)) {
        echo "⚠️  Event listeners found for '$event'\n";
    }
}

echo "\n6. Current users in database:\n";
$users = MasterUser::all();
foreach ($users as $user) {
    echo "   - {$user->name} ({$user->email}) - ID: {$user->user_id}\n";
}

echo "\nTotal users: " . MasterUser::count() . "\n";
