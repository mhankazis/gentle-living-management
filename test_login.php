<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "Testing login credentials:\n\n";

// Test credentials
$credentials = [
    ['email' => 'admin@mail', 'password' => 'admin123'],
    ['email' => 'staff@mail', 'password' => 'staff123'],
    ['email' => 'test@test.com', 'password' => 'password'],
];

foreach ($credentials as $cred) {
    $user = MasterUser::where('email', $cred['email'])->first();
    if ($user) {
        $passwordMatch = Hash::check($cred['password'], $user->password);
        echo "Email: {$cred['email']}\n";
        echo "Password: {$cred['password']}\n";
        echo "User found: Yes\n";
        echo "Password match: " . ($passwordMatch ? 'Yes' : 'No') . "\n";
        echo "------------------------\n";
    } else {
        echo "Email: {$cred['email']} - User not found\n";
        echo "------------------------\n";
    }
}
