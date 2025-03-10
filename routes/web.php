<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\User\AccountProfileController;
use App\Http\Controllers\Frontend\Dashboard\User\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\User\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SocialLogin\SocialLoginController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use Predis\Configuration\Option\Prefix;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'as' => 'frontend.',
    'middleware' => ['check.user.status'] , 
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribe', [NewsSubscriberController::class, 'store'])->name('news-subscribe');
    Route::get('/category/{slug}', CategoryController::class)->name('category-posts');
    
    // Post Routes
    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function (){
            Route::get('/{slug}', 'show_post')->name('show');
            Route::get('/comments/{slug}', 'get_post_comments')->name('comments');
            Route::post('/comments/store', 'store_comment')->name('comments.store');
            Route::post('/comments/hide', 'hide_comment')->name('comments.hide');
            Route::delete('/comments/delete' , 'delete_comment')->name('comments.delete') ;
            Route::post('/search' , 'post_search')->name('search') ; 
    }) ; 
    
    // Contact Routes
    Route::controller(ContactController::class)->prefix('contact-us')->name('contact-us.')->group(function () {
           Route::get('/' , 'index')->name('index') ;  
           Route::post('/store' , 'store')->name('store') ;   
    }) ; 

    Route::prefix('account')->name('dashboard.')->group(function(){
        Route::controller(AccountProfileController::class)->group(function(){
            Route::get('/profile' , 'show_profile')->name('account.profile') ; 
            Route::post('/post/store' , 'store_post')->name('post.store') ; 
            Route::get('/post/{slug}/edit' , 'edit_post')->name('post.edit') ;
            Route::put('/post/update' , 'update_post')->name('post.update') ;
            Route::delete('/post/delete' , 'delete_post')->name('post.delete') ; 
            Route::get('/post/comments/{slug}' , 'get_post_comments')->name('post.comments') ;  
            Route::delete('/post/image/{image_id}/delete' , 'delete_post_image')->name('post.image.delete') ; 
        }); 
        
        Route::controller(SettingController::class)->prefix('setting')->name('setting.')->group(function(){
            Route::get('/' , 'index')->name('index') ; 
            Route::post('/update' , 'update_setting')->name('update') ; 
            Route::post('/change-password' , 'change_password')->name('change-password') ; 
        }) ; 

        Route::controller(NotificationController::class)->prefix('/notification')->name('notification.')->group(function(){
            Route::get('/' , 'index')->name('index');  
            Route::delete('/delete' , 'delete_notification')->name('delete');  
            Route::get('/delete-all' , 'delete_all_notifications')->name('delete-all');  
            Route::get('/mark-all-as-read' , 'mark_all_as_read')->name('mark-all-as-read');  
        }) ; 

    }) ; 

    Route::controller(SocialLoginController::class)->prefix('auth')->name('auth.')->group(function(){
        Route::get('/{provider}' , 'redirectToProvider')->name('provider') ; 
        Route::get('/{provider}/callback' , 'handleProviderCallback')->name('callback') ; 
    }) ; 

    Route::get('/waiting/block' , function(){
        return view('frontend.waiting.block'); ; 
    })->name('waiting.block')->withoutMiddleware(['check.user.status']) ; 
});
require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';