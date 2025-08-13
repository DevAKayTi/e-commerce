<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponRedemptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'coupon_id' => Coupon::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
