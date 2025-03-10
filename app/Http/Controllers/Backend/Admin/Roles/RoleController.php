<?php

namespace App\Http\Controllers\Backend\admin\Roles;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin') ; 
        $this->middleware('admin.permissions:roles_management') ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('admins')->paginate(5) ; 
        return view('backend.admin.roles.index' , ['roles' => $roles]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.roles.create') ; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validatePermissions($request) ; 
        $request->merge(['permissions' => json_encode($request->permissions)]) ; 
        $role =Role::create($request->only(['name' , 'permissions'])) ; 
        if(!$role){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ; 
        }
        display_success_message('Role Created Successfully!') ;
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
        $role = Role::findOrFail($id) ;
        if(!$role){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ; 
        }
        return view('backend.admin.roles.edit' , ['role' => $role]) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validatePermissions($request) ; 
        $request->merge(['permissions' => json_encode($request->permissions)]) ; // merge permissions key in request as json
        $role =Role::findOrFail($id) ;
        if(!$role){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ;
        }
        $role->update($request->only(['name' , 'permissions'])) ;
        display_success_message('Role Updated Successfully!') ;
        return redirect()->back() ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $role = Role::withCount('admins')->findOrFail($id) ; 
        if(!$role){
            display_error_message('Error Try Again!') ; 
            return redirect()->back() ; 
        }
        // check if the role has admins :
        // avoid using $role->admins->count() because it will make n+1 lazy load query
        if($role->admins_count > 0){
            display_error_message('Can Not Delete This Role Because It Has Admins!') ; 
            return redirect()->back() ;
        }
        $role->delete() ;
        display_success_message('Role Deleted Successfully!') ; 
        return redirect()->back() ; 
    }

    private function validatePermissions($request)
    {
        $request->validate([
            'name' => ['required' , 'string' , 'min:2' , 'max:50'] , 
            'permissions' =>['required' , 'array' , 'min:1'] , 
        ]) ;
    }
}
