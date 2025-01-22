<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use libphonenumber\PhoneNumber;

class StoreContactRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'max:100' , 'min:3'] , 
            'email' => ['required' , 'string' , 'lowercase' , 'email' , 'unique:contacts,email'] , 
            'phone' => ['required' , 'string' , 'phone:Auto'] , 
            'address' => ['required' , 'string'] ,
            'subject' => ['required' , 'string'] , 
            'message' => ['required' , 'string'] ,
        ];
    }
    public function messages()
    {
        return [
            'phone.phone' => 'Please enter a valid phone number'
        ] ; 
    }
}
