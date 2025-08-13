<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class DemoEcommerceSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(5)
            ->has(
                Product::factory(10)
                    ->has(ProductVariant::factory(3), 'variants')
                    ->has(ProductImage::factory(2), 'images')
            )
            ->create();
    }
}
