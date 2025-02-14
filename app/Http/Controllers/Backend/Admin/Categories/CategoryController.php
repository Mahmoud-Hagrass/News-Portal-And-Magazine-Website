<?php

namespace App\Http\Controllers\Backend\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\Categories\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
          $this->middleware('admin') ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->searchFilter();
        return view('backend.admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validated() ; 
        $category = Category::create([
            'name' => $request->category_name , 
            'status' => $request->category_status , 
        ]) ; 
        if(!$category){
            display_error_message('Error Try Again!') ; 
            return redirect()->back() ; 
        }
        display_success_message('Category Created Successfully') ; 
        return redirect()->back() ; 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // return $request ; 
        $category = Category::findOrFail($id) ; 
        if(!$category){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ;
        }
        $category->update([
            'name' => $request->category_name , 
            'status' => $request->category_status ,
        ]) ; 
        display_success_message('Category Updated Successfully!') ;
        return redirect()->back() ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request , string $id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            display_error_message('Error, Try Again!');
            return redirect()->back();
        }
        $category->delete();
        display_success_message('Category Deleted Successfully!');
        return redirect()->back();
    }

    public function changeCategoryStatus(Request $request)
    {
        $request->validate(['category_id' => ['required', 'exists:categories,id']]);
        $category = Category::findOrFail($request->category_id);
        if ($category->status == 1) {
            $category->update([
                'status' => 0,
            ]);
            display_success_message('Category Now UnActive!');
            return redirect()->back();
        } else {
            $category->update([
                'status' => 1,
            ]);
            display_success_message('Category Now Active!');
            return redirect()->back();
        }
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

        $categories = Category::query()
            ->basicSelect()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%" . $search . "%");
            })
            ->when(!is_null($status), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->withCount('posts')
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return $categories;
    }
}
