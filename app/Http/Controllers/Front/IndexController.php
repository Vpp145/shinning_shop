<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $home_banners = Banner::where('type', 'slider')->orderby('sort', 'asc')->where('status', 1)->get()->toArray();
        $home_fix_banners = Banner::where('type', 'fix')->orderby('sort', 'asc')->where('status', 1)->get()->toArray();
        $new_products = Product::with(['brand', 'images'])->orderBy('id', 'desc')->where('status', 1)->limit(4)->get()->toArray();
        $best_sellers = Product::with(['brand', 'images'])->orderBy('id', 'desc')->where(['is_bestseller' => 'yes', 'status' => 1])->limit(4)->get()->toArray();
        return view('front.index')->with(compact('home_banners', 'home_fix_banners', 'new_products', 'best_sellers'));
    }
}
