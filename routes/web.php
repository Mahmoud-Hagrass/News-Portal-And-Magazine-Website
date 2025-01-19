<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
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
    Route::get('/', [HomeController::class, 'index'])->name('index');
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
