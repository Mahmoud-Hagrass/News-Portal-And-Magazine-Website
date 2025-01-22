<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $slug)
    {
        $category = Category::whereSlug($slug)->first();
        $posts = $category->posts()
            ->with('images')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('frontend.category-posts', compact('posts'));
    }
}
