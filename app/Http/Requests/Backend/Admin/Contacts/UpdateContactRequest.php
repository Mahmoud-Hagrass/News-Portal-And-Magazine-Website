<?php

namespace App\Http\Requests\Backend\Admin\Contacts;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class UpdateContactRequest extends FormRequest
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
        $contactId = $this->route('contact') ; 
        return [
            'name' => ['required' , 'string' , 'max:100' , 'min:3'] , 
            'email' => ['required' , 'string' , 'lowercase' , 'email' , 'unique:contacts,email,'. $contactId] , 
            'phone' => ['required' , 'string' , 'phone:Auto'] , 
            'address' => ['required' , 'min:3' , 'max:100' , 'string'] ,
            'subject' => ['required' , 'min:30' , 'max:200' ,  'string'] , 
            'message' => ['required' , 'min:50' , 'max:2000' ,'string'] ,
            'is_read' => ['required' , 'in:0,1' , 'min:1'] , 
        ];
    }
    public function messages()
    {
        return [
            'phone.phone' => 'Please enter a valid phone number'
        ] ; 
    }
}
