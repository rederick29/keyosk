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
        Schema::create('attributes_products', function (Blueprint $table) {
            $table->foreignId('attribute_id')->constrained('attribute_tags', 'id', 'idx_attributes_products_a_id');
            $table->foreignId('product_id')->constrained('products', 'id', 'idx_attributes_products_p_id');
            $table->timestamps();

            $table->primary(['attribute_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes_products');
    }
};
