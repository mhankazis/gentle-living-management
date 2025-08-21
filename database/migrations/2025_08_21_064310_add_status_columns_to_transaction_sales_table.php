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
            // Add status columns for order management
            $table->string('status', 50)->default('pending')->after('user_id');
            $table->string('payment_status', 50)->default('unpaid')->after('status');
            $table->string('customer_name')->nullable()->after('customer_id');
            $table->string('customer_phone')->nullable()->after('customer_name');
            $table->text('customer_address')->nullable()->after('customer_phone');
            $table->timestamp('cancellation_requested_at')->nullable()->after('deleted_at');
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
