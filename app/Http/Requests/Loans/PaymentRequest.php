<?php

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'orno'=>'required|unique:mysql.payments,orno,'.$this->id,
            'payment_date'=>'required|date',
            'ps'=>$this->has('with_savings') ? 'required|numeric' : '',
            'cbu'=>$this->has('with_savings') ? 'required|numeric' : ''
        ];
    }
}
