<?php

namespace App\Http\Controllers\Backend\Admin\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\Profiles\UpdateAdminProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin' , 'admin.permissions:edit_profile']) ; 
    }
    public function editProfile()
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id) ; 
        if(!$admin){
            return redirect()->route('admin.login') ;
        }
        return view('backend.admin.profiles.edit' , ['admin' => $admin]) ; 
    }

    public function updateProfile(UpdateAdminProfileRequest $request)
    {
        $admin = Admin::findOrFail($request->admin_id) ; 
        if(!$admin){
            return redirect()->route('admin.login') ;
        }
        
        if(!Hash::check($request->current_password , $admin->password)){
            display_error_message('Current Password Does Not Match') ;
            return redirect()->route('admin.index'); 
        }

        $is_updated = $admin->update([
            'name' => $request->name , 
            'username' => $request->username , 
            'email' => $request->email , 
            'password' => $request->new_password , 
        ]) ;
        if(!$is_updated){
            display_error_message('Something Went Wrong') ;
            return redirect()->route('admin.index') ;
        }
        display_success_message('Profile Updated Successfully') ;
        return redirect()->route('admin.index') ;
    }
}
