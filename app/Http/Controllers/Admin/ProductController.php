<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    public function products() {
        Session::put('page', 'products');
        $products = Product::with('category')->get()->toArray();

        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id) {
        Product::where(['id' => $id])->delete();
        return response()->back()->with('success_message', 'product deleted successfully!!');
    }
}