<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AdminsRole;
use Auth;

class CategoryController extends Controller
{
    public function categories() {
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
            return response()->back()->with('success_message', 'category deleted successfully!!');
    }
}
