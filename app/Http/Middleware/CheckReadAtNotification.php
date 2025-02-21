<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckReadAtNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user() ;
        $admin = Auth::guard('admin')->user() ;
        if(!$user){
            return redirect()->route('admin.login') ;
        }
        if(!$admin){
            return redirect()->route('admin.login') ;
        }
        
        if($request->query('notify') && $user){
            $notification = $user->unreadNotifications()->where('id', $request->query('notify'))->first() ; 
           if($notification){
              $notification->markAsRead() ; 
           }
        }
        if($request->query('notify_admin') && $admin){
            $notification = $admin->unreadNotifications()->where('id', $request->query('notify_admin'))->first() ; 
           if($notification){
              $notification->markAsRead() ; 
           }
        }
        
        return $next($request);
    }
}
