<?php

use App\Http\Controllers\Backend\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Backend\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\User\AccountProfileController;
use App\Http\Controllers\Frontend\Dashboard\User\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\User\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use Predis\Configuration\Option\Prefix;

Route::group(['prefix' => 'admin' , 'as' => 'admin.'] , function(){
    Route::get('/home' , function(){
        return view('backend.admin.index') ; 
    })->name('index')->middleware('admin') ; 

    Route::group(['prefix' => 'password' , 'as' => 'password.'] , function(){
        Route::get('/email' , [ForgetPasswordController::class , 'showEmailForm'])->name('email') ; 
        Route::post('/email' , [ForgetPasswordController::class , 'sendOtp'])->name('email') ; 
        Route::get('/verify/{email}' , [ForgetPasswordController::class , 'verifyEmail'])->name('verify') ; 
        Route::post('/verify' , [ForgetPasswordController::class , 'verifyOtp'])->name('otp.verify') ; 

        Route::get('/reset/{email}' , [ResetPasswordController::class,'showResetPasswordForm'])->name('reset') ; 
        Route::post('/reset' , [ResetPasswordController::class,'resetPassword'])->name('reset-password') ; 
    }) ; 
    require __DIR__ . '/adminAuth.php';
}) ; 