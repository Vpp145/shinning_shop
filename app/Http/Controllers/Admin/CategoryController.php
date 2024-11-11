<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AdminsRole;
use Image;

class CategoryController extends Controller
{
    public function categories() {
        Session::put('page', 'categories');
        $categories = Category::with('parentCategory')->get()->toArray();
        $categories = json_decode(json_encode($categories), true);

        $admin_id = Auth::guard('admin')->user()->id;
        $module_count = AdminsRole::where(['subadmin_id' => $admin_id, 'module' => 'categories'])->count();

        if (Auth::guard('admin')->user()->type == 'admin') {
            $categories_module['view_access'] = 1;
            $categories_module['edit_access'] = 1;
            $categories_module['full_access'] = 1;
        } else {
            if ($module_count == 0) {
                $message = 'This feature is restricted to this Sub Admins';
                return redirect('admin/dashboard')->with('error_message', $message);
            }

            $categories_module = AdminsRole::where(['subadmin_id' => $admin_id, 'module' => 'categories'])->first();

            if ($categories_module->view_access == 0 && $categories_module->edit_access == 0 && $categories_module->full_access == 0) {
                $message = 'This feature is restricted to this Sub Admins';
                return redirect('admin/dashboard')->with('error_message', $message);
            }

            $categories_module = $categories_module->toArray();
        }

        return view('admin.categories.categories')->with(compact('categories', 'categories_module'));
    }

    public function updateCategoryStatus(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function deleteCategory($id) {
            Category::where('id', $id)->delete();
            return redirect()->back()->with('success_message', 'category deleted successfully!!');
    }

    public function addEditCategory(Request $request, $id = null) {
        if ($id == "") {
            $title = "Add Category";
            $category = new Category;
            $message = 'Category Added successfully';
        } else {
            $title = "Edit Category";
            $category = Category::find($id);
            $message = 'Category updated successfully';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($id == '') {
                $rules = [
                    'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'url' => 'required|unique:categories',
                ];
            } else {
                $rules = [
                    'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'url' => 'required',
                ];
            }
            $customMessages = [
                'category_name.required' => 'Category name is required',
                'category_name.regex' => 'Valid category name is required',
                'url.required' => 'URL is required',
                'url.unique' => 'URL already exists',
            ];
            $request->validate($rules, $customMessages);

            if($data['category_discount'] == '') {
                $data['category_discount'] = 0;
            }

            if($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111, 99999).'.'.$extension;
                    $image_path = public_path('front/images/categories/'.$image_name);
                    Image::make($image_tmp)->save($image_path);

                    $category->category_image = $image_name;
                }
            } else {
                $category->category_image = '';
            }

            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'] ?? '';
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'] ?? '';
            $category->meta_description = $data['meta_description'] ?? '';
            $category->meta_keywords = $data['meta_keywords'] ?? '';
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message', $message);
        }

        $get_categories = Category::getCategories();
        // dd($get_categories);
        return view('admin.categories.add_edit_category', compact('title', 'category', 'get_categories'));
    }

    public function deleteCategoryImage($id) {
        $category_image = Category::select('category_image')->where('id', $id)->first();
        $category_image_path = 'front/images/categories/';
        if (file_exists($category_image_path.$category_image->category_image)) {
            unlink($category_image_path.$category_image->category_image);
        }

        Category::where('id', $id)->update(['category_image' => '']);
        return redirect()->back()->with('success_message', 'Category image deleted successfully');
    }
}
