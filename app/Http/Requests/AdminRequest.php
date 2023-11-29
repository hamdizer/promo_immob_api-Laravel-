<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AdminRequest extends FormRequest
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
            'cin'=>'digits:8|unique:administrators',
            'last_name'=>'alpha',
            'first_name'=>'alpha',
            'email'=>'email|unique:administrators',
            'password'=>'string|min:8',
            'role'=>'integer'
        ];
    }
    public function messages()
    {
        return [
            'cin.unique' => 'Cin is unique.',
            'last_name.alpha' => 'last name must be alphabetic',
            'first_name.alpha' => 'first name must be alphabetic',
            'email' => 'email must be of type email',
            'email.unique' => 'email is unique.',
            'password.min' => 'password length must be of length at least 8',


        ];
    }

}
