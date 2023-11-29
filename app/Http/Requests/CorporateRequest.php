<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorporateRequest extends FormRequest
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
            'cin'=>'digits:8|unique:corporates',
            'last_name'=>'alpha',
            'first_name'=>'alpha',
            'email'=>'email|unique:corporates',
            'password'=>'string',
            'agency_id'=>'integer',
            'role'=>'integer'
        ];
    }
}
