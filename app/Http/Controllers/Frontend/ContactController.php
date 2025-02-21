<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactAdminNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact-us.contact-us'); ;   
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->validated() ;
        $data['ip_address'] = $request->ip() ;
        $contact = Contact::create($data) ; 
        // notify all admins witj new contact message
        $admins = Admin::get() ;
        Notification::send($admins , new NewContactAdminNotify($contact)) ; 
        if(!$contact){
            display_error_message('Sorry , Try Again') ; 
            return redirect()->back() ;
        }
        display_success_message('Your Message Sent Successfully !') ;
        return redirect()->back() ;
    }
}
