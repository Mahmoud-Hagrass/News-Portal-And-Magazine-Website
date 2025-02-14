<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory , Notifiable;

    protected $fillable = ['name' , 'username' , 'email' , 'password', 'status' , 'remember_token' , 'email_verified_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //==========================================================================//
        //------------------------Relationships----------------------------//
    //==========================================================================//

    public function posts()
    {
        return $this->hasMany(Post::class, 'admin_id');
    }
}
