<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->with('parentCategory');
    }

    public static function productFilters()
    {
        $product_filters['fabric_array'] = array('cotton', 'polyester', 'wool');
        $product_filters['sleeve_array'] = array('full', 'half', 'short', 'none');
        $product_filters['fit_array'] = array('regular', 'slim');
        $product_filters['pattern_array'] = array('checked', 'plain', 'print', 'solid', 'self');
        $product_filters['occasion_array'] = array('casual', 'formal');

        return $product_filters;
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImage');
    }
}
