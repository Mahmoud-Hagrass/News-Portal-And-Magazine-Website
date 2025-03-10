<?php

namespace App\Http\Controllers\Backend\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminAuth\Post\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Utils\Frontend\ImageManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('admin.permissions:posts_management');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->searchFilter();
        return view('backend.admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoies  = Category::basicSelect()->get();
        return view('backend.admin.posts.create', ['categories' => $categoies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try{
            DB::beginTransaction();
            $request->validated();
            $post = Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images']));
            if ($request->hasFile('images')) {
                ImageManager::uploadImages($request, $post, 'posts', 'uploads');
            }
            DB::commit();
            Cache::flush() ; // forget all cache keys
            display_success_message('Post Created Successfully!');
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack() ; 
            display_error_message('Try Again!') ;   
            return redirect()->back() ;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['images'])->findOrFail($id);
        return view('backend.admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categoies  = Category::basicSelect()->get();
        return view('backend.admin.posts.edit', ['post' => $post, 'categories' => $categoies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        $request->validated();
        $post = Post::with(['images:image'])->findOrFail($id);
        if (!$post) {
            display_error_message('Error Try Again!');
            return redirect()->back();
        }
        $post->update($request->except(['_token', '_method', 'images']));
        if ($request->hasFile('images')) {
            ImageManager::deleteImages($post);
            ImageManager::uploadImages($request, $post, 'posts' ,'uploads');
        }
        Cache::flush() ; // forget all cache keys
        display_success_message('Post Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        if (!$post) {
            display_error_message('Error, Try Again!');
            return redirect()->route('admin.posts.index');
        }
        ImageManager::deleteImages($post);
        $post->delete();
        Cache::flush() ; // forget all cache keys
        display_success_message('Post Deleted Successfully!');
        return redirect()->route('admin.posts.index');
    }

    public function changePostStatus(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        if (!$post) {
            display_error_message('Error Try Again!');
            return redirect()->back();
        }
        if ($post->status == 1) {
            $post->update([
                'status' => 0,
            ]);
            display_success_message('Post Now UnActive!');
            return redirect()->back();
        } else {
            $post->update([
                'status' => 1,
            ]);
            display_success_message('Post Now Active!');
            return redirect()->back();
        }
    }

    public function getPostComments($slug)
    {
        $post = Post::query()
            ->select(['id', 'title'])
            ->with(['comments' => function ($query) {
                $query->select(['id', 'comment', 'post_id', 'user_id' , 'created_at'])
                    ->with('user:id,name,image')
                    ->limit(10)
                    ->latest();
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


    private function searchFilterQueryParams()
    {
        $search = request()->query('search');
        $status = request()->query('status');
        $limit_by = request()->query('limit_by') ?? 5;
        $sort_by = request()->query('sort_by') ?? 'id';
        $order_by = request()->query('order_by') ?? 'asc';
        return [
            'search' => $search,
            'status' => $status,
            'limit_by' => $limit_by,
            'sort_by' => $sort_by,
            'order_by' => $order_by,
        ];
    }

    private function searchFilter()
    {
        $queryParams[] = $this->searchFilterQueryParams();
        $search = $queryParams[0]['search'];
        $status = $queryParams[0]['status'];
        $limit_by = $queryParams[0]['limit_by'];
        $sort_by = $queryParams[0]['sort_by'];
        $order_by = $queryParams[0]['order_by'];

        $posts = Post::query()
            ->with(['user', 'admin:id,name'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%" . $search . "%");
            })
            ->when(!is_null($status), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return $posts;
    }
}
