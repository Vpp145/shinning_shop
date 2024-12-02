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
}
