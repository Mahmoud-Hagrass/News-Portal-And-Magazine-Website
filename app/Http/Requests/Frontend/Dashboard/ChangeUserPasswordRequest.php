<?php

namespace App\Http\Requests\Frontend\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserPasswordRequest extends FormRequest
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
            'current_password' => ['required' , 'string'] , 
            'new_password' => ['required'  , 'string' , 'confirmed' , 'min:8'] , 
        ];
    }
}
