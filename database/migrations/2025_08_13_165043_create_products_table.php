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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // public-safe id
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // creator/owner
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('has_variants')->default(false);
            // If no variants, you can still sell using base price
            $table->integer('price_cents')->nullable();
            $table->integer('compare_at_price_cents')->nullable();
            $table->string('currency', 3)->default('MMK');
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->json('options')->nullable(); // e.g. ["Size","Color"] if using variants
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
