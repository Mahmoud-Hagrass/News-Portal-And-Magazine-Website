<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\User\AccountProfileController;
use App\Http\Controllers\Frontend\Dashboard\User\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use App\Http\Controllers\Frontend\PostController;
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
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index')->middleware(['auth' ,'verified']); // as a test only
    Route::post('news-subscribe', [NewsSubscriberController::class, 'store'])->name('news-subscribe');
    Route::get('/category/{slug}', CategoryController::class)->name('category-posts');
    
    // Post Routes
    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function (){
            Route::get('/{slug}', 'show_post')->name('show');
            Route::get('/comments/{slug}', 'get_post_comments')->name('comments');
            Route::post('/comments/store', 'store_comment')->name('comments.store');
            Route::post('/search' , 'post_search')->name('search') ; 
    }) ; 
    
    // Contact Routes
    Route::controller(ContactController::class)->prefix('contact-us')->name('contact-us.')->group(function () {
           Route::get('/' , 'index')->name('index') ;  
           Route::post('/store' , 'store')->name('store') ;   
    }) ; 

    Route::prefix('account')->name('dashboard.')->middleware(['auth' , 'verified'])->group(function(){
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

    }) ; 
});
require __DIR__ . '/auth.php';
