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
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id('order_item_id');
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('item_id');
                $table->string('item_name');
                $table->decimal('item_price', 10, 2);
                $table->integer('quantity');
                $table->decimal('subtotal', 10, 2);
                $table->timestamps();
                
                $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
                $table->foreign('item_id')->references('item_id')->on('master_items')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
