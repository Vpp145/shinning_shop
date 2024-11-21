<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsRole;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductsImage;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Validator;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with('category')->get()->toArray();

        $admin_id = Auth::guard('admin')->user()->id;
        $module_count = AdminsRole::where(['subadmin_id' => $admin_id, 'module' => 'products'])->count();
        $products_module = array();

        if (Auth::guard('admin')->user()->type == 'admin') {
            $products_module['view_access'] = 1;
            $products_module['edit_access'] = 1;
            $products_module['full_access'] = 1;
        } else {
            if ($module_count == 0) {
                $message = 'This feature is restricted to this Sub Admins';
                return redirect('admin/dashboard')->with('error_message', $message);
            }

            $products_module = AdminsRole::where(['subadmin_id' => $admin_id, 'module' => 'products'])->first()->toArray();
        }

        return view('admin.products.products')->with(compact('products', 'products_module'));
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
        Product::where('id', $id)->delete();
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
            $product = Product::with(['images', 'attributes'])->find($id);
            $message = 'product updated successfully';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'family_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'brand_id.required' => 'Brand is required',
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

            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    $extension = $video_tmp->getClientOriginalExtension();
                    $video_name = rand(111, 99999) . '.' . $extension;
                    $video_path = public_path('front/video/products/');
                    $video_tmp->move($video_path, $video_name);
                    $product->product_video = $video_name;
                }
            }

            if (!isset($data['product_discount'])) {
                $data['product_discount'] = 0;
            }

            if (!isset($data['product_weight'])) {
                $data['product_weight'] = 0;
            }

            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->family_color = $data['family_color'];
            $product->group_code = $data['group_code'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];

            if (!empty($data['product_discount']) && $data['product_discount'] > 0) {
                $product->discount_type = 'product';
                $product->final_price = $data['product_price'] - ($data['product_price'] * $data['product_discount']) / 100;
            } else {
                $get_category_discount = Category::select('category_discount')->where('id', $data['category_id'])->first();
                if ($get_category_discount) {
                    $product->discount_type = '';
                    $product->final_price = $data['product_price'] - ($data['product_price'] * $get_category_discount->category_discount) / 100;
                }
            }

            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->search_keywords = $data['search_keywords'];
            $product->fabric = $data['fabric'] || '';
            $product->sleeve = $data['sleeve'] || '';
            $product->pattern = $data['pattern'] || '';
            $product->fit = $data['fit'] || '';
            $product->occasion = $data['occasion'] || '';
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = 'no';
            }
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            } else {
                $product->is_bestseller = 'no';
            }
            $product->status = 1;
            $product->save();

            //get the product id
            $product_id = $id ?? DB::getPdo()->lastInsertId(); // Use $id if available, otherwise fetch last inserted ID

            // Check if $product_id is a valid integer
            if (empty($product_id)) {
                return response()->json(['error' => 'Product ID is missing'], 400);
            }

            if ($request->hasFile('products_images')) {
                $images = $request->file('products_images');
                foreach ($images as $key => $image) {
                    $image_tmp = Image::make($image);
                    $extension = $image->getClientOriginalExtension();
                    $image_name = 'product-' . rand(1111, 999999) . '.' . $extension;

                    $large_image_path = public_path('front/images/products/large/' . $image_name);
                    $medium_image_path = public_path('front/images/products/medium/' . $image_name);
                    $small_image_path = public_path('front/images/products/small/' . $image_name);

                    Image::make($image_tmp)->resize(1040, 1200)->save($large_image_path);
                    Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260, 300)->save($small_image_path);

                    $image = new ProductsImage;
                    $image->product_id = $product_id;
                    $image->image = $image_name;
                    $image->status = 1;
                    $image->save();
                }
            }

            if ($id != '') {
                if (isset($data['image'])) {
                    foreach ($data['image'] as $key => $image) {
                        ProductsImage::where(['product_id' => $id, 'image' => $image])->update(['image_sort' => $data['image_sort'][$key]]);
                    }
                }
            }

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    $count_sku = ProductAttribute::where('sku', $value)->count();
                    if ($count_sku > 0) {
                        $message = 'Product SKU already exists!!';
                        return redirect()->back()->with('error_message', $message);
                    }

                    $count_size = ProductAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($count_size > 0) {
                        $message = 'Product size already exists!!';
                        return redirect()->back()->with('error_message', $message);
                    }

                    $product_attribute = new ProductAttribute;
                    $product_attribute->product_id = $id;
                    $product_attribute->sku = $value;
                    $product_attribute->size = $data['size'][$key];
                    $product_attribute->price = $data['price'][$key];
                    $product_attribute->stock = $data['stock'][$key];
                    $product_attribute->status = 1;
                    $product_attribute->save();
                }
            }

            if (isset($data['attrId'])) {
                foreach ($data['attrId'] as $attr) {
                    if (!empty($attr)) {
                        ProductAttribute::where(['id' => $attr])->update([
                            'price' => $data['price'][$attr] ?? 0,
                            'stock' => $data['stock'][$attr] ?? 0
                        ]);
                    }
                }
            }

            return redirect('admin/products')->with('success_message', $message);
        }

        $get_categories = Category::getCategories();
        $product_filters = Product::productFilters();

        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands), true);

        return view('admin.products.add-edit-product')->with(compact('title', 'get_categories', 'product_filters', 'product', 'brands'));
    }

    public function deleteProductVideo($id)
    {
        $product_video = Product::select('product_video')->where('id', $id)->first();

        $product_video_path = public_path('front/video/products/');

        if (file_exists($product_video_path . $product_video->product_video)) {
            unlink($product_video_path . $product_video->product_video);
        }

        Product::where('id', $id)->update(['product_video' => '']);

        $message = 'Product video deleted successfully!!';
        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductImage($id)
    {
        $product_image = ProductsImage::select('image')->where('id', $id)->first();

        $large_image_path = public_path('front/images/products/large/');
        $medium_image_path = public_path('front/images/products/medium/');
        $small_image_path = public_path('front/images/products/small/');

        if (file_exists($large_image_path . $product_image->image)) {
            unlink($large_image_path . $product_image->image);
        }
        if (file_exists($medium_image_path . $product_image->image)) {
            unlink($medium_image_path . $product_image->image);
        }
        if (file_exists($small_image_path . $product_image->image)) {
            unlink($small_image_path . $product_image->image);
        }

        ProductsImage::where('id', $id)->delete();

        $message = 'Product image deleted successfully!!';
        return redirect()->back()->with('success_message', $message);
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'id' => $data['attribute_id']]);
        }
    }

    public function deleteAttribute($id)
    {
        ProductAttribute::where('id', $id)->delete();
        $message = 'Product attribute deleted successfully!!';
        return redirect()->back()->with('success_message', $message);
    }
}
