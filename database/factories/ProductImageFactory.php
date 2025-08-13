<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'url' => $this->faker->imageUrl(600, 600, 'product', true),
            'is_main' => false,
        ];
    }
}
