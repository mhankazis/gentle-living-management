<?php

namespace Database\Seeders;

use App\Models\MasterUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        MasterUser::create([
            'company_id' => 1,
            'name' => 'Super Administrator',
            'email' => 'superadmin@gentleliving.com',
            'phone' => '08123456789',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        // Create Admin
        MasterUser::create([
            'company_id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@gentleliving.com',
            'phone' => '08123456788',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create Regular User
        MasterUser::create([
            'company_id' => 1,
            'name' => 'Customer User',
            'email' => 'customer@gentleliving.com',
            'phone' => '08123456787',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        echo "✅ Admin users created:\n";
        echo "- Super Admin: superadmin@gentleliving.com / password123\n";
        echo "- Admin: admin@gentleliving.com / password123\n";
        echo "- User: customer@gentleliving.com / password123\n";
    }
}
