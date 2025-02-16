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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'id', 'idx_orders_products_o_id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'id', 'idx_orders_products_p_id')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
