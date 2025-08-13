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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained()->cascadeOnDelete();

            $table->unsignedInteger('quantity')->default(1);
            $table->integer('unit_price_cents');
            $table->integer('total_cents');

            // denormalized snapshot to keep item name/img even if product changes
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('image_url')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->unique(['cart_id','product_variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
