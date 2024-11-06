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
        Schema::create('colours_products', function (Blueprint $table) {
            $table->foreignId('colour_id')->constrained('colour_tags', 'id', 'idx_colours_products_c_id');
            $table->foreignId('product_id')->constrained('products', 'id', 'idx_colours_products_p_id');
            $table->timestamps();

            $table->primary(['colour_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colours_products');
    }
};
