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
            // Add status columns for order management only if they don't exist
            if (!Schema::hasColumn('transaction_sales', 'status')) {
                $table->string('status', 50)->default('pending')->after('user_id');
            }
            if (!Schema::hasColumn('transaction_sales', 'payment_status')) {
                $table->string('payment_status', 50)->default('unpaid')->after('status');
            }
            if (!Schema::hasColumn('transaction_sales', 'customer_name')) {
                $table->string('customer_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('transaction_sales', 'customer_phone')) {
                $table->string('customer_phone')->nullable()->after('customer_name');
            }
            if (!Schema::hasColumn('transaction_sales', 'customer_address')) {
                $table->text('customer_address')->nullable()->after('customer_phone');
            }
            if (!Schema::hasColumn('transaction_sales', 'cancellation_requested_at')) {
                $table->timestamp('cancellation_requested_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_sales', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'payment_status',
                'customer_name',
                'customer_phone', 
                'customer_address',
                'cancellation_requested_at'
            ]);
        });
    }
};
