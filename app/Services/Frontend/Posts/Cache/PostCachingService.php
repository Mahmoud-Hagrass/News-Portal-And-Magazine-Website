<?php
namespace App\Services\Frontend\Posts\Cache;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostCachingService
{
    public function cache_latest_posts(){
        $latestPosts = Post::with('images')->select('id' , 'title' , 'slug')->latest()->limit(5)->get() ;
        if(!Cache::has('latest_posts')){
           $latestCachedPosts = Cache::remember('latest_posts' , 3600 , function() use($latestPosts){
                return $latestPosts;
            }) ; 
        }

        // get stored posts from cache 
        $latestCachedPosts = Cache::get('latest_posts') ;
        return $latestCachedPosts ; 
    }


    public function cache_popular_posts(){
        $popularPosts = Post::withCount('comments')->with('images')->orderBy('comments_count' , 'desc')->limit(5)->get() ; 
        if(!Cache::has('popular_posts')){
            $cachedPopularPosts = Cache::remember('popular_posts' , 3600 , function() use($popularPosts){
                return $popularPosts;
            }) ;  
        }
        $cachedPopularPosts = Cache::get('popular_posts') ;
        return $cachedPopularPosts ; 
    }


    public function cache_read_more_posts(){
        $posts = Post::with('images')->select(['id','slug' , 'title'])->latest()->limit(10)->get() ; 
        if(!Cache::has('read_more_posts')){
            $cachedPosts = Cache::remember('read_more_posts' , 3600 , function() use($posts){
                return $posts;
            }) ; 
        }
            
        // get stored posts from cache 
        $cachedPosts = Cache::get('read_more_posts') ; 
        return $cachedPosts ;
    }
}