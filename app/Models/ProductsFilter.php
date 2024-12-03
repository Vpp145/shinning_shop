<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ProductsFilter extends Model
{
    use HasFactory;

    public static function get_colors($catIds)
    {
        $get_productIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id')->toArray();
        $get_product_colors = Product::select('family_color')->whereIn('id', $get_productIds)->groupBy('family_color')->pluck('family_color')->toArray();

        return $get_product_colors;
    }

    public static function get_sizes($catIds)
    {
        $get_productIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id')->toArray();
        $get_product_sizes = ProductAttribute::select('size')->where('status', 1)->whereIn('product_id', $get_productIds)->groupBy('size')->pluck('size');

        return $get_product_sizes;
    }

    public static function get_brands($catIds)
    {
        $get_productIds = Product::select('id')->whereIn('category_id', $catIds)->pluck('id');
        $get_product_brands_ids = Product::select('brand_id')->whereIn('id', $get_productIds)->groupBy('brand_id')->pluck('brand_id');
        $get_product_brands = Brand::select('id', 'brand_name')->where('status', 1)->whereIn('id', $get_product_brands_ids)->orderby('brand_name', 'ASC')->get()->toArray();

        return $get_product_brands;
    }
}
