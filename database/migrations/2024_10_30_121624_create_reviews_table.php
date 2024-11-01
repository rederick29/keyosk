<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->float('rating');
            $table->string('subject')->nullable();
            $table->string('body')->nullable();
            $table->foreignId('user_id')->constrained('users', 'id', 'idx_reviews_u_id');
            $table->foreignId('product_id')->constrained('products', 'id', 'idx_reviews_p_id');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE reviews ADD CONSTRAINT chk_rating_range CHECK (rating >= 0.0 AND rating <= 5.0)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
