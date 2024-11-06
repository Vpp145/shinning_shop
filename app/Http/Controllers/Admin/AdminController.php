<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Session;
use Auth;
use Hash;
use Image;

class AdminController extends Controller
{
    public function dashboard() {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid email is required',
                'password.required' => 'Password is required'
            ];
            $request->validate($rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                if(!empty($_POST['remember'])) {
                    setcookie('email', $_POST['email'], time() + 3600);
                    setcookie('password', $_POST['password'], time() + 3600);
                } else {
                    setcookie('email', '');
                    setcookie('password', '');
                }
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password!!');
            }
        }
        return view('admin.login');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request) {
        Session::put('page', 'update-password');
        if($request->isMethod('post')) {
            $data = $request->input();
            // echo '<pre>'; print_r($data); die;
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                if($data['new_pwd'] == $data['confirm_pwd']) {
                    Admin::where('email', Auth::guard('admin')->user()->email)->update(['password' => bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_message', 'Password updated successfully!!');
                } else {
                    return redirect()->back()->with('error_message', 'New password and confirm password should be same!!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is not correct!!');
            }
        }
        return view('admin.update-password');
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdminDetails(Request $request) {
        Session::put('page', 'update-admin-details');
        if($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|alpha',
                'admin_mobile' => 'required|numeric'
            ];
            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.alpha' => 'Valid name is required',
                'admin_mobile.required' => 'Mobile number is required',
                'admin_mobile.numeric' => 'Valid mobile number is required'
            ];
            $request->validate($rules, $customMessages);

            if($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999).'.'.$extension;
                    $image_path = 'admin/img/photos/'.$filename;
                    Image::make($image_tmp)->save($image_path);
                }
            } else if($data['current_image'] != '') {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $filename]);
            return redirect()->back()->with('success_message', 'Admin details updated successfully!!');
        }
        return view('admin.update-admin-details');
    }

    public function subadmins() {
        Session::put('page', 'sub-admins');
        $subadmins = Admin::where('type', 'subadmin')->get();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }

    public function updateSubadminStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['subadmin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'subadmin_id' => $data['subadmin_id']]);
        }
    }

    public function deleteSubadmin($id) {
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Subadmin deleted successfully!!');
    }

    public function addEditSubadmin(Request $request, $id = null) {
        if($id == '') {
            $title = 'Add Subadmin';
            $subadmin = new Admin;
            $message = 'Subadmin added successfully!!';
        } else {
            $title = 'Edit Subadmin';
            $subadmin = Admin::find($id);
            $message = 'Subadmin updated successfully!!';
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            if($id == '') {
                $count = Admin::where('email', $data['subadmin_email'])->count();
                if($count > 0) {
                    return redirect('admin/sub-admins')->with('error_message', 'Subadmin email already exists!!');
                }
            }
            $rules = [
                'subadmin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'subadmin_mobile' => 'required|numeric',
                'subadmin_image' => 'image',
            ];
            $customMessages = [
                'subadmin_name.required' => 'Name is required',
                'subadmin_name.regex' => 'Valid name is required',
                'subadmin_mobile.required' => 'Mobile number is required',
                'subadmin_mobile.numeric' => 'Valid mobile number is required',
                'subadmin_image.image' => 'Valid image is required'
            ];
            $request->validate($rules, $customMessages);

            if($request->hasFile('subadmin_image')) {
                $image_tmp = $request->file('subadmin_image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111, 99999).'.'.$extension;
                    $image_path = 'admin/img/photos/'.$image_name;
                    Image::make($image_tmp)->save($image_path);
                }
            } else if(!empty($data['current_subadmin_image'])) {
                $image_name = $data['current_subadmin_image'];
            } else {
                $image_name = '';
            }

            $subadmin->image = $image_name;
            $subadmin->name = $data['subadmin_name'];
            $subadmin->mobile = $data['subadmin_mobile'];
            if($id == '') {
                $subadmin->email = $data['subadmin_email'];
                $subadmin->type = 'subadmin';
            }
            if($data['subadmin_password'] != '') {
                $subadmin->password = bcrypt($data['subadmin_password']);
            }
            $subadmin->save();
            return redirect('admin/sub-admins')->with('success_message', $message);
        }
        return view('admin.subadmins.add_edit_subadmin')->with(compact('title', 'subadmin'));
    }
}
