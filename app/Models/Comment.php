<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected $fillable = [
            'comment' ,
            'user_id' ,
            'post_id' ,
            'status' ,
            'ip_address'
      ] ; 

    
      //==========================================================================//
        //------------------------Relationships----------------------------//
    //==========================================================================//
    
      public function user()
      {
          return $this->belongsTo(User::class) ;
      }
}
