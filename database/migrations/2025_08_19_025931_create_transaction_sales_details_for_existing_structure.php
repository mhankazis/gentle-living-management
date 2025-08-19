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
        Schema::create('transaction_sales_details', function (Blueprint $table) {
            $table->id('transaction_sales_detail_id');
            $table->unsignedBigInteger('transaction_sales_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->decimal('product_price', 12, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transaction_sales_id')->references('transaction_sales_id')->on('transaction_sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('master_items')->onDelete('cascade');
            $table->index('transaction_sales_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_sales_details');
    }
};
