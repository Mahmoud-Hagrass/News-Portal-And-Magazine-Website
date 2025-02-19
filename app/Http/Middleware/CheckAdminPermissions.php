<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$permissions): Response
    {
         // Get the authenticated admin user
         $admin = Auth::guard('admin')->user() ?? null;
         if($admin === null){
             return redirect()->route('admin.login');
         }
         if ($admin) {
             if (is_string($permissions)) {
                 $permissions = [$permissions];
             }
             foreach ($permissions as $permission) {
                 if (!$admin->can($permission)) {
                     abort(403, 'You do not have permission to access this page.');
                 }
             }
         }
          return $next($request);
    }
}
