<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Post\StorePostRequest;
use App\Http\Requests\Frontend\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Utils\Frontend\ImageManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 

class AccountProfileController extends Controller
{
     public function show_profile()
     {
        if(!Auth::check()){
            return redirect()->route('login') ;
        }
        $posts = Auth::user()->posts()->active()->with(['images'])->latest()->get() ;  
        return view('frontend.dashboard.user-profile'  , compact('posts')) ; 
     }

     public function store_post(StorePostRequest $request)
     {
        $uploadedFiles = [] ;
            try{
                DB::beginTransaction() ;

                $request->validated() ;
                $comment_able = ($request->comment_able) == 'on' ? 1 : 0 ;
                $user_id = Auth::guard('web')->user()->id ;
                $request->merge([
                    'comment_able' => $comment_able , 
                    'user_id' => $user_id ,
                ]) ; 
                $post = Post::create($request->except('_token' , 'images')) ; 
                $uploadedFiles = ImageManager::uploadImages($request , $post , 'posts' , 'uploads') ;
                // Every Time Create Post We Clear Our Cache To Get Latest Updated Posts From Cache
                Cache::flush() ; 
                DB::commit(); 
                display_success_message('Post Created Successfully !') ;
                return redirect()->back() ; 
            }catch(\Exception $e){
                DB::rollBack() ;  // rollback the all queries
                // delete all paths that might be uploaded
                foreach($uploadedFiles as $file){
                    if(Storage::disk('uploads')->exists($file)){
                        $file = Storage::disk('uploads')->delete($file);  
                    }
                }
                display_error_message('Can not Create Post , Try Again') ;
                return redirect()->back() ;
            }
     }


     public function edit_post($slug)
     {
        $post = Post::whereSlug($slug)->with(['images'])->first() ; 
        if(!$post){
            display_error_message('Error, Try Again!') ; 
            return redirect()->back() ;
        }
        return view('frontend.post.edit' , get_defined_vars()) ; 
     }

     public function delete_post(Request $request)
     {
        $post = Post::with(['images'])->find($request->post_delete) ; 
        ImageManager::deleteImages($post) ;
        //delete post and it's images paths from database
        $post->delete() ; 
        // clear the cache to get the updated posts after delete any post
        Cache::flush() ;
        display_success_message('Post Deleted Successfully !') ;
        return redirect()->back() ; 
     }


     public function get_post_comments($slug)
     {
        $post = Post::whereSlug($slug)->first() ;
        $comments =$post->comments()->select(['id','comment','user_id','post_id'])->latest()->get() ; 
        $comments->load(['user:id,name,image']) ; 
        return response()->json([
            'status' => 200 , 
            'comments' => $comments , 
            'message' => 'success' , 
        ]) ; 
     }

     public function update_post(UpdatePostRequest $request)
     {
        try{
            DB::beginTransaction() ; 
            $request->validated() ; 
            ($request->comment_able == 'on') ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]) ;  
            $post = Post::with('images')->findorFail($request->post_id) ; 
            $post->update($request->except(['_token' , 'images' , 'post_id'])) ; // update post
            ImageManager::uploadImages($request , $post  , 'posts' ,'uploads') ; 
            Cache::flush() ;
            DB::commit() ; 
            display_success_message('Post Updated Successfully !') ;
            return redirect()->route('frontend.index') ;
        }catch(Exception $e){
            DB::rollBack() ;
            display_error_message('Can not Update Post , may be images not uploaded') ;
            return redirect()->back() ; 
        }
     }

     public function delete_post_image(Request $request , $id)
     {
        $image = PostImage::find($id); 
        ImageManager::deleteImage($image) ; //delete from local storage
        $image->delete() ; // delete form database
        return response()->json([
            'status' => 200 , 
            'image' => $image , 
            'message' => 'deleted successfully' ,
        ]) ; 
     }
}
