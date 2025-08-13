<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_variant_id' => ProductVariant::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price_cents' => $this->faker->numberBetween(500, 50000),
        ];
    }
}
