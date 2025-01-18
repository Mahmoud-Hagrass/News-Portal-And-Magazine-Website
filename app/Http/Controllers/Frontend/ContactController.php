<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

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

        if(!$contact){
            display_error_message('Sorry , Try Again') ; 
            return redirect()->back() ;
        }
        display_success_message('Your Message Sent Successfully !') ;
        return redirect()->back() ;
    }
}
