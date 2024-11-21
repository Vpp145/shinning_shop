<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['product_id' => 1, 'sku' => 'BTS001-S', 'size' => 'Small', 'price' => 1500, 'stock' => 10, 'status' => 1],
            ['product_id' => 1, 'sku' => 'BTS001-M', 'size' => 'Medium', 'price' => 1600, 'stock' => 20, 'status' => 1],
            ['product_id' => 1, 'sku' => 'BTS001-L', 'size' => 'Large', 'price' => 1700, 'stock' => 10, 'status' => 1],
        ];

        ProductAttribute::insert($attributes);
    }
}
