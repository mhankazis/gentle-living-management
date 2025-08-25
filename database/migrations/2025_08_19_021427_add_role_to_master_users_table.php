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
        Schema::table('master_users', function (Blueprint $table) {
            if (!Schema::hasColumn('master_users', 'role')) {
                $table->enum('role', ['user', 'admin', 'super_admin'])->default('user')->after('phone');
            }
        });
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
