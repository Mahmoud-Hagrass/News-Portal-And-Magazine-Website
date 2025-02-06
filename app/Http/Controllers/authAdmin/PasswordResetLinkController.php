<?php

namespace App\Http\Controllers\authAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminForgetPasswordNotify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('backend.admin.auth.forget-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $admin = Admin::where('email' , $request->email)->first() ; 
        if(!$admin){
            return redirect()->back()->with('email-not-found-error' , 'This Email Not Found!') ; 
        }
        $admin->notify(new AdminForgetPasswordNotify()) ; 
    }
}
