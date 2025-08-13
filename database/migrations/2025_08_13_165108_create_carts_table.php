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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->uuid('guest_token')->nullable()->unique();
            $table->string('currency', 3)->default('MMK');

            // money breakdown (minor units)
            $table->integer('subtotal_cents')->default(0);
            $table->integer('discount_cents')->default(0);
            $table->integer('tax_cents')->default(0);
            $table->integer('shipping_cents')->default(0);
            $table->integer('total_cents')->default(0);

            $table->enum('status', ['active','converted','abandoned'])->default('active');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['user_id','status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
