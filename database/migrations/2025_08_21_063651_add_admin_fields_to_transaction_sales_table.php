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
        Schema::table('transaction_sales', function (Blueprint $table) {
            // Admin management fields
            $table->text('admin_notes')->nullable()->after('notes');
            $table->text('payment_notes')->nullable()->after('admin_notes');
            $table->unsignedBigInteger('updated_by')->nullable()->after('payment_notes');
            $table->unsignedBigInteger('payment_updated_by')->nullable()->after('updated_by');
            $table->timestamp('status_updated_at')->nullable()->after('payment_updated_by');
            $table->timestamp('payment_updated_at')->nullable()->after('status_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_sales', function (Blueprint $table) {
            $table->dropColumn([
                'admin_notes',
                'payment_notes', 
                'updated_by',
                'payment_updated_by',
                'status_updated_at',
                'payment_updated_at'
            ]);
        });
    }
};
