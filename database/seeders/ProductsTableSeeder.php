<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = new Product();
        $product->category_id = 8;
        $product->brand_id = null;
        $product->product_name = 'Blue T-Shirt';
        $product->product_code = 'BT001';
        $product->product_color = 'Dark Blue';
        $product->family_color = 'Blue';
        $product->group_code = 'BT000';
        $product->product_price = 1500;
        $product->product_discount = 10;
        $product->discount_type = '';
        $product->final_price = 1350;
        $product->product_weight = 500;
        $product->product_video = '';
        $product->description = 'Blue T-Shirt';
        $product->wash_care = '';
        $product->search_keywords = '';
        $product->fabric = '';
        $product->pattern = '';
        $product->sleeve = '';
        $product->fit = '';
        $product->occasion = '';
        $product->meta_title = '';
        $product->meta_description = '';
        $product->meta_keywords = '';
        $product->is_featured = 'no';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->category_id = 8;
        $product->brand_id = null;
        $product->product_name = 'Red T-Shirt';
        $product->product_code = 'RT001';
        $product->product_color = 'Red';
        $product->family_color = 'Red';
        $product->group_code = 'RT000';
        $product->product_price = 2000;
        $product->product_discount = 0;
        $product->discount_type = '';
        $product->final_price = 2000;
        $product->product_weight = 400;
        $product->product_video = '';
        $product->description = 'Red T-Shirt';
        $product->wash_care = '';
        $product->search_keywords = '';
        $product->fabric = '';
        $product->pattern = '';
        $product->sleeve = '';
        $product->fit = '';
        $product->occasion = '';
        $product->meta_title = '';
        $product->meta_description = '';
        $product->meta_keywords = '';
        $product->is_featured = 'yes';
        $product->status = 1;
        $product->save();
    }
}
