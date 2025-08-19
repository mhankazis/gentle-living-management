<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;

// Update password for existing admin user
$admin = MasterUser::where('email', 'admin@mail')->first();
if ($admin) {
    $admin->password = Hash::make('admin123');
    $admin->save();
    echo "Admin password updated to 'admin123'\n";
}

// Update password for staff user
$staff = MasterUser::where('email', 'staff@mail')->first();
if ($staff) {
    $staff->password = Hash::make('staff123');
    $staff->save();
    echo "Staff password updated to 'staff123'\n";
}

echo "All users:\n";
foreach (MasterUser::all() as $user) {
    echo "ID: {$user->user_id}, Email: {$user->email}, Name: {$user->name}\n";
}
