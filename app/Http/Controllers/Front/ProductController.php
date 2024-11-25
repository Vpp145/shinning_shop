<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listing()
    {
        $url = Route::getFacadeRoot()->current()->uri();
        $category_count = Category::where(['url' => $url, 'status' => 1])->count();
        if ($category_count > 0) {
            $category_details = Category::categoryDetails($url);

            $category_products = Product::with(['brand', 'images'])->whereIn('category_id', $category_details['catIds'])->where('status', 1);
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                if ($_GET['sort'] == 'product_latest') {
                    $category_products->orderby('created_at', 'desc');
                } else if ($_GET['sort'] == 'lowest_price') {
                    $category_products->orderby('final_price', 'asc');
                } else if ($_GET['sort'] == 'highest_price') {
                    $category_products->orderby('final_price', 'desc');
                } else if ($_GET['sort'] == 'best_selling') {
                    $category_products->where('is_bestseller', 'yes');
                } else if ($_GET['sort'] == 'featured_items') {
                    $category_products->where('is_featured', 'yes');
                } else if ($_GET['sort'] == 'discounted_items') {
                    $category_products->where('product_discount', '>', 0);
                } else {
                    $category_products->orderby('created_at', 'desc');
                }
            }
            $category_products = $category_products->paginate(8);

            return view('front.products.listing')->with(compact('category_products', 'category_details', 'url'));
        } else {
            abort(404);
        }
    }
}
