<?php

namespace App\Http\Requests\Frontend\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required' , 'string' , 'min:3' , 'max:100'], 
            'description' => ['required' , 'string' , 'min:50'] , 
            'category_id' => ['required' , 'exists:categories,id'], 
            'comment_able' => ['in:on,off'], 
            'images' => ['nullable' , 'array'] , 
            'images.*' => ['image' , 'mimes:jpg,png,jpeg,webp' , 'max:2048'] ,
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category', 
        ];
    }
}
