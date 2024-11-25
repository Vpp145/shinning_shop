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

            $category_products = Product::with(['brand', 'images'])->whereIn('category_id', $category_details['catIds'])->where('status', 1)->paginate(1);
            // dd($category_details);
            return view('front.products.listing')->with(compact('category_products', 'category_details'));
        } else {
            abort(404);
        }
    }
}
