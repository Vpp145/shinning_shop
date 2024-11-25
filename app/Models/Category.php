<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parentCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id')->select('id', 'category_name', 'url')->orderby('id', 'ASC')->where('status', 1);
    }

    public function subCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->select('id', 'category_name', 'parent_id', 'url')->where('status', 1);
    }

    public static function getCategories()
    {
        $get_categories = Category::with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])->where('parent_id', NULL)->where('status', 1)->get()->toArray();
        return $get_categories;
    }

    public static function categoryDetails($url)
    {
        $category_details = Category::select('id', 'category_name', 'url', 'parent_id')->with(['subCategories' => function ($query) {
            $query->with('subCategories');
        }])->where('url', $url)->first()->toArray();
        $catIds = array();
        $catIds[] = $category_details['id'];
        foreach ($category_details['sub_categories'] as $subCategory) {
            $catIds[] = $subCategory['id'];
            foreach ($subCategory['sub_categories'] as $subSubCategory) {
                $catIds[] = $subSubCategory['id'];
            }
        }

        if ($category_details['parent_id'] == 0) {
            $breadcrumbs = '<a class="gl-tag btn--e-brand-shadow" href="' . url($category_details['url']) . '">' . $category_details['category_name'] . '</a>';
        } else {
            $parent_category = Category::select('category_name', 'url')->where('id', $category_details['parent_id'])->first()->toArray();
            $breadcrumbs = '<a class="gl-tag btn--e-brand-shadow" href="' . url($parent_category['url']) . '">' . $parent_category['category_name'] . '</a> <a class="gl-tag btn--e-brand-shadow" href="' . url($category_details['url']) . '">' . $category_details['category_name'] . '</a>';
        }

        $resp = array('catIds' => $catIds, 'category_details' => $category_details, 'breadcrumbs' => $breadcrumbs);
        return $resp;
    }
}
