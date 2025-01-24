<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Services\Frontend\Posts\Cache\PostCachingService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SharedDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        $categories = Category::basicSelect()->withPostsAndCount()->get() ;

        $newCatgories = $categories->take(9); 

        $allCategories = Category::basicSelect()->get() ;

        View::share([
            'categories' => $categories,
            'newCatgories' => $newCatgories , 
            'allCategories' => $allCategories,
        ]);
    }
}
