<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banner_records = [
            ['type' => 'slider', 'image' => '', 'link' => '', 'title' => 'T Shirts Collection', 'alt' => 't-shirts collection', 'sort' => 1, 'status' => 1],
            ['type' => 'slider', 'image' => '', 'link' => '', 'title' => 'Women Collection', 'alt' => 'women collection', 'sort' => 1, 'status' => 1]
        ];

        Banner::insert($banner_records);
    }
}
