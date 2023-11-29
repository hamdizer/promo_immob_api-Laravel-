<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cin'=>'digits:8|unique:clients',
            'last_name'=>'alpha',
            'first_name'=>'alpha',
            'phone_number'=>'digits:8|unique:clients',
            'address'=>'string',
            'email'=>'email|unique:clients',
            'password'=>'string'
        ];
    }
    public function messages()
    {return[
        'cin.unique' => 'Cin is unique.',
        'cin.digit' => 'Cin must be of 8 digit.',
        'last_name.alpha' => 'last name must be alphabetic',
            'first_name.alpha' => 'first name must be alphabetic',
            'email' => 'email must be of type email',
            'phone_number.digit'=>'phone_number must be of 8 digit',
            'email.unique' => 'email is unique.',
            'password.min' => 'password length must be of length at least 8',
        ];
    }
}
