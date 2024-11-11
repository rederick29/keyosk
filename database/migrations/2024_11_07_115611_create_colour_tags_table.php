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
        Schema::create('colour_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('tags', 'id', 'idx_colour_tags_t_id');
            $table->string('hex_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colour_tags');
    }
};
