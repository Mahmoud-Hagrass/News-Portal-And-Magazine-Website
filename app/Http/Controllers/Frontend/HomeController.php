<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(config('pagination.post_count')); 
        $mostViewedPosts = Post::with('images')->orderBy('number_of_views' , 'desc')->take(3)->get();
        $oldestPosts = Post::with('images')->oldest()->take(3)->get() ;
        $popularPosts = Post::withCount('comments')->orderBy('comments_count' , 'desc')->take(3)->get(); 

        $categories = Category::get() ;
        $category_with_posts = $categories->map(function ($category){
             $category['posts'] = $category->posts()->latest()->limit(3)->get() ; 
             return $category ;
        }) ;
        //return $category_with_posts ;
        return view('frontend.index' , get_defined_vars()); 
    }
}
