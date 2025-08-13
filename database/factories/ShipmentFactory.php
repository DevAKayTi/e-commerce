<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'tracking_number' => strtoupper($this->faker->bothify('TRACK#######')),
            'carrier' => $this->faker->company(),
            'status' => 'shipped',
        ];
    }
}
