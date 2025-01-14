<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'title',
        'description',
        'slug' , 
        'number_of_views' , 
        'comment_able',
        'status' ,
        'user_id',
        'category_id',
    ];


     //==========================================================================//
        //------------------------Relationships----------------------------//
    //==========================================================================//
    
    public function user()
    {
        $this->belongsTo(User::class , 'post_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'post_id') ; 
    }

    public function images()
    {
        return $this->hasMany(PostImage::class , 'post_id'); 
    }

    public function comments()
    {
        return $this->hasMany(Comment::class , 'post_id');
    }
     //==========================================================================//
        //------------------------Elequent Sluggable----------------------------//
    //==========================================================================//
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
