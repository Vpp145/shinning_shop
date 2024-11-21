<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsRole;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Validator;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'brands');
        $brands = Brand::get();
        $module_count = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'brands'])->count();
        $brands_module = array();

        if (Auth::guard('admin')->user()->type == 'admin') {
            $brands_module['view_access'] = 1;
            $brands_module['edit_access'] = 1;
            $brands_module['full_access'] = 1;
        } else {
            if ($module_count == 0) {
                $message = 'This feature is restricted to this Sub Admins';
                return redirect('admin/dashboard')->with('error_message', $message);
            }
            $brands_module = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'brands'])->first()->toArray();
        }

        return view('admin.brands.brands')->with(compact('brands', 'brands_module'));
    }

    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    public function deleteBrand($id)
    {
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Brand deleted successfully!!');
    }

    public function addEditBrand(Request $request, $id = null)
    {
        Session::put('page', 'brands');
        if ($id == '') {
            $title = 'Add Brand';
            $brand = new Brand();
            $message = 'Brand added successfully';
        } else {
            $title = 'Edit Brand';
            $brand = Brand::find($id);
            $message = 'Brand updated successfully';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($id == '') {
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required|unique:brands',
                ];
            } else {
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required',
                ];
            }

            $customMessages = [
                'brand_name.required' => 'Brand name is required',
                'url.required' => 'URL is required',
                'url.unique' => 'URL already exists',
            ];
            $request->validate($rules, $customMessages);

            if ($request->hasFile('brand_image')) {
                $image_tmp = $request->file('brand_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('front/images/brands/' . $image_name);
                    Image::make($image_tmp)->save($image_path);
                    $brand->brand_image = $image_name;
                }
            } else {
                $brand->brand_image = '';
            }

            if ($request->hasFile('brand_logo')) {
                $image_tmp = $request->file('brand_logo');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111, 99999) . '.' . $extension;
                    $image_path = public_path('front/images/brands/' . $image_name);
                    Image::make($image_tmp)->save($image_path);
                    $brand->brand_logo = $image_name;
                }
            } else {
                $brand->brand_logo = '';
            }

            if (empty($data['brand_discount'])) {
                $data['brand_discount'] = 0;
                if ($id != '') {
                    $brand_product = Product::where('brand_id', $id)->get()->toArray();
                    foreach ($brand_product as $product) {
                        if ($product['discount_type'] == 'brand') {
                            Product::where('id', $product['id'])->update(['discount_type' => '', 'final_price' => $product['product_price']]);
                        }
                    }
                }
            }

            $brand->brand_name = $data['brand_name'];
            $brand->brand_discount = $data['brand_discount'];
            $brand->description = $data['description'];
            $brand->url = $data['url'];
            $brand->meta_title = $data['meta_title'];
            $brand->meta_description = $data['meta_description'];
            $brand->meta_keywords = $data['meta_keywords'];
            $brand->status = 1;
            $brand->save();
            return redirect('admin/brands')->with('success_message', $message);
        }

        return view('admin.brands.add-edit-brand')->with(compact('title', 'brand'));
    }

    public function deleteBrandImage($id)
    {
        $brand_image = Brand::select('brand_image')->where('id', $id)->first();
        $brand_image_path = public_path('front/images/brands/');

        if (file_exists($brand_image_path . $brand_image->brand_image)) {
            unlink($brand_image_path . $brand_image->brand_image);
        }
        Brand::where('id', $id)->update(['brand_image' => '']);
        return redirect()->back()->with('success_message', 'Brand image deleted successfully!!');
    }

    public function deleteBrandLogo($id)
    {
        $brand_logo = Brand::select('brand_logo')->where('id', $id)->first();
        $brand_logo_path = public_path('front/images/brands/');

        if (file_exists($brand_logo_path . $brand_logo->brand_logo)) {
            unlink($brand_logo_path . $brand_logo->brand_logo);
        }
        Brand::where('id', $id)->update(['brand_logo' => '']);
        return redirect()->back()->with('success_message', 'Brand logo deleted successfully!!');
    }
}
