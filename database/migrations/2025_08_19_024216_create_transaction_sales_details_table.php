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
            $table->id();
            $table->unsignedBigInteger('transaction_sales_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name'); // Store nama produk saat transaksi
            $table->decimal('product_price', 12, 2); // Store harga produk saat transaksi
            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('transaction_sales_id')->references('id')->on('transaction_sales')->onDelete('cascade');
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
