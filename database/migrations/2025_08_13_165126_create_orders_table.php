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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('cart_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_number')->unique();
            $table->string('currency', 3)->default('MMK');

            $table->enum('status', ['pending','confirmed','paid','fulfilled','cancelled','refunded'])->default('pending');

            // money totals in minor units
            $table->integer('subtotal_cents');
            $table->integer('discount_cents')->default(0);
            $table->integer('tax_cents')->default(0);
            $table->integer('shipping_cents')->default(0);
            $table->integer('total_cents');

            // snapshots
            $table->json('shipping_address')->nullable();
            $table->json('billing_address')->nullable();

            $table->timestamp('placed_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->index(['user_id','status']);
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
