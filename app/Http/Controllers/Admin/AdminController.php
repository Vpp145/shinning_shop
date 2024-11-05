<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function dashboard() {
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

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
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
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdminDetails(Request $request) {
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

            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile']]);
            return redirect()->back()->with('success_message', 'Admin details updated successfully!!');
        }
        return view('admin.update-admin-details');
    }
}
