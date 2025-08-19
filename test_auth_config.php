<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Auth;

echo "Testing Auth Configuration:\n";
echo "Auth Model: " . config('auth.providers.users.model') . "\n";
echo "Auth Table: " . (new MasterUser())->getTable() . "\n";
echo "Primary Key: " . (new MasterUser())->getKeyName() . "\n";

$user = MasterUser::where('email', 'admin@mail')->first();
if ($user) {
    echo "\nTest User Found:\n";
    echo "ID: {$user->user_id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Password is hashed: " . (strlen($user->password) > 20 ? 'Yes' : 'No') . "\n";
}
