<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreNewsSubscriberRequest;
use App\Mail\Frontend\NewsSubscriberMail;
use App\Models\NewsSubscriber;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewsSubscriberController extends Controller
{
    public function store(StoreNewsSubscriberRequest $request)
    {
        $data = $request->validated() ; 
        $subscriberData = NewsSubscriber::create($data) ;   
        if(!$subscriberData){
            display_error_message('Sorry , Try Again') ;
            return redirect()->back() ;
        }
        Mail::to($data['email'])->send(new NewsSubscriberMail);
        display_success_message('Thank You For Subscribe !') ; 
        return redirect()->back() ;
    }
}
