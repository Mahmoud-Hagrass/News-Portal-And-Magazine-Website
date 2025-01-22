<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use HasFactory, Sluggable;


    protected $fillable = ['name', 'slug', 'status'];


    //==========================================================================//
    //------------------------Relationships----------------------------//
    //==========================================================================//

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }



    //==========================================================================//
    //------------------------Local Scopes----------------------------//
    //==========================================================================//

    public function scopeWithPostsAndCount($query)
    {
        return $query
            ->withCount('posts')
            ->with('posts')
            ->orderBy('posts_count', 'desc');
    }


    public function scopeBasicSelect($query)
    {
         return $query->select('id' , 'name' , 'slug') ; 
    }

    //==========================================================================//
    //------------------------Elequent Sluggable----------------------------//
    //==========================================================================//

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
