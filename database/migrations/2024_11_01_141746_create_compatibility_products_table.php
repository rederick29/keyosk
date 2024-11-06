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
        Schema::create('compatibility_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compatibility_id')->constrained('compatibility_tags', 'id', 'idx_compatibility_products_c_id');
            $table->foreignId('product_id')->constrained('products', 'id', 'idx_compatibility_products_p_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compatibility_products');
    }
};
