<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StorePostCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NotifyUserForNewComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show_post($slug)
    {
        $post = Post::with(['user:id,name,image','images', 'category', 'comments' => function ($query) {
            $query->with('user')->active()->latest()->limit(5);
        }])->whereSlug($slug)->first();
        //dd($post) ; 
        $relatedPosts = Post::active()->with('images')
            ->where('category_id', $post->category->id)
            ->latest()
            ->limit(5)
            ->get();

        $post->increment('number_of_views');;
        return view('frontend.post.show', compact('post', 'relatedPosts'));
    }

    public function get_post_comments($slug)
    {
        $post = Post::active()->with(['comments' => function ($query) {
            $query->with(['user:id,name,image'])
                  ->active()
                  ->select(['id','comment','user_id','post_id'])
                  ->latest();
        }])->select(['id', 'title'])
            ->whereSlug($slug)
            ->first();

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
        // Check if the request is an AJAX request
        $this->checkAjaxRequest($request);
        // Check if the user is authenticated
        $this->checkForAuthUser();

        // merge auth user id & it's ip address in the request
        $this->mergeAuthUserAndLocalIpAddressToRequest($request);
        //create a new comment
        $comment = Comment::create($request->all());
        if (!$comment) {
            return response()->json([
                'message' => 'Something Went Wrong !',
                'status' => 204, // no content found
            ]);
        }
        //load comment with it's user creator
        $comment_with_user = $this->loadCommentWithUserCreator($comment->id);

        //notify in realtime for author of post when someone add comment of his post.
        $post = Post::findorFail($request->post_id);
        $post->user->notify(new NotifyUserForNewComment($comment_with_user, $post));

        return response()->json([
            'message' => 'success',
            'data' => $comment_with_user,
            'status' => 201, // created 
        ]);
    }


    public function post_search(Request $request)
    {
        $data = $request->validate([
            'post' => ['required', 'string'],
        ]);

        $posts = Post::active()->with('images')->where('title', 'LIKE', "%" . $data['post'] . "%")->get();
        return view('frontend.post.search', compact('posts'));
    }

    public function hide_comment(Request $request)
    {
        // validate comment_id
        $this->validateCommentId($request) ; 
        // check if there is auth user 
        $this->checkForAuthUser() ; 
        $comment = Comment::findOrFail($request->comment_id) ; 
        if($comment->status == 1){
            $comment->update(['status' => 0]) ;
        }else{
            $comment->update(['status' => 1]) ;
        }
        return response()->json([
            'status' => 200 , 
            'data' => $comment ,
            'message' => 'comment updated successfully!', 
        ]); 
    }

    public function delete_comment(Request $request)
    {
        $this->validateCommentId($request) ; 
        $this->checkForAuthUser() ; 
        $comment = Comment::find($request->comment_id) ; 
        if(!$comment){
            return response()->json([
                'status' => 400 , 
                'message' => 'Can Not Delete This Comment !', 
            ]) ; 
        }
        $comment->delete() ; 
        return response()->json([
            'status' => 200 , 
            'message' => 'Comment Deleted Successfully !', 
        ]) ; 
    }

    private function checkAjaxRequest($request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'message' => 'Invalid request type.',
                'status' => 403, // Forbidden
            ], 403);
        }
    }

    private function checkForAuthUser()
    {
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'message' => 'You must be logged in to comment.',
                'status' => 401, // // Unauthorized
            ], 401);
        }
    }

    private function mergeAuthUserAndLocalIpAddressToRequest($request)
    {
        $request->merge([
            'user_id' => Auth::guard('web')->user()->id,
            'ip_address' => $request->ip(),
        ]);
    }

    private function loadCommentWithUserCreator($commentId)
    {
        return Comment::with(['user:id,name,image'])
            ->select(['id', 'comment', 'post_id', 'user_id'])
            ->active()
            ->find($commentId);
    }

    private function validateCommentId($request)
    {
        $request->validate([
            'comment_id' => ['required','integer' , 'exists:comments,id'],
        ]);
    }
}
