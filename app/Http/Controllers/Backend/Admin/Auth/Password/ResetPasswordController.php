<?php

namespace App\Http\Controllers\Backend\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetPasswordForm($email)
    {
        return view('backend.admin.auth.password.reset' , compact('email')) ; 
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required' , 'string' , 'email'] , 
            'password' => ['required' , 'string' , 'min:8' , 'confirmed'] , 
            'password_confirmation' => ['required' , 'string' , 'min:8'] , 
        ]) ; 
        
        $admin = Admin::where('email' , $request->email)->first() ; 
        if(!$admin){
            return redirect()->back()->with('custom-error' , 'Error Occured!');
        }
        $admin->update([
            'password' => Hash::make($request->password) , 
        ]) ; 
        return to_route('admin.login') ; 
    }
}
