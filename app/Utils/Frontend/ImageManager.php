<?php
namespace App\Utils\Frontend;
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageManager
{
    public static function uploadImages($request , $post , $disk)
    {
        $uploadedFiles = [] ;
        if($request->hasFile('images')){
            $images = $request->file('images'); 
            foreach($images as $image){
                $file =  Str::uuid() .  time() . '.' . $image->getClientOriginalExtension() ;
                $path = $image->storeAs('posts' , $file , ['disk' => $disk]) ;
                $uploadedFiles[] = $path ; 
                $post->images()->create([
                    'image' => $path , 
                ]) ; 
            }
        }
        return $uploadedFiles ;
    }


    public static function deletePostImages($post)
    {
        // delete from local storage
        foreach($post->images as $image){
            if(Storage::disk('uploads')->exists($image->image)){
                Storage::disk('uploads')->delete($image->image);
            }
        }
    }
}