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
        if($request->query('notify')){
            $notification = Auth::guard('web')->user()->unreadNotifications()->where('id', $request->query('notify'))->first() ; 
           if($notification){
              $notification->markAsRead() ; 
           }
        }
        return $next($request);
    }
}
