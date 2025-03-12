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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id', 'idx_addresses_u_id');
            // person/company's name on delivery
            $table->string('name');
            $table->string('line_one', 200);
            $table->string('line_two', 200)->nullable();
            $table->string('city', 100);
            $table->string('postcode', 20);
            $table->foreignId('country_id')->constrained('countries', 'id', 'idx_addresses_c_id');
            $table->smallInteger('priority')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
            // must set priority to null once soft deleted
            $table->unique(['user_id', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
