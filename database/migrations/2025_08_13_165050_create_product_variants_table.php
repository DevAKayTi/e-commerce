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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('title')->nullable(); // e.g., "XL / Red"
            $table->integer('price_cents');
            $table->integer('compare_at_price_cents')->nullable();
            $table->integer('cost_cents')->nullable();
            $table->string('currency', 3)->default('MMK');
            $table->integer('weight_g')->nullable();
            $table->integer('length_mm')->nullable();
            $table->integer('width_mm')->nullable();
            $table->integer('height_mm')->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('is_default')->default(false);
            $table->unsignedInteger('position')->default(0);
            $table->json('option_values')->nullable(); // e.g., {"Size":"XL","Color":"Red"}
            $table->timestamps();

            $table->index(['product_id', 'is_default']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
