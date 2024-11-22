<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsRole;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    public function banners()
    {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();

        $module_count = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'banners'])->count();
        $banners_module = array();
        if (Auth::guard('admin')->user()->type == 'admin') {
            $banners_module['view_access'] = 1;
            $banners_module['edit_access'] = 1;
            $banners_module['full_access'] = 1;
        } else {
            if ($module_count == 0) {
                $message = 'This feature is restricted to this Sub Admins';
                return redirect('admin/dashboard')->with('error_message', $message);
            }
            $banners_module = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'banners'])->first()->toArray();
        }

        return view('admin.banners.banners', compact('banners', 'banners_module'));
    }

    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])->update(['status' => $status]);

            return response()->json(['status' => 'success', 'banner_id' => $data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
        $banner_image = Banner::where('id', $id)->first();

        $banner_image_path = public_path('front/images/banners/');

        if (file_exists($banner_image_path . $banner_image->image)) {
            unlink($banner_image_path . $banner_image->image);
        }

        Banner::where('id', $id)->delete();
        $message = 'Banner deleted successfully!!';
        return redirect('admin/banners')->with('success_message', $message);
    }
}
