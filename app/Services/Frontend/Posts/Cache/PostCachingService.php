<?php
namespace App\Services\Frontend\Posts\Cache;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostCachingService
{
    public function cache_latest_posts(){
        $latestCachedPosts = Cache::remember('latest_posts' , 3600 , function() {
                return Post::with('images')->select('id' , 'title' , 'slug')->active()->latest()->limit(5)->get() ;
            }) ; 
        return $latestCachedPosts ; 
    }


    public function cache_popular_posts(){
            $cachedPopularPosts = Cache::remember('popular_posts' , 3600 , function() {
                return Post::withCount('comments')->with('images')->orderBy('comments_count' , 'desc')->active()->limit(5)->get() ; 
            });
            return $cachedPopularPosts ; 
    }


    public function cache_read_more_posts(){
        $cachedPosts = Cache::remember('read_more_posts' , 3600 , function() {
                return Post::with('images')->select(['id','slug' , 'title'])->active()->latest()->limit(10)->get() ; 
            }) ;             
        return $cachedPosts ;
    }
}