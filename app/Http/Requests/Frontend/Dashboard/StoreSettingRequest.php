<?php

namespace App\Http\Requests\Frontend\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSettingRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'max:20'] ,
            'username' => ['required' , 'string' , 'unique:users,username,'. Auth::user()->id] , 
            'email' => ['required' , 'string' , 'email' , 'unique:users,email,'. Auth::user()->id] , 
            'phone' => ['required' , 'numeric' , 'phone:Auto' , 'unique:users,phone,'. Auth::user()->id] , 
            'country' => ['nullable' , 'string' , 'max:20'] ,
            'city' => ['nullable' , 'string' , 'max:20'] ,
            'street' => ['nullable' , 'string' , 'max:20'] ,
            'image' => ['nullable' , 'image' , 'mimes:jpg,png,jpeg,webp' , 'max:2048'] ,
        ];
    }
}
