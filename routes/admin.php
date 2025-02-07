<?php

use App\Http\Controllers\Backend\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Backend\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Backend\Admin\Users\UserController;
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
    Route::get('/dashboard' , function(){
        return view('backend.admin.index') ; 
    })->name('index')->middleware('admin') ; 

    /*#############################################################################*/ 
                    /*########   Password Reset Routes ########*/ 
    /*#############################################################################*/ 
    Route::group(['prefix' => 'password' , 'as' => 'password.'] , function(){
        Route::controller(ForgetPasswordController::class)->group(function(){
            Route::get('/email' , 'showEmailForm')->name('email') ; 
            Route::post('/email' , 'sendOtp')->name('email') ; 
            Route::get('/verify/{email}' , 'verifyEmail')->name('verify') ; 
            Route::post('/verify' , 'verifyOtp')->name('otp.verify') ; 
        }) ; 
     
        Route::controller(ResetPasswordController::class)->group(function(){
            Route::get('/reset/{email}' ,'showResetPasswordForm')->name('reset') ; 
            Route::post('/reset' , 'resetPassword')->name('reset-password') ; 
        }) ; 
    }) ; 
    /*#############################################################################*/ 
                       /*########  Uers Management Routes ########*/ 
    /*#############################################################################*/ 
    Route::resource('users' , UserController::class) ;
    Route::post('/users/status' , [UserController::class,'changeUserStatus'])->name('users.change-status') ; 
    
    require __DIR__ . '/adminAuth.php';
}) ; 