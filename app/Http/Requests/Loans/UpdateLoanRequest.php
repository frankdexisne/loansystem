<?php

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
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
            'category_id'=>'required|exists:categories,id',
            'payment_mode_id'=>'required|exists:payment_modes,id',
            'term_id'=>'required|exists:terms,id',
            'loan_amount'=>'required|numeric',
            'interest'=>'required|numeric|min:1,max:100'
        ];
    }
}
