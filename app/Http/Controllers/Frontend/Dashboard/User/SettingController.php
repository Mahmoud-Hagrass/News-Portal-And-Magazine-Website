<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\ChangeUserPasswordRequest;
use App\Http\Requests\Frontend\Dashboard\StoreSettingRequest;
use App\Models\User;
use App\Utils\Frontend\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user() ; 
        return view('frontend.dashboard.setting' , compact('user')) ; 
    }

    public function update_setting(StoreSettingRequest $request)
    {
         $request->validated() ; 
         $user = User::findorFail((Auth::user()->id)) ; 
         $user_check = $user->update($request->except(['_token' , 'image'])) ; 
         if(!$user_check){
            display_error_message('Sorry , Try Again') ;
            return redirect()->back() ;
         }
         ImageManager::deleteImage($user) ;
         ImageManager::uploadImage($request , $user) ; 
         display_success_message('Profile Updated Successfully !') ; 
         return redirect()->back() ; 
    }

    public function change_password(ChangeUserPasswordRequest $request)
    {
        $request->validated() ;
        $user = User::findorFail(Auth::user()->id) ; 
        if(!Hash::check($request->current_password , $user->password)){
            display_error_message('Current Password Does Not Match') ;
            return redirect()->back() ;
        }
        $user->update([
            'password' => Hash::make($request->new_password) ,
        ]) ;
        display_success_message('Password Changed Successfully !') ;
        return redirect()->back() ;
    }
}
