<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the table exists and if the role column doesn't already exist
        if (Schema::hasTable('master_users') && !Schema::hasColumn('master_users', 'role')) {
            Schema::table('master_users', function (Blueprint $table) {
                $table->enum('role', ['user', 'admin', 'super_admin'])->default('user')->after('phone');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
