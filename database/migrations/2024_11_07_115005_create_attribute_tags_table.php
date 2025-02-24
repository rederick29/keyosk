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
        Schema::create('attribute_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('tags', 'id', 'idx_attribute_tags_t_id');
            // nullable as the name of this type of tag can be self-explanatory
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_tags');
    }
};
