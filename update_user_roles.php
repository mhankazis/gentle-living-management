<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;

echo "=== UPDATING EXISTING USERS ROLES ===\n\n";

// Update existing users to have proper default role
$existingUsers = MasterUser::whereNotIn('email', [
    'superadmin@gentleliving.com',
    'admin@gentleliving.com', 
    'customer@gentleliving.com'
])->get();

foreach ($existingUsers as $user) {
    if ($user->role != 'user') {
        $user->update(['role' => 'user']);
        echo "✅ Updated {$user->name} ({$user->email}) to role: user\n";
    } else {
        echo "✅ {$user->name} ({$user->email}) already has role: user\n";
    }
}

echo "\n=== FINAL USER ROLES ===\n";
$allUsers = MasterUser::all();
foreach ($allUsers as $user) {
    $icon = $user->role == 'super_admin' ? '🔱' : ($user->role == 'admin' ? '👮' : '👤');
    echo "   $icon {$user->name} ({$user->email}) - Role: {$user->role}\n";
}

echo "\n✅ All users have been updated with appropriate roles!\n";
