<?php

use App\Http\Controllers\Backend\Admin\Admins\AdminController;
use App\Http\Controllers\Backend\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Backend\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Backend\Admin\Categories\CategoryController;
use App\Http\Controllers\Backend\Admin\Profiles\AdminProfileController;
use App\Http\Controllers\Backend\Admin\Contacts\ContactController as ContactsContactController;
use App\Http\Controllers\Backend\Admin\Notifications\NotificationController;
use App\Http\Controllers\Backend\Admin\Posts\PostController;
use App\Http\Controllers\Backend\admin\Roles\RoleController;
use App\Http\Controllers\Backend\Admin\Search\GeneralSearch;
use App\Http\Controllers\Backend\Admin\Search\GeneralSearchController;
use App\Http\Controllers\Backend\Admin\Settings\SettingController;
use App\Http\Controllers\Backend\Admin\Users\UserController;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\User\AccountProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use Predis\Configuration\Option\Prefix;

Route::group(['prefix' => 'admin' , 'as' => 'admin.'] , function(){
    Route::get('/dashboard' ,[DashboardController::class,'index'])->name('index') ; 

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
    Route::post('/users/change-status' , [UserController::class,'changeUserStatus'])->name('users.change-status') ; 
    Route::get('/users/status/in-active' , [UserController::class,'showBlockedUsers'])->name('users.show.blocked-users') ; 
    
    /*#############################################################################*/ 
                       /*########  Categories Management Routes ########*/ 
    /*#############################################################################*/
    Route::resource('categories' , CategoryController::class) ;
    Route::post('/categories/change-status' , [CategoryController::class , 'changeCategoryStatus'])->name('categories.change-status') ;

    /*#############################################################################*/ 
                       /*########  Posts Management Routes ########*/ 
    /*#############################################################################*/
    Route::resource('posts' , PostController::class) ; 
    Route::post('/posts/change-status' , [PostController::class , 'changePostStatus'])->name('posts.change-status') ;
    Route::get('/posts/{slug}/comments' , [PostController::class , 'getPostComments'])->name('posts.comments') ; 
    
    /*#############################################################################*/ 
                       /*########  Settings Management Routes ########*/ 
    /*#############################################################################*/
    Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function(){
        Route::get('/' , 'index')->name('index') ; 
        Route::put('/update/{id}' , 'update')->name('update') ; 
    }); 
    
    /*#############################################################################*/ 
                       /*########  Admins Management Routes ########*/ 
    /*#############################################################################*/
    Route::resource('admins' , AdminController::class) ; 
    Route::post('/admins/change-status' , [AdminController::class , 'changeAdminStatus'])->name('admins.change-status') ;
    
    /*#############################################################################*/ 
             /*########  Roles And Permissions Management Routes ########*/  
    /*#############################################################################*/
    Route::resource('roles' , RoleController::class) ;
    
    /*#############################################################################*/ 
             /*########  Contacts Management Routes ########*/  
    /*#############################################################################*/
    Route::resource('contacts' , ContactsContactController::class) ; 
    
    /*#############################################################################*/ 
             /*########  Admin Profile Management Routes ########*/  
    /*#############################################################################*/
    Route::controller(AdminProfileController::class)->prefix('profile')->name('profile.')->group(function(){
        Route::get('/edit' , 'editProfile')->name('edit') ; 
        Route::put('/update' , 'updateProfile')->name('update') ; 
    }) ;
    
    /*#############################################################################*/ 
             /*########  Notifications Management Routes ########*/  
    /*#############################################################################*/
     Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function(){
         Route::get('/' , 'index')->name('index') ; 
         Route::get('/show/{id}' , 'showNotification')->name('show') ; 
         Route::post('/mark-as-read' , 'markAsRead')->name('mark-as-read') ; 
         Route::get('/mark-all-as-read' , 'markAllAsRead')->name('mark-all-as-read') ; 
         Route::get('/delete-all' , 'deleteAllNotifications')->name('delete-all') ; 
         Route::delete('/delete' , 'deleteNotification')->name('delete') ; 
     }) ; 

     /*#############################################################################*/ 
                    /*########  General Search Routes ########*/  
    /*#############################################################################*/
     Route::get('/general/search' , [GeneralSearchController::class , 'search'])->name('general.search') ; 


     Route::fallback(function(){
        return view('errors.404');
     }) ;

    require __DIR__ . '/adminAuth.php';
}) ; 