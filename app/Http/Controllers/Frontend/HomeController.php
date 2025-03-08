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
        $posts = Post::active()->with(['images'])->latest()
            ->paginate(config('pagination.post_count'));

        $mostViewedPosts = Post::active()->with('images')->orderBy('number_of_views', 'desc')
            ->take(3)
            ->get();

        $oldestPosts = Post::active()->with('images')->oldest()
            ->take(3)
            ->get();

        $popularPosts = Post::active()->withCount('comments')->with('images')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        $category_with_posts = Category::hasInPostsRelation()->with(['posts' => function ($query) {
            $query->active()->latest()->limit(3)->with('images');
        }])->get();
        //return $category_with_posts ; 
        return view('frontend.index', get_defined_vars());
    }
}
