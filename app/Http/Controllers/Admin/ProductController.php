<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Session;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with('category')->get()->toArray();

        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        Product::where(['id' => $id])->delete();
        return redirect()->back()->with('success_message', 'product deleted successfully!!');
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == '') {
            $title = "Add product";
            $product = new Product();
            $message = 'product added successfully';
        } else {
            $title = "Edit product";
            $product = Product::find($id);
            $message = 'product updated successfully';
        }

        $get_categories = Category::getCategories();
        $product_filters = Product::productFilters();

        return view('admin.products.add-edit-product')->with(compact('title', 'get_categories', 'product_filters', 'product'));
    }
}
