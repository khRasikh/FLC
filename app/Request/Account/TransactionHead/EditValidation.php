<?php

namespace App\Http\Requests\Account\TransactionHead;

use Illuminate\Foundation\Http\FormRequest;

class EditValidation extends FormRequest
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
            'tr_head'                => 'required | max:100 | unique:transaction_heads,tr_head,'.$this->request->get('id'),
            'type'                   => 'required',

        ];

    }

    /*custom message
     * public function messages()
    {
        return [
            'tr_head.required'            => 'Transaction Title Required',
            'tr_head.unique'              => 'Please Enter Unique Fee Title.',
        ];
    }*/
}
