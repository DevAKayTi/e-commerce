<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => null,
            'address_id' => Address::factory(),
            'status' => 'pending',
            'total_cents' => $this->faker->numberBetween(1000, 50000),
        ];
    }
}
