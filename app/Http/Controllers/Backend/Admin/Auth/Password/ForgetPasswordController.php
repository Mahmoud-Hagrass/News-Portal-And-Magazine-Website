<?php

namespace App\Http\Controllers\Backend\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminForgetPasswordNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;


class ForgetPasswordController extends Controller
{
    public $otp; 
    public function __construct()
    {
        $this->otp = new Otp ; 
    }
    public function showEmailForm()
    {
        return view('backend.admin.auth.password.email') ; 
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required' , 'string' , 'email'] , 
        ]) ; 
        
        $admin = Admin::where('email' , $request->email)->first() ; 
        if(!$admin){
            return redirect()->back()->with('custom-error' , 'Sorry, Try Again!') ; 
        }
        $admin->notify(new AdminForgetPasswordNotify()) ; 
        return redirect()->route('admin.password.verify' ,  $admin->email) ; 
    }

    public function verifyEmail($email)
    {
        return view('backend.admin.auth.password.confirm' , compact('email')) ; 
    }

    public function verifyOtp(Request $request)
    {
        //return $request ; 
        $request->validate([
            'email' => ['required' , 'email'] , 
            'token' => ['required' , 'min:5'] ,  
        ]) ; 
        // check if the token placed in request is same in db :
       $otp = $this->otp->validate($request->email , $request->token) ; 
       if($otp->status == false){
            return redirect()->back()->with('custom-error' , 'Invalid Code!') ; 
       }
       return redirect()->route('admin.password.reset' , $request->email) ; 
    }
}
