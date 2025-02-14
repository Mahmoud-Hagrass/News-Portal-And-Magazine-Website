<?php

namespace App\Http\Requests\Backend\Admin\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
        $id = $this->route('admin');
        return [
            'name' => ['required' , 'string' , 'min:3' , 'max:25'], 
            'username' => ['required' , 'string' , 'min:5' , 'max:30' , Rule::unique('admins')->ignore($id)], 
            'email' => ['required' , 'string' , 'email' , 'lowercase' , '' , Rule::unique('admins')->ignore($id)], 
            'password' => ['required' , 'string' , 'confirmed' , 'min:8' , 'max:30'] , 
            'password_confirmation' => ['required' , 'string'], 
            'status' => ['required' , 'in:0,1'], 
        ];
    }
}
