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
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_sales_id');
            $table->string('old_status', 50);
            $table->string('new_status', 50);
            $table->unsignedBigInteger('changed_by');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('transaction_sales_id')->references('transaction_sales_id')->on('transaction_sales')->onDelete('cascade');
            $table->index(['transaction_sales_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_logs');
    }
};
