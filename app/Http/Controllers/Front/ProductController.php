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

            // Prepare the query
            $category_products = Product::with(['brand', 'images'])
                ->whereIn('category_id', $category_details['catIds'])
                ->where('status', 1);

            // Sorting logic
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                switch ($_GET['sort']) {
                    case 'product_latest':
                        $category_products->orderby('created_at', 'desc');
                        break;
                    case 'lowest_price':
                        $category_products->orderby('final_price', 'asc');
                        break;
                    case 'highest_price':
                        $category_products->orderby('final_price', 'desc');
                        break;
                    case 'best_selling':
                        $category_products->where('is_bestseller', 'yes');
                        break;
                    case 'featured_items':
                        $category_products->where('is_featured', 'yes');
                        break;
                    case 'discounted_items':
                        $category_products->where('product_discount', '>', 0);
                        break;
                    default:
                        $category_products->orderby('created_at', 'desc');
                        break;
                }
            }

            // Filter by color
            if (isset($_GET['color']) && !empty($_GET['color'])) {
                $colors = explode('~', $_GET['color']);
                $category_products->whereIn('family_color', $colors);
            }

            // Filter by size
            if (isset($_GET['size']) && !empty($_GET['size'])) {
                $sizes = explode('~', $_GET['size']);
                $category_products->whereHas('attributes', function ($query) use ($sizes) {
                    $query->whereIn('size', $sizes);
                });
            }

            // Pagination
            $category_products = $category_products->paginate(8);

            return view('front.products.listing')->with(compact('category_products', 'category_details', 'url'));
        } else {
            abort(404);
        }
    }
}
