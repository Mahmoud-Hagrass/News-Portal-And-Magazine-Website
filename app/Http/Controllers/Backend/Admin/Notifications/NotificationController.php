<?php

namespace App\Http\Controllers\Backend\Admin\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin' , 'admin.permissions:notifications_management']) ;
    }
    public function index()
    {
        $notifications = Auth::guard('admin')->user()->unreadNotifications()->get() ; 
        return view('backend.admin.notifications.index' , ['notifications' => $notifications]) ; 
    }

    public function deleteNotification(Request $request)
    {
        if(Auth::guard('admin')->check()){
           $notification = Auth::guard('admin')->user()->unreadNotifications()->where('id' , $request->notification_id)->first() ; 
           if(!$notification){
               display_error_message('Error Try Again!') ;
               return redirect()->back() ;
           }
           $notification->delete() ;
           display_success_message('Notification Deleted Successfully!') ;
           return redirect()->back() ;
        }
    }
    
    public function markAsRead(Request $request)
    {
        if(Auth::guard('admin')->check()){
            $notification = Auth::guard('admin')->user()->unreadNotifications()->where('id' , $request->notification_id)->first() ; 
            if(!$notification){
                display_error_message('Error Try Again!') ;
                return redirect()->back() ;
            }
            $notification->markAsRead() ;
            display_success_message('Notification Marked As Read Successfully!') ;
            return redirect()->back() ;
        }
    }

    public function deleteAllNotifications()
    {
        if(Auth::guard('admin')->check()){
            $notifications = Auth::guard('admin')->user()->notifications() ;
            if(!$notifications){
                display_error_message('Error Try Again!') ;
                return redirect()->back() ;
            }
            $notifications->delete() ;
            display_success_message('All Notifications Deleted Successfully!') ;
            return redirect()->back() ;
        }
    }

    public function markAllAsRead()
    {
        if(Auth::guard('admin')->check()){
            $notifications = Auth::guard('admin')->user()->unreadNotifications()->get() ;
            if(!$notifications){
                display_error_message('Error Try Again!') ;
                return redirect()->back() ;
            }
            $notifications->markAsRead() ;
            display_success_message('All Notifications Marked As Read Successfully!') ;
            return redirect()->back() ;
        }
    }
}
