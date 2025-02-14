<?php

namespace App\Http\Requests\Backend\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'site_name' => ['required' , 'string' , 'min:3' , 'max:60'], 
            'phone'=>  ['required' , 'phone:Auto'] , 
            'email' => ['required' , 'string' , 'email' , 'lowercase' , 'min:20' , 'max:50'] , 
            'small_description'=> ['nullable' , 'string' , 'min:50' , 'max:1000'] ,
            'country' => ['required' , 'string' , 'min:3' , 'max:25'],
            'city' =>  ['required' , 'string' , 'min:3' , 'max:25'] , 
            'street' => ['required' , 'string' , 'min:5' , 'max:70'] ,
            "facebook" => ['required' , 'string' , 'url' , 'min:25' , 'max:100'],
            "twitter" =>  ['required' , 'string' , 'url' , 'min:25' , 'max:100'] ,  
            "instagram"  => ['required' , 'string' , 'url' , 'min:25' , 'max:100'], 
            "youtube" => ['required' , 'string' , 'url' , 'min:25' , 'max:100'],
            "logo" => ['required' , 'image' , 'mimes:png,jpg,jpeg,webp' , 'max:2048'], 
            "favicon" => ['required' , 'image' , 'mimes:png,jpg,jpeg,webp' , 'max:2048'], 
        ] ; 
    }
}
