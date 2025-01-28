<?php

namespace App\Http\Controllers\Frontend\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.notification') ; 
    }

    public function delete_notification(Request $request)
    {
       $notification = Auth::guard('web')->user()->unreadNotifications()->where('id' , $request->notification_id ); 
       if(!$notification){
        display_error_message('Can Not Delete This Notification , Try Again !') ; 
        return redirect()->back() ; 
       }
       $notification->delete() ;
       display_success_message('Notification Deleted Successfully!') ; 
       return redirect()->back() ; 
    }

    public function delete_all_notifications()
    {
        Auth::guard('web')->user()->notifications()->delete() ; 
        display_success_message('All Notifications Deleted Successfully!') ;
        return redirect()->back() ;
    }

    public function mark_all_as_read()
    {
        Auth::guard('web')->user()->unreadNotifications->markAsRead() ;
        display_success_message('All Notifications Marked As Read Successfully!') ;
        return redirect()->back() ;
    }
}
