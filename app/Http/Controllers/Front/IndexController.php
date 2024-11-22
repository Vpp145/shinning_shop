<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $home_banners = Banner::where('type', 'slider')->orderby('sort', 'asc')->where('status', 1)->get()->toArray();
        $home_fix_banners = Banner::where('type', 'fix')->orderby('sort', 'asc')->where('status', 1)->get()->toArray();
        return view('front.index')->with(compact('home_banners', 'home_fix_banners'));
    }
}
