<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->bothify('SAVE##')),
            'discount_percent' => $this->faker->numberBetween(5, 50),
            'expires_at' => now()->addDays(rand(10, 60)),
        ];
    }
}
