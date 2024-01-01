<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorLogin()
    {
        return view('vendor.login');
    } //End Method


    public function VendorDashboard()
    {
        return view('vendor.index');
    } //End Method


    public function VendorLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/vendor/login');
    } //End Method


    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.profile', compact('vendorData'));
    } //End Method


    public function VendorProfileStore(Request $request)
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
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Method


    public function VendorChangePassword()
    {
        return view('vendor.change-password');
    } //End Method


    public function VendorUpdatePassword(Request $request)
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
