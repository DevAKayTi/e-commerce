<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'amount_cents' => $this->faker->numberBetween(1000, 50000),
            'status' => 'completed',
            'payment_method' => $this->faker->randomElement(['card', 'paypal', 'bank_transfer']),
        ];
    }
}
