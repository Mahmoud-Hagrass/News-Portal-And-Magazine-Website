<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone' , 
        'country' ,
        'city' ,
        'street' ,
        'image' , 
        'status' ,
        'email_verified_at', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //==========================================================================//
        //------------------------Relationships----------------------------//
    //==========================================================================//
    
    public function posts()
    {
        return $this->hasMany(Post::class , 'user_id') ; 
    }


    public function comments()
    {
        return $this->hasMany(Comment::class , 'user_id') ;
    }
    
    //Customize User Broadcasting Channel
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.'. $this->id;
    }

    //==========================================================================//
        //------------------------Local Socpes----------------------------//
    //==========================================================================//

    public function scopeActive($query)
    {
        return $query->where('status' , 1) ;
    }
}