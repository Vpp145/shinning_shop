<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category;
        $category->parent_id = NULL;
        $category->category_name = 'Clothing';
        $category->category_image = '';
        $category->category_discount = 0;
        $category->description = '';
        $category->url = 'clothing';
        $category->meta_title = '';
        $category->meta_description = '';
        $category->meta_keywords = '';
        $category->status = 1;
        $category->save();

        $category = new Category;
        $category->parent_id = NULL;
        $category->category_name = 'Electronics';
        $category->category_image = '';
        $category->category_discount = 0;
        $category->description = '';
        $category->url = 'electronics';
        $category->meta_title = '';
        $category->meta_description = '';
        $category->meta_keywords = '';
        $category->status = 1;
        $category->save();

        $category = new Category;
        $category->parent_id = NULL;
        $category->category_name = 'Appliances';
        $category->category_image = '';
        $category->category_discount = 0;
        $category->description = '';
        $category->url = 'appliances';
        $category->meta_title = '';
        $category->meta_description = '';
        $category->meta_keywords = '';
        $category->status = 1;
        $category->save();
    }
}
