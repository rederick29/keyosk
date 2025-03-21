<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order\OrderStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', OrderStatus::getEnumValues())->default('pending');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id', 'idx_orders_u_id');
            $table->string('email');
            $table->foreignId('address_id')->constrained('addresses', 'id', 'idx_orders_a_id');
            $table->decimal('total_price', 8, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
