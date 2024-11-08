<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Session;
use Validator;

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
            $pd = array();
            $message = 'product added successfully';
        } else {
            $title = "Edit product";
            $product = Product::find($id);
            $message = 'product updated successfully';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules =[
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' =>'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[pL\s\-]+$/u',
                'family_color' => 'required|regex:/^[pL\s\-]+$/u',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Name is required',
                'product_name.regex' => 'Valid name is required',
                'product_code.required' => 'Code is required',
                'product_code.regex' => 'Valid code is required',
                'product_price.required' => 'Price is required',
                'product_price.numeric' => 'Valid price is required',
                'product_color.required' => 'Color is required',
                'product_color.regex' => 'Valid color is required',
                'family_color.required' => 'Family color is required',
                'family_color.regex' => 'Valid family color is required',
            ];
            $request->validate($rules, $customMessages);

            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->family_color = $data['family_color'];
            $product->group_code = $data['group_code'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->discount_type = $data['discount_type'] ?? '';
            $product->final_price = $data['final_price'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'] ?? '';
            $product->wash_care = $data['wash_care'] ?? '';
            $product->search_keywords = $data['search_keywords'] ?? '';
            $product->fabric = $data['fabric'] ?? '';
            $product->sleeve = $data['sleeve'] ?? '';
            $product->pattern = $data['pattern'] ?? '';
            $product->fit = $data['fit'] ?? '';
            $product->occasion = $data['occasion'] ?? '';
            $product->meta_title = $data['meta_title'] ?? '';
            $product->meta_description = $data['meta_description'] ?? '';
            $product->meta_keywords = $data['meta_keywords'] ?? '';
            if(!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = 'no';
            }
            $product->status = 1;
            $product->save();

            return redirect('admin/products')->with('success_message', $message);
        }

        $get_categories = Category::getCategories();
        $product_filters = Product::productFilters();

        return view('admin.products.add-edit-product')->with(compact('title', 'get_categories', 'product_filters', 'product'));
    }
}
