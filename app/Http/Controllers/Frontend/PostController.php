<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StorePostCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show_post($slug)
    {
        $post = Post::active()->with(['user', 'images', 'category', 'comments' => function ($query) {
            $query->latest()->limit(5);
        }])->whereSlug($slug)->first();
        
        $relatedPosts = Post::active()->with('images')
            ->where('category_id', $post->category->id)
            ->latest()
            ->limit(5)
            ->get();
        //return $post ; 
        return view('frontend.post.show', compact('post', 'relatedPosts'));
    }

    public function get_post_comments($slug)
    {
        $post = Post::active()->with(['user', 'comments' => function ($query) {
            $query->latest();
        }])->whereSlug($slug)->first();

        if (!$post) {
            return response()->json([
                'message' => 'Something Went Wrong !',
                'status' => 204, // no content found
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $post,
            'status' => 200, // ok 
        ]);
    }

    public function store_comment(StorePostCommentRequest $request)
    {
        $data = $request->validated();
        $data['ip_address'] = $request->ip();
        $comment = Comment::create($data);
        if (!$comment) {
            return response()->json([
                'message' => 'Something Went Wrong !',
                'status' => 204, // no content found
            ]);
        }
        $comments_with_user = $comment->load('user');
        return response()->json([
            'message' => 'success',
            'data' => $comments_with_user,
            'status' => 201, // created 
        ]);
    }


    public function post_search(Request $request)
    {
        $data = $request->validate([
            'post' => ['required', 'string'] , 
        ]);
        
        $posts = Post::active()->with('images')->where('title' , 'LIKE' , "%". $data['post'] ."%")->get();
        return view('frontend.post.search' , compact('posts')) ; 
    }
}
