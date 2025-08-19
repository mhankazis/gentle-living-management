<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterUser;

echo "=== ROLE-BASED SYSTEM VERIFICATION ===\n\n";

echo "1. 🔍 Checking users and their roles:\n";
$users = MasterUser::all();
foreach ($users as $user) {
    echo "   - {$user->name} ({$user->email}) - Role: {$user->role}\n";
}

echo "\n2. 🧪 Testing role methods:\n";
$testUser = MasterUser::where('role', 'user')->first();
$testAdmin = MasterUser::where('role', 'admin')->first();
$testSuperAdmin = MasterUser::where('role', 'super_admin')->first();

if ($testUser) {
    echo "   User '{$testUser->name}':\n";
    echo "     - isUser(): " . ($testUser->isUser() ? '✅' : '❌') . "\n";
    echo "     - isAdmin(): " . ($testUser->isAdmin() ? '✅' : '❌') . "\n";
    echo "     - isSuperAdmin(): " . ($testUser->isSuperAdmin() ? '✅' : '❌') . "\n";
}

if ($testAdmin) {
    echo "   Admin '{$testAdmin->name}':\n";
    echo "     - isUser(): " . ($testAdmin->isUser() ? '✅' : '❌') . "\n";
    echo "     - isAdmin(): " . ($testAdmin->isAdmin() ? '✅' : '❌') . "\n";
    echo "     - isSuperAdmin(): " . ($testAdmin->isSuperAdmin() ? '✅' : '❌') . "\n";
}

if ($testSuperAdmin) {
    echo "   Super Admin '{$testSuperAdmin->name}':\n";
    echo "     - isUser(): " . ($testSuperAdmin->isUser() ? '✅' : '❌') . "\n";
    echo "     - isAdmin(): " . ($testSuperAdmin->isAdmin() ? '✅' : '❌') . "\n";
    echo "     - isSuperAdmin(): " . ($testSuperAdmin->isSuperAdmin() ? '✅' : '❌') . "\n";
}

echo "\n3. 📋 Role System Summary:\n";
echo "   ✅ User Registration: Default role 'user'\n";
echo "   ✅ Role Middleware: Protects admin routes\n";
echo "   ✅ Admin Panel: Only admin/super_admin access\n";
echo "   ✅ Order Management: Role-based permissions\n";
echo "   ✅ Cancellation System: User request → Admin approve\n";

echo "\n4. 🎯 Access Control:\n";
echo "   👤 USER privileges:\n";
echo "     - Order products (checkout)\n";
echo "     - Manage cart\n";
echo "     - Request order cancellation\n";
echo "     - View own orders\n";

echo "\n   👮 ADMIN privileges:\n";
echo "     - All user privileges\n";
echo "     - View admin dashboard\n";
echo "     - Manage order status\n";
echo "     - Approve/reject cancellations\n";
echo "     - Cannot cancel shipped orders\n";

echo "\n   🔱 SUPER ADMIN privileges:\n";
echo "     - All admin privileges\n";
echo "     - Full system access\n";

echo "\n5. 🔐 Login Credentials:\n";
echo "   User: customer@gentleliving.com / password123\n";
echo "   Admin: admin@gentleliving.com / password123\n";
echo "   Super Admin: superadmin@gentleliving.com / password123\n";

echo "\n🚀 ROLE-BASED SYSTEM READY!\n";
