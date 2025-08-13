<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'sku' => strtoupper($this->faker->bothify('SKU-#####')),
            'title' => $this->faker->word(),
            'price_cents' => $this->faker->numberBetween(500, 50000),
            'compare_at_price_cents' => $this->faker->numberBetween(500, 50000),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
