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
            //delete old images
            self::deleteImages($post) ; 
            // delete post images from paths from database
            $post->images()->delete() ;
            
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


    public static function deleteImages($post)
    {
        // delete from local storage
        foreach($post->images as $image){
            if(Storage::disk('uploads')->exists($image->image)){
                Storage::disk('uploads')->delete($image->image);
            }
        }
    }

    public static function deleteImage($object)
    {
        if(!empty($object->image) && Storage::disk('uploads')->exists($object->image)){
            Storage::disk('uploads')->delete($object->image);
        }
        return false; 
    }

    public static function uploadImage($request , $user)
    {
        if($request->hasFile('image')){
            $image = $request->file('image') ; 
            $file = Str::uuid() . time() . '.' .$image->getClientOriginalExtension() ; 
            $path = $image->storeAs('users', $file , ['disk' => 'uploads']) ;
            $user->update([
                'image' => $path , 
            ]) ;  
         }else{
            $user->update(['image' => null]) ; 
         }
    }
}