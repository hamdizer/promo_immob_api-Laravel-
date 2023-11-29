<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'name' => 'string',
            'send_date' => 'date',
            'limit_date'=>'date',
            'payed'=>'boolean',
            'bill_amount'=>'integer',
            'agency_id'=>'integer',
            'client_id'=>'integer',
        ];
    }
}
