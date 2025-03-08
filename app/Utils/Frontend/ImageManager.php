<?php
namespace App\Utils\Frontend;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageManager
{
    public static function uploadImages($request , $data  , $folder, $disk)
    {
        $uploadedFiles = [] ;
        if($request->hasFile('images')){
            //delete old images
            self::deleteImages($data) ; 
            // delete post images from paths from database
            $data->images()->delete() ;
            
            $images = $request->file('images'); 
            foreach($images as $image){
                $file =  Str::uuid() .  time() . '.' . $image->getClientOriginalExtension() ;
                $path = $image->storeAs($folder , $file , ['disk' => $disk]) ;
                $uploadedFiles[] = $path ; 
                PostImage::create([
                    'post_id' => $data->id ,
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

    public static function customDeleteImage($object , $col=null , $disk)
    {
        if(!empty($object->$col) && Storage::disk($disk)->exists($object->$col)){
            Storage::disk($disk)->delete($object->$col);
        }
        return false; 
    }

    public static function uploadImage($request , $user  , $folder , $disk)
    {
        if($request->hasFile('image')){
            $image = $request->file('image') ; 
            $file = Str::uuid() . time() . '.' .$image->getClientOriginalExtension() ; 
            $path = $image->storeAs($folder, $file , ['disk' => $disk]) ;
            $user->update([
                'image' => $path , 
            ]) ;  
         }
           // $user->update(['image' => null]) ; 
    }

    public static function customeUploadImage($request , $object , $request_key, $col , $store_path , $disk)
    {
        if($request->hasFile($request_key)){
            $image = $request->file($request_key) ; 
            $file = Str::uuid() . time() . '.' .$image->getClientOriginalExtension() ; 
            $path = $image->storeAs($store_path, $file , ['disk' => $disk]) ;
            $object->update([
                $col => $path , 
            ]) ;  
         }
    }
}