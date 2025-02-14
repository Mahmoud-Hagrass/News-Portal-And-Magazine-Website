<?php

namespace App\Http\Controllers\Backend\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\Admins\StoreAdminRequest;
use App\Http\Requests\Backend\Admin\Admins\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(1) ; 
        return view('backend.admin.admins.index' , compact('admins')) ; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.admins.create') ; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
       $request->validated() ; 
       $admin = Admin::create($request->only(['name' , 'username' , 'email' , 'password' , 'status'])) ; 
       if(!$admin){
           display_error_message('Error Try Again!') ;
           return redirect()->back() ; 
       }
       display_success_message('Admin Created Successfully!') ; 
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
        $admin = Admin::findOrFail($id) ; 
        return view('backend.admin.admins.edit' , compact('admin')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {
        $request->validated() ; 
        $admin = Admin::findOrFail($id) ; 
        if(!$admin){
            display_error_message('Error Try Again!') ; 
            return redirect()->back() ; 
        }
        $admin->update($request->only(['name' , 'username' , 'email' , 'status'])) ; 
        display_success_message('Admin Updated Successfully!') ; 
        return redirect()->back() ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request , string $id)
    {
        $admin = Admin::findOrFail($id);
        if(!$admin){
            display_error_message('Error Try Again!') ; 
            return redirect()->back() ; 
        }
        $admin->delete() ;
        display_success_message('Admin Deleted Successfully!') ; 
        return redirect()->back() ;
    }


    public function changeAdminStatus(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        if (!$admin) {
            display_error_message('Error Try Again!');
            return redirect()->back();
        }
        if ($admin->status == 1) {
            $admin->update([
                'status' => 0,
            ]);
            display_success_message('Admin Now UnActive!');
            return redirect()->back();
        } else {
            $admin->update([
                'status' => 1,
            ]);
            display_success_message('Admin Now Active!');
            return redirect()->back();
        }
    }
}
