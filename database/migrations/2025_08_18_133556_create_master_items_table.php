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
        Schema::create('master_items', function (Blueprint $table) {
            $table->id('item_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name_item');
            $table->text('description_item')->nullable();
            $table->text('ingredient_item')->nullable();
            $table->string('netweight_item')->nullable();
            $table->string('contain_item')->nullable();
            $table->decimal('costprice_item', 15, 2);
            $table->decimal('sell_price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('unit_item')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('category_id')->references('category_id')->on('master_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_items');
    }
};
