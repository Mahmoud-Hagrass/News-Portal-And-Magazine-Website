<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class Admin extends Authenticatable
{
    use HasFactory , Notifiable;

    protected $fillable = ['name' , 'username' , 'email' , 'password', 'status' , 'role_id' , 'remember_token' , 'email_verified_at'];

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

    public function role()
    {
        return $this->belongsTo(Role::class , 'role_id');
    }

    public function hasPermission($permission_key)
    {
        $role = $this->role ;
        if(!$role){
            return false ;
        }
        foreach($role->permissions as $permission){
            if($permission == $permission_key ?? false){
                return true ; 
            }
        }
    }

    // Customize Broadcasting Private Channel 
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'admins.'. $this->id;
    }

}