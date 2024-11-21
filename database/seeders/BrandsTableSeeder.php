<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand_records = [
            ['brand_name' => 'Arrow', 'brand_image' => '', 'brand_logo' => '', 'brand_discount' => 0, 'description' => '', 'url' => 'arrow', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
            ['brand_name' => 'Gap', 'brand_image' => '', 'brand_logo' => '', 'brand_discount' => 0, 'description' => '', 'url' => 'gap', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
            ['brand_name' => 'Lee', 'brand_image' => '', 'brand_logo' => '', 'brand_discount' => 0, 'description' => '', 'url' => 'lee', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
            ['brand_name' => 'Monte Carlo', 'brand_image' => '', 'brand_logo' => '', 'brand_discount' => 0, 'description' => '', 'url' => 'monte-carlo', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
            ['brand_name' => 'Peter England', 'brand_image' => '', 'brand_logo' => '', 'brand_discount' => 0, 'description' => '', 'url' => 'peter-england', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
        ];

        Brand::insert($brand_records);
    }
}
