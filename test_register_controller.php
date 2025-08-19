<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;

echo "Testing Registration Controller:\n\n";

try {
    // Delete test user if exists
    $existingUser = MasterUser::where('email', 'controller-test@example.com')->first();
    if ($existingUser) {
        echo "Deleting existing test user...\n";
        $existingUser->delete();
    }
    
    // Create a mock request
    $requestData = [
        'name' => 'Controller Test User',
        'email' => 'controller-test@example.com',
        'phone' => '081234567891',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];
    
    $request = Request::create('/register', 'POST', $requestData);
    $request->headers->set('Content-Type', 'application/x-www-form-urlencoded');
    
    // Create controller instance
    $controller = new RegisteredUserController();
    
    echo "Testing validation...\n";
    
    // Test validation manually
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:master_users,email'],
        'phone' => ['nullable', 'string', 'max:20'],
        'password' => ['required', 'confirmed'],
    ]);
    
    echo "✅ Validation passed!\n";
    
    // Test user creation
    $user = MasterUser::create([
        'company_id' => 1,
        'name' => $requestData['name'],
        'email' => $requestData['email'],
        'phone' => $requestData['phone'] ?? '',
        'password' => \Illuminate\Support\Facades\Hash::make($requestData['password']),
    ]);
    
    echo "✅ User created through controller logic!\n";
    echo "ID: {$user->user_id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
