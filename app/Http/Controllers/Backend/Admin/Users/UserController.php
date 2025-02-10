<?php

namespace App\Http\Controllers\Backend\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\Users\StoreUserRequest;
use App\Models\User;
use App\Utils\Frontend\ImageManager;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $users = $this->searchFilter() ; 
        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.users.create') ; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try{
            DB::beginTransaction(); 
            $request->validated();
            $email_verified_at = $request->email_verified_at == 1 ? Carbon::now() : null; 
            $request->merge(['email_verified_at' => $email_verified_at]); 
            $user = User::create($request->except(['_token' , 'image' , 'password_confirmation'])) ;
            ImageManager::uploadImage($request , $user) ;
            DB::commit();
            display_success_message('User Created Successfully !'); ; 
            return redirect()->back() ;
        }catch(Exception $e){
            DB::rollBack() ; 
            display_error_message('Try Again!') ;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        request()->query('id'); 
        request()->validate(['id' => ['exists:users,id']]);
        $user = User::select('name', 'username', 'email', 'phone', 'status' ,'country' , 'city' ,'street' , 'image')->findOrFail($id);
        if(!$user){
            display_error_message('Error, Try Again!');
            return redirect()->back();
        }
        return response()->json([
            'status' => 200 ,
            'data' => $user , 
        ]) ;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $request->validate(['id' => ['required', 'exists:users,id']]);
        $user = User::findOrFail($id);
        if (!$user) {
            display_error_message('Error, Try Again!');
            return redirect()->back();
        }
        ImageManager::deleteImage($user);
        $user->delete();
        display_success_message('User Deleted Successfully!');
        return redirect()->back();
    }

    public function changeUserStatus(Request $request)
    {
        $request->validate(['user_id' => ['required', 'exists:users,id']]);
        $user = User::findOrFail($request->user_id);
        if ($user->status == 1) {
            $user->update([
                'status' => 0,
            ]);
            display_success_message('User Now UnActive!');
            return redirect()->back();
        } else {
            $user->update([
                'status' => 1,
            ]);
            display_success_message('User Now Active!');
            return redirect()->back();
        }
    }

    public function showBlockedUsers()
    {
        request()->merge(['status' => 0]) ; 
        $users = $this->searchFilter() ;
        return view('backend.admin.users.show-blocked-users' , ['users' => $users]); ; 
    }

    private function searchFilterQueryParams()
    {
        $search = request()->query('search');
        $status = request()->query('status');
        $limit_by = request()->query('limit_by') ?? 5;
        $sort_by = request()->query('sort_by') ?? 'id';
        $order_by = request()->query('order_by') ?? 'asc';
        return[
            'search' => $search,
            'status' => $status , 
            'limit_by' => $limit_by , 
            'sort_by' => $sort_by , 
            'order_by' => $order_by , 
        ] ;
    }

    private function searchFilter()
    {
        $queryParams[] = $this->searchFilterQueryParams();
        $search = $queryParams[0]['search'] ; 
        $status = $queryParams[0]['status'] ; 
        $limit_by = $queryParams[0]['limit_by'] ; 
        $sort_by = $queryParams[0]['sort_by'] ; 
        $order_by = $queryParams[0]['order_by'] ;

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%" . $search . "%")
                    ->orwhere('username', 'LIKE', "%" . $search . "%")
                    ->orwhere('email', 'LIKE', "%" . $search . "%");
            })
            ->when(!is_null($status), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
        return $users;
    }
}
