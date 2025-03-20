<?php

use App\Models\Subscription\SubscriptionTiers;
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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('tier', SubscriptionTiers::getEnumValues())->default(SubscriptionTiers::Plus);
            $table->foreignId('user_id')->constrained('users', 'id', 'idx_subscriptions_u_id')->onDelete('cascade');
            $table->timestamp('started_at');
            $table->timestamp('ends_at');
            $table->timestamps();
            $table->unique(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
