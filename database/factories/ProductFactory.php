<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(),
            'price_cents' => $this->faker->numberBetween(500, 50000),
            'is_active' => true,
        ];
    }
}
