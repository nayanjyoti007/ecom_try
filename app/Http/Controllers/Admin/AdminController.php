<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogin()
    {
        return view('admin.login');
    } //End Method


    public function AdminDashboard()
    {
        return view('admin.index');
    } //End Method


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    } //End Method


    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.profile', compact('adminData'));
    } //End Method


    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function AdminChangePassword()
    {
        return view('admin.change-password');
    } //End Method


    public function AdminUpdatePassword(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->with("error", "Password Does Not Match");
        }

        //Update password
        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with("status", "Password Updated Successfully");
    } //End Method


}
