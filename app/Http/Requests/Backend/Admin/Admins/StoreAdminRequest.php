<?php

namespace App\Http\Requests\Backend\Admin\Admins;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\password;

class StoreAdminRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'min:3' , 'max:25'], 
            'username' => ['required' , 'string' , 'min:5' , 'max:30' , 'unique:admins,username'], 
            'email' => ['required' , 'string' , 'email' , 'lowercase' , '' , 'min:8','max:50' , 'unique:admins,email'], 
            'password' => ['required' , 'string' , 'confirmed' , 'min:8' , 'max:30' , 'confirmed'] , 
            'password_confirmation' => ['required' , 'string'], 
            'status' => ['required' , 'in:0,1'], 
        ];
    }
}
