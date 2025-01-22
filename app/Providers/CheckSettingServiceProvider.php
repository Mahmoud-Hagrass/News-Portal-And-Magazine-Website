<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\UsefulLink;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CheckSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $site_settings = Setting::firstOr(function(){
            return Setting::create([
                'site_name' => 'Laravel News' , 
                'favicon' => 'default' , 
                'logo' => '/img/logo.png' ,
                'facebook' => 'https://www.facebook.com/' ,
                'twitter' => 'https://www.twitter.com/' ,
                'instagram' => 'https://www.instagram.com/' ,
                'youtube' => 'https://www.youtube.com/' ,
                'country' => 'Egypt' ,
                'city' => 'alex' ,
                'street' => 'kahled ben waleed' ,
                'email' => 'news@social.com' , 
                'phone' => '01299999999', 
            ]) ; 
        }) ; 
        
        $useful_links = UsefulLink::limit(5)->get() ; 

        View::share([
            'site_settings' => $site_settings , 
            'useful_links' => $useful_links , 
        ]) ;
    }
}
